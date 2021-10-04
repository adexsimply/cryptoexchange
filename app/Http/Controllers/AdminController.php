<?php

namespace App\Http\Controllers;

use App\Admin;
use App\BuyMoney;
use App\ExchangeMoney;
use App\Provider;
use App\SellMoney;
use App\Message;
use App\Trx;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\GeneralSettings;
use App\Transaction;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use File;
use Image;

class AdminController extends Controller
{
    public function __construct()
    {
        $Gset = GeneralSettings::first();
        $this->sitename = $Gset->sitename;
        $this->middleware('auth:admin');
    }

    public function exchangeLog()
    {
        $data['exchange'] = ExchangeMoney::where('status', '!=', 0)->latest()->get();
        $data['page_title'] = 'Manage Exchange Log';
        return view('admin.currency.exchange-list', $data);
    }

    public function exchangeInfo($id)
    {
        $get = ExchangeMoney::where('id', $id)->where('status', '!=', 0)->first();
        if ($get) {
            $data['exchange'] = $get;
            $data['page_title'] = ' Exchange Log Details';
            return view('admin.currency.exchange-info', $data);
        }
        abort(404);
    }

    public function exchangeapprove($id)
    {
        $data = ExchangeMoney::find($id);
        $data->status = 2;
        $data->save();


        Message::create([
            'user_id' => $data->user_id,
            'title' => 'Exchange Approved',
            'details' => 'Your cryptocurrency exchange with transaction number ' . $data->transaction_number . ' was approved. Your fund has been credited into your wallet as requested',
            'admin' => 1,
            'status' =>  0
        ]);



        $notification =  array('message' => 'Exchange Approved Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function exchangereject($id)
    {
        $data = ExchangeMoney::find($id);
        $data->status = -2;
        $data->save();


        Message::create([
            'user_id' => $data->user_id,
            'title' => 'Exchange Rejected',
            'details' => 'Your cryptocurrency exchange was with transaction number ' . $data->transaction_number . ' rejected. Please send us a message to facilitate a refund if your money is not refunded in 24hours',
            'admin' => 1,
            'status' =>  0
        ]);



        $notification =  array('message' => 'Exhange Rejected Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function buyLog()
    {
        $data['status'] = "Confirmed";
        $data['exchange'] = Transaction::where('type', 'Buy')->where('status', 'Confirmed')->latest()->get();
        $data['page_title'] = 'Processed Buy Log';
        return view('admin.currency.buy-list', $data);
    }

    public function pendingbuyLog()
    {
        $data['status'] = "Pending";
        $data['exchange'] = Transaction::where('type', 'Buy')->where('status', 'Pending')->latest()->get();
        $data['page_title'] = 'Pending Buy Log';
        return view('admin.currency.buy-list', $data);
    }

    public function declinedbuyLog()
    {
        $data['status'] = "Declined";
        $data['exchange'] = Transaction::where('type', 'Buy')->where('status', 'Declined')->latest()->get();
        $data['page_title'] = 'Declined Buy Log';
        return view('admin.currency.buy-list', $data);
    }
    public function buyInfo($id)
    {
        $get = Transaction::where('id', $id)->where('type', 'Buy')->first();
        if ($get) {
            $data['exchange'] = $get;
            $data['page_title'] = ' Buy Log Details';
            return view('admin.currency.buy-info', $data);
        }
        abort(404);
    }

    public function buyapprove($id)
    {
        $data = Transaction::where('type', 'Buy')->where('id', $id)->where('status', '!=', 'Confirmed')->first();
        $basic = GeneralSettings::first();
        $data->status = "Confirmed";
        $data->save();
        Message::create([
            'user_id' => $data->user_id,
            'title' => 'Coin Purchase Confirmed',
            'details' => 'Your cryptocurrency purchase with transaction number ' . $data->trx . '  was Confirmed. Your account has been credited as required, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' =>  0
        ]);



        $notification =  array('message' => 'Confirmed Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function buyapprovesendprove(Request $request)
    {

        $this->validate(
            $request,
            [
                'prove' => 'required|image|max:5000',
                'user_id' => 'required',
                'trans_id' => 'required',
            ],
            [
                'prove.required' => "Purchase Proof File is required",
                'prove.image' => "Purchase Proof File must be Image type",
                'prove.max' => "Purchase Proof File must not more than 5mb",
            ]
        );
        $data = Transaction::where('type', 'Buy')->where(['id' => $request->trans_id, 'status' => 'Confirmed', 'user_id' => $request->user_id])->first();

        // dd($request->all(), $data);
        $path = 'assets/purchase_prove/' . $data->image;
        if (file_exists($path)) {
            @unlink($path);
        }
        if ($request->hasFile('prove')) {
            $data->image = 'purchase_prove_' . time() . uniqid() . '.jpg';
            $request->prove->move('assets/purchase_prove/', $data['image']);
        }

        $basic = GeneralSettings::first();
        $data->save();
        Message::create([
            'user_id' => $data->user_id,
            'title' => 'Coin Purchase Prove Sent',
            'details' => 'Your cryptocurrency purchase with transaction number ' . $data->trx . '  has been Confirmed. and the prove has been sent to you, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' =>  0
        ]);
        $notification =  array('message' => 'Purchase Prove Sent Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function buyreject($id)
    {
        $data = Transaction::where('type', 'Buy')->where('id', $id)->where('status', '!=', 'Declined')->first();
        $basic = GeneralSettings::first();
        $user = User::findOrFail($data->user_id);



        Message::create([
            'user_id' => $data->user_id,
            'title' => 'Purchase Rejected',
            'details' => 'Your cryptocurrency purchase with transaction number ' . $data->trx . ' was Declined. Please send us a message for complaints or clarifications on purchase rejection',
            'admin' => 1,
            'status' =>  0
        ]);

        $msg =  ' Buy Declined ' . $basic->currency_sym . number_format($data->amount, $basic->decimal) . ' ' . $basic->currency;
        send_email($user->email, $user->username, 'Buy Amount returned to your Naira Wallet ', $msg);

        $data->status = "Declined";

        $data->save();

        $user->balance = $user->balance + $data->amount;
        $user->save();

        $notification =  array('message' => 'Purchase Was Declined Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function sellLog()
    {
        $data['status'] = "Confirmed";
        $data['exchange'] = Transaction::where('type', 'Sell')->whereIn('status', ['Confirmed', 'Paid'])->latest()->get();
        $data['page_title'] = 'Processed Sell Log';
        return view('admin.currency.sell-list', $data);
    }
    public function paidsellLog()
    {
        $data['status'] = "Paid";
        $data['exchange'] = Transaction::where('type', 'Sell')->where('status', 'Paid')->latest()->get();
        $data['page_title'] = 'Pending Sell Log';
        return view('admin.currency.sell-list', $data);
    }
    public function pendingsellLog()
    {
        $data['status'] = "Pending";
        $data['exchange'] = Transaction::where('type', 'Sell')->where('status', 'Pending')->latest()->get();
        $data['page_title'] = 'Pending Sell Log';
        return view('admin.currency.sell-list', $data);
    }
    public function declinedsellLog()
    {
        $data['status'] = "Declined";
        $data['exchange'] = Transaction::where('type', 'Sell')->whereIn('status', ['Declined', 'Cancelled'])->latest()->get();
        $data['page_title'] = 'Declined Sell Log';
        return view('admin.currency.sell-list', $data);
    }
    public function cancelledsellLog()
    {
        $data['status'] = "User Cancelled";
        $data['exchange'] = Transaction::where('type', 'Sell')->where('status', 'Cancelled')->latest()->get();
        $data['page_title'] = 'Cancelled Sell Log';
        return view('admin.currency.sell-list', $data);
    }
    public function sellInfo($id)
    {
        $get = Transaction::where('type', 'Sell')->where('id', $id)->first();
        if ($get) {
            $data['exchange'] = $get;
            $data['page_title'] = 'Sell Log Details';
            return view('admin.currency.sell-info', $data);
        }
        abort(404);
    }

    public function sellapprove($id)
    {

        $data = Transaction::where('type', 'Sell')->where('id', $id)->where('status', '!=', 'Confirmed')->first();
        $basic = GeneralSettings::first();
        $data->status = "Confirmed";

        $user = User::find($data->user_id);
        $user->balance = $user->balance + $data->amount;
        $user->save();

        Message::create([
            'user_id' => $data->user_id,
            'title' => 'Sales Approved',
            'details' => 'Your cryptocurrency sales with transaction number ' . $data->trx . ' has been approved. You fund has been credited to your account as required. Thank you for choosing us',
            'admin' => 1,
            'status' =>  0
        ]);


        $msg =  ' Sell Amount  ' . $data->get_amount . ' ' . $basic->currency;
        //send_email($user->email, $user->username, 'Sell Amount  ', $msg);

        $data->save();

        $notification =  array('message' => 'Sales Approved Successfully !', 'alert-type' => 'success');
        return back()->with($notification);
    }


    public function sellreject($id)
    {

        $data = Transaction::where('type', 'Sell')->where('id', $id)->where('status', '!=', 'Confirmed')->first();
        $basic = GeneralSettings::first();

        Message::create([
            'user_id' => $data->user_id,
            'title' => 'Sale Rejected',
            'details' => 'Your cryptocurrency sales was rejected. Please send us a message for any complain, thanks',
            'admin' => 1,
            'status' =>  0
        ]);

        $data->status = "Declined";
        $data->save();

        $notification =  array('message' => 'Declined Successfully !', 'alert-type' => 'success');
        return back()->with($notification);
    }
    public function depositLog()
    {
        $data['status'] = "Confirmed";
        $data['exchange'] = $t = Transaction::where('type', 'Deposit')->where('status', 'Confirmed')->with('method:*')->with('gateway:*')->latest()->get();
        //dd($t);
        $data['page_title'] = 'Confirmed Deposit Log';
        return view('admin.finance.deposit', $data);
    }
    public function paiddepositLog()
    {
        $data['status'] = "Paid";
        $data['exchange'] = Transaction::where('type', 'Deposit')->where('status', 'Paid')->with('method:*')->with('gateway:*')->latest()->get();
        $data['page_title'] = 'Paid Deposit Log';
        return view('admin.finance.deposit', $data);
    }
    public function pendingdepositLog()
    {
        $data['status'] = "Pending";
        $data['exchange'] = Transaction::where('type', 'Deposit')->whereIn('status', ['Pending', 'Paid'])->with('method:*')->with('gateway:*')->latest()->get();
        $data['page_title'] = 'Pending Deposit Log';
        return view('admin.finance.deposit', $data);
    }
    public function declineddepositLog()
    {
        $data['status'] = "Declined";
        $data['exchange'] = Transaction::where('type', 'Deposit')->whereIn('status', ['Declined', 'Cancelled'])->with('method:*')->with('gateway:*')->latest()->get();
        $data['page_title'] = 'Declined Deposit Log';
        return view('admin.finance.deposit', $data);
    }
    public function cancelleddepositLog()
    {
        $data['status'] = "User Cancelled";
        $data['exchange'] = Transaction::where('type', 'Deposit')->where('status', 'Cancelled')->with('method:*')->with('gateway:*')->latest()->get();
        $data['page_title'] = 'Cancelled Deposit Log';
        return view('admin.finance.deposit', $data);
    }
    public function depositInfo($id)
    {
        $get = Transaction::where('type', 'Deposit')->with('method:*')->with('gateway:*')->where('id', $id)->first();
        if ($get) {
            $data['exchange'] = $get;
            $data['page_title'] = 'Deposit Log Details';
            return view('admin.finance.deposit-info', $data);
        }
        abort(404);
    }
    public function depositapprove($id)
    {

        $data = Transaction::where('type', 'Deposit')->where('id', $id)->where('status', 'Paid')->first();
        $basic = GeneralSettings::first();
        $data->status = "Confirmed";

        $user = User::find($data->user_id);
        $user->balance = $user->balance + ($data->amount - 1000);
        $user->save();

        Message::create([
            'user_id' => $data->user_id,
            'title' => 'Deposit Approved',
            'details' => 'Your cryptocurrency sales with transaction number ' . $data->trx . ' has been approved. You fund has been credited to your Naira Wallet Account as required. Thank you for choosing us',
            'admin' => 1,
            'status' =>  0
        ]);


        $msg =  ' Deposit Amount  ' . $data->get_amount . ' ' . $basic->currency;
        //send_email($user->email, $user->username, 'Sell Amount  ', $msg);

        $data->save();

        $notification =  array('message' => 'Deposit Approved Successfully !', 'alert-type' => 'success');
        return back()->with($notification);
    }
    public function depositreject($id)
    {

        $data = Transaction::where('type', 'Deposit')->where('id', $id)->where('status', '!=', 'Confirmed')->first();
        $basic = GeneralSettings::first();

        Message::create([
            'user_id' => $data->user_id,
            'title' => 'Deposit Rejected',
            'details' => 'Your cryptocurrency sales was rejected. Please send us a message for any complain, thanks',
            'admin' => 1,
            'status' =>  0
        ]);

        $data->status = "Declined";
        $data->save();

        $notification =  array('message' => 'Declined Successfully !', 'alert-type' => 'success');
        return back()->with($notification);
    }

    //Withdraw
    public function withdrawLog()
    {
        $data['status'] = "Confirmed";
        $data['exchange'] = $t = Transaction::where('type', 'Withdraw')->where('status', 'Confirmed')->with('method:*')->with('gateway:*')->latest()->get();
        //dd($t);
        $data['page_title'] = 'Confirmed Withdraw Log';
        return view('admin.finance.withdraw', $data);
    }
    public function pendingwithdrawLog()
    {
        $data['status'] = "Pending";
        $data['exchange'] = Transaction::where('type', 'Withdraw')->where('status', 'Pending')->with('method:*')->with('gateway:*')->latest()->get();
        $data['page_title'] = 'Pending Withdraw Log';
        return view('admin.finance.withdraw', $data);
    }
    public function declinedwithdrawLog()
    {
        $data['status'] = "Declined";
        $data['exchange'] = Transaction::where('type', 'Withdraw')->where('status', 'Declined')->with('method:*')->with('gateway:*')->latest()->get();
        $data['page_title'] = 'Declined Withdraw Log';
        return view('admin.finance.withdraw', $data);
    }
    public function withdrawInfo($id)
    {
        $get = Transaction::where('type', 'Withdraw')->with('method:*')->with('gateway:*')->where('id', $id)->first();
        if ($get) {
            $data['exchange'] = $get;
            $data['page_title'] = 'Withdraw Log Details';
            return view('admin.finance.withdraw-info', $data);
        }
        abort(404);
    }
    public function withdrawapprove($id)
    {
        $data = Transaction::where('type', 'Withdraw')->where('id', $id)->where('status', 'Pending')->first();
        $basic = GeneralSettings::first();
        $data->status = "Confirmed";

        $user = User::find($data->user_id);
        Message::create([
            'user_id' => $data->user_id,
            'title' => 'Withdraw Approved',
            'details' => 'Your withdraw request with transaction number ' . $data->trx . ' has been approved. You fund has been credited to your Naira Wallet Account as required. Thank you for choosing us',
            'admin' => 1,
            'status' =>  0
        ]);


        $msg =  ' Withdraw Amount  ' . $data->get_amount . ' ' . $basic->currency;
        send_email($user->email, $user->username, 'Withdraw Amount  ', $msg);

        $data->save();

        $notification =  array('message' => 'Withdraw Approved Successfully !', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function withdrawreject($id)
    {

        $data = Transaction::where('type', 'Withdraw')->where('id', $id)->where('status', '!=', 'Confirmed')->first();
        $basic = GeneralSettings::first();

        $user = User::find($data->user_id);
        $user->balance = $user->balance + $data->amount;
        $user->save();

        Message::create([
            'user_id' => $data->user_id,
            'title' => 'Withdraw Rejected',
            'details' => 'Your fund Withdraw was rejected. and your fund has been refunded, Please send us a message for any complain, thanks',
            'admin' => 1,
            'status' =>  0
        ]);

        $data->status = "Declined";
        $data->save();

        $notification =  array('message' => 'Declined Successfully !', 'alert-type' => 'success');
        return back()->with($notification);
    }


    public function socialLogin()
    {
        $data['page_title'] = 'Manage Social Login';
        $data['providers'] = Provider::all();
        return view('admin.social-login.index', $data);
    }

    public function socialLoginUpd(Request $request)
    {
        $data =  Provider::find($request->id);
        $data->client_id =  $request->name;
        $data->client_secret =  $request->account;
        $data->save();

        $notification =  array('message' => 'Updated Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
    }


    public function dashboard()
    {
        $data['page_title'] = 'DashBoard';
        //dd($data);

        $data['totalusers'] = \App\User::count();
        $data['banusers'] = \App\User::where('status', 0)->count();
        $data['verified'] = \App\User::where('verified', 2)->count();
        $data['activeusers'] = \App\User::where('status', 1)->count();
        $data['users'] = \App\User::where('status', 1)->take(5)->orderby('id', 'desc')->get();
        $data['inbox'] = \App\Message::where('view', 0)->where('admin', 0)->orderby('id', 'desc')->get();
        $data['trx'] = \App\Trx::take(3)->orderby('id', 'desc')->get();

        $data['gateway'] = \App\Gateway::count();
        $data['deposit'] = \App\Transaction::whereStatus(1)->where('type', 'Deposit')->count();
        $data['totalDeposit'] = \App\Transaction::whereStatus(1)->where('type', 'Deposit')->sum('amount');
        $data['totalWithdraw'] = \App\WithdrawLog::whereStatus(2)->sum('amount');
        $data['bal'] = \App\USer::sum('balance');
        $data['totalTransfer'] = \App\Transfer::whereStatus(1)->sum('amount');
        $data['blog'] = \App\Post::count();
        $data['subscribers'] = \App\Subscriber::count();



        $data['dpro'] = \App\Transaction::where('type', 'Deposit')->where('status', 'Confirmed')->sum('amount');
        $data['ddec'] = \App\Transaction::where('type', 'Deposit')->where('status', 'Declined')->sum('amount');
        $data['dcan'] = \App\Transaction::where('type', 'Deposit')->where('status', 'Cancelled')->sum('amount');
        $data['dpaid'] = \App\Transaction::where('type', 'Deposit')->where('status', 'Paid')->sum('amount');
        $data['dpend'] = \App\Transaction::where('type', 'Deposit')->where('status', 'Pending')->sum('amount');


        $data['ppro'] = \App\Transaction::where('type', 'Buy')->where('status', 'Confirmed')->sum('amount');
        $data['pdec'] = \App\Transaction::where('type', 'Buy')->where('status', 'Declined')->sum('amount');
        $data['pcan'] = \App\Transaction::where('type', 'Buy')->where('status', 'Cancelled')->sum('amount');
        $data['ppaid'] = \App\Transaction::where('type', 'Buy')->where('status', 'Paid')->sum('amount');
        $data['ppend'] = \App\Transaction::where('type', 'Buy')->where('status', 'Pending')->sum('amount');


        $data['spro'] = \App\Transaction::where('type', 'Sell')->where('status', 'Confirmed')->sum('amount');
        $data['sdec'] = \App\Transaction::where('type', 'Sell')->where('status', 'Declined')->sum('amount');
        $data['scan'] = \App\Transaction::where('type', 'Sell')->where('status', 'Cancelled')->sum('amount');
        $data['spaid'] = \App\Transaction::where('type', 'Sell')->where('status', 'Paid')->sum('amount');
        $data['spend'] = \App\Transaction::where('type', 'Sell')->where('status', 'Pending')->sum('amount');


        $data['wpro'] = \App\Transaction::where('type', 'Withdraw')->where('status', 'Confirmed')->sum('amount');
        $data['wdec'] = \App\Transaction::where('type', 'Withdraw')->where('status', 'Declined')->sum('amount');
        $data['wcan'] = \App\Transaction::where('type', 'Withdraw')->where('status', 'Cancelled')->sum('amount');
        $data['wpaid'] = \App\Transaction::where('type', 'Withdraw')->where('status', 'Paid')->sum('amount');
        $data['wpend'] = \App\Transaction::where('type', 'Withdraw')->where('status', 'Pending')->sum('amount');


        $data['currency'] = \App\Currency::count();
        return view('admin.dashboard', $data);
    }


    public function changePassword()
    {
        $data['page_title'] = "Change Password";
        return view('admin.change_password', $data);
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'password_confirmation' => 'required|same:new_password',
        ]);

        $user = Auth::guard('admin')->user();

        $oldPassword = $request->old_password;
        $password = $request->new_password;
        $passwordConf = $request->password_confirmation;

        if (!Hash::check($oldPassword, $user->password) || $password != $passwordConf) {
            $notification =  array('message' => 'Password Do not match !!', 'alert-type' => 'error');
            return back()->with($notification);
        } elseif (Hash::check($oldPassword, $user->password) && $password == $passwordConf) {
            $user->password = bcrypt($password);
            $user->save();
            $notification =  array('message' => 'Password Changed Successfully !!', 'alert-type' => 'success');
            return back()->with($notification);
        }
    }


    public function profile()
    {
        $data['admin'] = Auth::user();
        $data['page_title'] = "Profile Settings";
        return view('admin.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $data = Admin::find($request->id);
        $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|max:50|unique:admins,email,' . $data->id,
            'mobile' => 'required',
        ]);

        $in = Input::except('_method', '_token');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'admin_' . time() . '.jpg';
            $location = 'assets/admin/img/' . $filename;
            Image::make($image)->resize(300, 300)->save($location);
            $path = './assets/admin/img/';
            File::delete($path . $data->image);
            $in['image'] = $filename;
        }
        $data->fill($in)->save();

        $notification =  array('message' => 'Admin Profile Update Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }





    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->flash('message', 'Just Logged Out!');
        return redirect('/admin');
    }
}
