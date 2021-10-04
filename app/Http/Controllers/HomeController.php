<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BuyMoney;
use App\Currency;
use App\Deposit;
use App\Transaction;
use App\ExchangeMoney;
use App\PaymentMethod;
use App\Gateway;
use App\GeneralSettings;
use App\SellMoney;
use App\Trx;
use App\Faq;
use App\Verification;
use App\WithdrawLog;
use App\Banky;
use App\Message;
use App\Transfer;
use App\UserLogin;
use App\Post;
use App\Testimonial;
use App\WithdrawMethod;
use App\Cryptowallet;
use App\Lib\coinPayments;
use App\Lib\BlockIo;
use App\Lib\CoinPaymentHosted;
use Auth;
use App\User;
use App\Neto737\BitGoSDK\BitGoSDK;
use App\Neto737\BitGoSDK\Enum\CurrencyCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Session;
use Image;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $gates = Gateway::whereStatus(1)->orderBy('name', 'asc')->get();
        $this->middleware('auth');

        // Sharing is caring
        View::share('gates', $gates);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function createwallet()
    {
        $token = 'v2x1c5087ffd1e3a432ef9baedc54c80c946115f1d3eb0eb6b54d8e13b67025a9b1';
        $coin = CurrencyCode::BITCOIN_TESTNET;

        $bitgo = new BitGoSDK($token, $coin, true);
        $bitgo->walletId = 'testitnow';

        $createAddress = $bitgo->createWalletAddress();
        var_dump($createAddress);
    }





    public function index()
    {
        $data['page_title'] = "Dashboard";
        $user = Auth::user();
        $data['currency'] = Currency::whereStatus(1)->orderBy('name', 'asc')->get();
        $data['trx'] = $t = Transaction::where('user_id', Auth::id())->whereIn('type', ['Buy', 'Sell', 'Deposit', 'Withdraw'])->with('currency:*')->with('method:*')->with('gateway:*')->latest()->get();
        //dd($t);

        $data['coin_bought'] = Transaction::where('user_id', Auth::id())->where('Status', 'Confirmed')->where('type', 'Buy')->select('amount')->sum('amount');
        $data['buy_pending'] = Transaction::where('user_id', Auth::id())->where('Status', 'Pending')->where('type', 'Buy')->select('amount')->sum('amount');
        $data['buy_declined'] = Transaction::where('user_id', Auth::id())->where('Status', 'Declined')->where('type', 'Buy')->select('amount')->sum('amount');

        $data['coin_sales'] = Transaction::where('user_id', Auth::id())->where('Status', 'Confirmed')->where('type', 'Sell')->select('amount')->sum('amount');
        $data['sales_pending'] = Transaction::where('user_id', Auth::id())->where('Status', 'Pending')->where('type', 'Sell')->select('amount')->sum('amount');
        $data['sales_declined'] = Transaction::where('user_id', Auth::id())->where('Status', 'Declined')->where('type', 'Sell')->select('amount')->sum('amount');
        $data['sales_paid'] = Transaction::where('user_id', Auth::id())->where('Status', 'Paid')->where('type', 'Sell')->select('amount')->sum('amount');


        $data['deposit'] = Transaction::where('user_id', Auth::id())->where('Status', 'Confirmed')->where('type', 'Deposit')->select('amount')->sum('amount');
        $data['deposit_pending'] = Transaction::where('user_id', Auth::id())->where('Status', 'Pending')->where('type', 'Deposit')->select('amount')->sum('amount');
        $data['deposit_declined'] = Transaction::where('user_id', Auth::id())->where('Status', 'Declined')->where('type', 'Deposit')->select('amount')->sum('amount');


        $data['withdraw'] = Transaction::where('user_id', Auth::id())->where('Status', 'Confirmed')->where('type', 'Withdraw')->select('amount')->sum('amount');
        $data['withdraw_pending'] = Transaction::where('user_id', Auth::id())->where('Status', 'Pending')->where('type', 'Withdraw')->select('amount')->sum('amount');
        $data['withdraw_declined'] = Transaction::where('user_id', Auth::id())->where('Status', 'Declined')->where('type', 'Withdraw')->select('amount')->sum('amount');

        $data['paid'] = Transaction::where('user_id', Auth::id())->where('Status', 'Paid')->where('type', 'Deposit')->select('amount')->sum('amount');
        $data['buy'] = Trx::where('user_id', Auth::id())->whereStatus(2)->whereType(1)->select('main_amo')->sum('main_amo');;
        $data['bpend'] = Trx::where('user_id', Auth::id())->whereStatus(1)->whereType(1)->select('main_amo')->sum('main_amo');;
        $data['bcharge'] = Trx::where('user_id', Auth::id())->whereStatus(1)->whereType(1)->select('charge')->sum('charge');;
        $data['bacharge'] = Trx::where('user_id', Auth::id())->whereStatus(2)->whereType(1)->select('charge')->sum('charge');;
        $data['bdeccharge'] = Trx::where('user_id', Auth::id())->whereStatus(-2)->whereType(1)->select('charge')->sum('charge');;
        $data['bdecline'] = Trx::where('user_id', Auth::id())->whereStatus(-2)->whereType(1)->select('main_amo')->sum('main_amo');;
        $data['sell'] = Trx::where('user_id', Auth::id())->whereStatus(2)->whereType(0)->select('main_amo')->sum('main_amo');;
        $data['spend'] = Trx::where('user_id', Auth::id())->whereStatus(1)->whereType(0)->select('main_amo')->sum('main_amo');;
        $data['sdecline'] = Trx::where('user_id', Auth::id())->whereStatus(-2)->whereType(0)->select('main_amo')->sum('main_amo');;
        $data['time'] = Carbon::now();

        $crypt = Currency::all();

        foreach ($crypt as $coin) {
            $address = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890'), 0, 10);
            $exist = Cryptowallet::where('coin_id', $coin->id)->where('user_id', Auth::id())->count();
            if ($exist == 0) {

                $new['coin_id'] = $coin->id;
                $new['name'] = $coin->name;
                $new['address'] = '0';
                $new['user_id'] = Auth::id();
                $new['balance'] = '0';
                $new['status'] = '1';

                Cryptowallet::create($new);
            }
        }
        $basic = GeneralSettings::first();
        if ($basic->maintain == 1) {
            return view('front.maintain', $data);
        }

        return view('home', $data);
    }


    public function daily()
    {
        $user = Auth::user();
        $settings = GeneralSettings::first();
        $now = Carbon::now();

        if ($user->verified != 2) {
            return back()->withAlert('You are not eligible for daily bonus. Please proceed to verify your account first');
        }

        if ($user->time < $now) {

            $user->time = $now->addHours(24);
            $user->save();
            $user->bonus = $user->bonus + $settings->bonus;
            $user->save();

            return back()->withSuccess('You have Successfuly Claimed your daily ' . $settings->currency . '' . $settings->bonus . ' bonus. ');
        }

        return back()->withAlert('You have Alredy Claimed your ' . $settings->currency . '' . $settings->bonus . ' daily rewards already. Please come back tomorrow for more');
    }

    public function authCheck()
    {
        $basic = GeneralSettings::first();
        if ($basic->maintain == 1) {
            return view('front.maintain', $data);
        }


        if (Auth()->user()->status == '1' && Auth()->user()->email_verify == '1' && Auth()->user()->sms_verify == '1') {
            return redirect()->route('home');
        } else {
            $data['page_title'] = "Authorization";
            return view('user.authorization', $data);
        }
    }

    public function sendVcode(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if (Carbon::parse($user->phone_time)->addMinutes(1) > Carbon::now()) {
            $time = Carbon::parse($user->phone_time)->addMinutes(1);
            $delay = $time->diffInSeconds(Carbon::now());
            $delay = gmdate('i:s', $delay);
            session()->flash('danger', 'You can resend Verification Code after ' . $delay . ' minutes');
        } else {
            $code = strtoupper(Str::random(6));
            $user->phone_time = Carbon::now();
            $user->sms_code = $code;
            $user->save();
            send_sms($user->phone, $code);

            session()->flash('success', 'Verification Code Send successfully');
        }
        return back();
    }

    public function smsVerify(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($user->sms_code == $request->sms_code) {
            $user->phone_verify = 1;
            $user->save();
            session()->flash('success', 'Your Phone Number has been verfied successfully');
            return redirect()->route('home');
        } else {
            session()->flash('danger', 'Verification Code Did not match');
        }
        return back();
    }

    public function sendEmailVcode(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if (Carbon::parse($user->email_time)->addMinutes(1) > Carbon::now()) {
            $time = Carbon::parse($user->email_time)->addMinutes(1);
            $delay = $time->diffInSeconds(Carbon::now());
            $delay = gmdate('i:s', $delay);
            session()->flash('danger', 'You can resend Verification Code after ' . $delay . ' minutes');
        } else {
            $code = strtoupper(Str::random(6));
            $user->email_time = Carbon::now();
            $user->verification_code = $code;
            $user->save();
            send_email($user->email, $user->username, 'Verificatin Code', 'Your Verification Code is ' . $code);
            session()->flash('success', 'Verification Code Send successfully');
        }
        return back();
    }

    public function postEmailVerify(Request $request)
    {

        $user = User::find(Auth::user()->id);
        if ($user->verification_code == $request->email_code) {
            $user->email_verify = 1;
            $user->save();
            session()->flash('success', 'Your Profile has been verfied successfully');
            return redirect()->route('home');
        } else {
            session()->flash('danger', 'Verification Code Did not matched');
        }
        return back();
    }


    public function faqs()
    {
        $auth = Auth::user();
        $data['page_title'] = "FAQs";
        $data['faq'] = Faq::all();
        return view('user.faq', $data);
    }


    public function Profile()
    {
        $auth = Auth::user();
        $data['page_title'] = "Profile";
        $data['banks'] = DB::table('localbanks')->orderBy('bank', 'asc')->get();
        $data['user'] = User::findOrFail($auth->id);
        return view('user.profile', $data);
    }

    public function submitProfile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|min:10|unique:users,phone,' . $user->id,
            //
        ], [
            'fname.required' => 'First Name must not be empty',
            'lname.required' => 'Last Name must not be empty',
        ]);
        $in = Input::except('_method', '_token');
        $in['reference'] = $request->username;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $request->username . '.jpg';
            $location = 'assets/images/user/' . $filename;
            $in['image'] = $location;
            if ($user->image != 'user-default.png') {
                $path = './assets/images/user/';
                $link = $path . $user->image;
                if (file_exists($link)) {
                    @unlink($link);
                }
            }
            Image::make($image)->resize(800, 800)->save($location);
        }
        $user->fill($in)->save();
        return back()->with('success', 'Your Profile Has Been Updated Successfully.');
    }


    public function submitPassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {
            $c_password = Auth::user()->password;
            $c_id = Auth::user()->id;
            $user = User::findOrFail($c_id);
            if (Hash::check($request->current_password, $c_password)) {

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();

                return back()->with('success', 'Password Changes Successfully.');
            } else {
                return back()->with('danger', 'Current Password Not Match');
            }
        } catch (\PDOException $e) {
            return back()->with('danger', $e->getMessage());
        }
    }


    //Deposit Section
    public function deposit()
    {
        if (Auth::user()->verified != 2) {
            return redirect()->route('verification')->with('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
        }
        $data['basic'] = GeneralSettings::first();
        $data['page_title'] = "Payment Methods";
        $data['gates'] = Gateway::whereStatus(1)->get();
        return view('user.deposit', $data);
    }

    public function depositLog()
    {
        if (Auth::user()->verified != 2) {
            return redirect()->route('verification')->with('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
        }
        $user = Auth::user();
        $data['page_title'] = "Deposit Log";
        $data['invests'] = $d = Transaction::where('user_id', Auth::user()->id)->where('type', 'Deposit')->with('method:*')->with('gateway:*')->latest()->get();
        return view('user.deposit.log', $data);
    }

    public function create_deposit(Request $request)
    {
        if (Auth::user()->verified != 2) {
            return redirect()->route('verification')->with('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
        }
        if ($_POST) {
            $this->validate($request, [
                'amount' => 'required|numeric|min:20000',
                'payment_method' => 'required',
                'terms' => 'required',
                'method' => 'required_if:payment_method,==,2',
                'bank' => 'required_if:payment_method,==,2',
                'gateway' => 'required_if:payment_method,==,3',
            ], [
                'amount.min' => 'The minimum amount you can deposit is ₦20,000.00',
                'amount.required' => 'The deposit amount is required',
                'amount.numeric' => 'The deposit amount can only be numeric form',
                'payment_method.required' => 'The payment method is required',
                'terms.required' => 'You must Agree with the Terms to continue',
                'method.required_if' => 'The Bank Transfer Method is required',
                'bank.required_if' => 'You need to select a Bank',
                'gateway.required_if' => 'The Online Payment gateway is required',
            ]);

            //dd($request->all());
            if ($request->payment_method == "Bank Transfer") {
                $methods = PaymentMethod::where('id', $request->method)->first();
                $acc_details = Bank::find($request->bank);
                //dd($acc_details);
                // dd($methods->percent / 100 * $request->amount);
                $trx = strtoupper(str_random(16));
                $depo['user_id'] = Auth::id();
                $depo['type'] = "Deposit";
                $depo['trx'] = $trx;
                $depo['payment_method_id'] = $request->payment_method;
                $depo['method_id'] = $request->method;
                $depo['gateway_id'] = 0;
                $depo['amount'] = $request->amount + 1000;
                $depo['charge'] = 0;
                $depo['status'] = "Pending";
                $depo['bank'] = $acc_details->name;
                $depo['acc_num'] = $acc_details->account;
                $depo['acc_name'] = $acc_details->accname;

                Transaction::create($depo);

                Session::put('Track', $trx);

                return redirect()->route('deposit_preview');
            } else {
                $gate = Gateway::findOrFail($request->gateway);
                $basic = GeneralSettings::first();
                //dd($basic->rate);

                if (isset($gate)) {
                    if ($gate->minamo <= $request->amount && $gate->maxamo >= $request->amount) {
                        $charge = 0;
                        //dd($gate);
                        $trx = strtoupper(str_random(16));
                        $depo['user_id'] = Auth::id();
                        $depo['type'] = "Deposit";
                        $depo['trx'] = $trx;
                        $depo['payment_method_id'] = $request->payment_method;
                        $depo['gateway_id'] = $request->gateway;
                        $depo['amount'] = $request->amount;
                        $depo['charge'] = round($charge, 2);
                        $depo['status'] = "Pending";

                        Transaction::create($depo);

                        Session::put('Track', $trx);

                        return redirect()->route('deposit_preview');
                    } else {
                        return back()->with('danger', 'Please Follow Deposit Limit');
                    }
                } else {
                    return back()->with('danger', 'Please Select Deposit gateway');
                }
            }

            // if ($request->amount <= 500) {
            //     return back()->with('danger', 'Invalid Amount Entered');
            // }
        } else {
            $data['gates'] = $g = Gateway::whereStatus(1)->orderBy('name', 'asc')->get();
            $data['currency'] = Currency::whereStatus(1)->orderBy('name', 'asc')->get();
            $data['method'] = PaymentMethod::whereStatus(1)->orderBy('name', 'asc')->get();
            $data['bank'] = Bank::whereStatus(1)->orderBy('name', 'asc')->get();
            $data['page_title'] = "Deposit Naira Wallet";
            return view('user.deposit.index', $data);
        }
    }

    public function deposit_preview()
    {
        if (Auth::user()->verified != 2) {
            return redirect()->route('verification')->with('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
        }
        $data['basic'] = GeneralSettings::first();
        $data['page_title'] = "Preview Deposit Transaction";
        $data['data'] = $trans = Transaction::where('trx', Session::get('Track'))->where('user_id', Auth::user()->id)->where('status', 'Pending')->with('method:*')->with('gateway:*')->first();
        // dd($trans);
        if ($trans != null) {
            return view('user.deposit.preview', $data);
        } else {
            session()->flash('error', 'The Transaction can not be concluded, try again.');
            return redirect()->route('deposit');
        }
    }

    public function cancel_deposit($id)
    {
        if (Auth::user()->verified != 2) {
            return redirect()->route('verification')->with('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
        }
        $trans = Transaction::where('trx', $id)->where('status', 'Pending')->where('user_id', Auth::user()->id)->first();
        if ($trans != null) {
            $trans['status'] = 'Cancelled';
            $trans->save();
            session()->flash('success', 'The Transaction has been cancelled');
            return redirect()->route('deposit');
        } else {
            return redirect()->route('deposit');
        }
    }

    public function confirm_deposit($id)
    {
        if (Auth::user()->verified != 2) {
            return redirect()->route('verification')->with('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
        }
        $data['basic'] = GeneralSettings::first();
        $data['page_title'] = "Confirm Deposit Transaction";
        $data['data'] = $trans = Transaction::where('trx', $id)->where('status', 'Pending')->where('user_id', Auth::user()->id)->with('method:*')->first();
        // dd($trans);
        if ($trans != null) {
            if ($trans->status == "Pending") {
                if ($trans->gateway_id != null) {
                    $data['gate'] = Gateway::whereStatus(1)->where('id', $trans->gateway_id)->first();
                }
                return view('user.deposit.confirm', $data);
            } else {
                session()->flash('error', 'The Transaction Status is not Pending, check again.');
                return redirect()->route('deposit');
            }
        } else {
            session()->flash('error', 'The Transaction can not be concluded, try again.');
            return redirect()->route('deposit');
        }
    }

    public function confirm_deposit_save(Request $request)
    {
        if (Auth::user()->verified != 2) {
            return redirect()->route('verification')->with('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
        }
        $basic = GeneralSettings::first();
        $this->validate($request, [
            'trans_number' => 'required',
            'prove' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ], [
            'prove.required' => 'The Transaction Attachment Prove is required',
            'trans_number.required' => 'The Transaction Number is required',
        ]);
        $trans = Transaction::where('trx', $request->trx)->where('status', 'Pending')->where('user_id', Auth::user()->id)->first();
        // dd($trans);
        if ($trans != null) {
            if ($trans->status == "Pending") {
                if ($request->hasFile('prove')) {
                    $trans->image = uniqid() . '.jpg';
                    $request->prove->move('transaction_proves', $trans->image);
                }
                $trans->status = "Paid";
                $trans->trans_prove_num = $request->trans_number;
                $trans->save();

                Message::create([
                    'user_id' => Auth::id(),
                    'title' => 'Deposit To Naira Wallet',
                    'details' => 'Your Deposit to your Naira Wallet of ' . $basic->currency_sym . $trans->amount . ' of Transaction ID of ' . $trans->trx . ' was successful. Your account will be credited once payment is confirmed by Admin, Thank you for choosing us',
                    'admin' => 1,
                    'status' =>  0
                ]);
                return redirect()->route('deposit')->with("success", "  Your Deposit was successful,  awaiting Admin Approver for Confirmation");
            } else {
                session()->flash('error', 'The Transaction Status is not Pending, check again.');
                return redirect()->route('deposit');
            }
        } else {
            session()->flash('error', 'The Transaction is not found.');
            return redirect()->route('deposit');
        }
    }

    public function paystack_save(Request $request)
    {
        if (Auth::user()->verified != 2) {
            return redirect()->route('verification')->with('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
        }
        $basic = GeneralSettings::first();
        if ($request->trx != null) {
            $trans = Transaction::where('trx', $request->trx)->where('status', 'Pending')->where('user_id', Auth::user()->id)->first();
            $trans->status = "Confirmed";
            $trans->save();

            $user = User::find(Auth::user()->id);
            $user->balance = $user->balance + $trans->amount;
            $user->save();

            Message::create([
                'user_id' => Auth::id(),
                'title' => 'Deposit To Naira Wallet',
                'details' => 'Your Deposit to your Naira Wallet of ' . $basic->currency_sym . $trans->amount . ' of Transaction ID of ' . $trans->trx . ' was successful. Your account will be credited once payment is confirmed by Admin, Thank you for choosing us',
                'admin' => 1,
                'status' =>  0
            ]);

            $txt = $basic->currency_sym . $trans->amount . ' Deposited Amount ';
            send_email(Auth::user()->email, Auth::user()->username, 'Deposited Amount', $txt);
            return redirect()->route('deposit')->with("success", "  Your Deposit was successful");
        } else {
            session()->flash('error', 'The Transaction can not be concluded, try again.');
            return redirect()->route('deposit');
        }
    }

    public function rave_save(Request $request)
    {
        if (Auth::user()->verified != 2) {
            return redirect()->route('verification')->with('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
        }
        $basic = GeneralSettings::first();
        if ($request->trx != null) {
            $trans = Transaction::where('trx', $request->trx)->where('status', 'Pending')->where('user_id', Auth::user()->id)->first();
            $trans->status = "Confirmed";
            $trans->save();

            $user = User::find(Auth::user()->id);
            $user->balance = $user->balance + $trans->amount;
            $user->save();

            Message::create([
                'user_id' => Auth::id(),
                'title' => 'Deposit To Naira Wallet',
                'details' => 'Your Deposit to your Naira Wallet of ' . $basic->currency_sym . $trans->amount . ' of Transaction ID of ' . $trans->trx . ' was successful. Your account will be credited once payment is confirmed by Admin, Thank you for choosing us',
                'admin' => 1,
                'status' =>  0
            ]);

            $txt = $basic->currency_sym . $trans->amount . ' Deposited Amount ';
            send_email(Auth::user()->email, Auth::user()->username, 'Deposited Amount', $txt);
            return redirect()->route('deposit')->with("success", "  Your Deposit was successful");
        } else {
            session()->flash('error', 'The Transaction can not be concluded, try again.');
            return redirect()->route('deposit');
        }
    }


    //Buy
    public function buycoin()
    {
        if (Auth::user()->verified != 2) {
            session()->flash('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
            return redirect()->route('verification');
        }
        $get['gates'] = $g = Gateway::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['currency'] = Currency::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['method'] = PaymentMethod::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['bank'] = Bank::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['page_title'] = " Buy E-Currency";
        return view('user.buy.index', $get);
    }

    public function confirm_buy_first($id)
    {
        if (Auth::user()->verified != 2) {
            session()->flash('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
            return redirect()->route('verification');
        }
        $get['basic'] = $basic = GeneralSettings::first();
        if ($id != null) {
            $get['currency'] = $g = Currency::whereStatus(1)->where('id', $id)->first();
            Session::put('currency_buy', $g->id);
            return redirect()->route('confirm_buy');
        } else {
            return redirect()->route('buy');
        }
    }

    public function confirm_buy(Request $request)
    {
        if (Auth::user()->verified != 2) {
            session()->flash('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
            return redirect()->route('verification');
        }
        $get['basic'] = $basic = GeneralSettings::first();
        $coin = $g = Currency::whereStatus(1)->where('id', $request->coin)->first();
        //dd($g);
        if ($_POST) {
            //dd($request->all());
            $this->validate($request, [
                'amount' => 'required',
                'wallet' => 'required',
                'rewallet' => 'required|same:wallet',
            ], [
                'wallet.required' => 'The Wallet Address / Account ID is required',
                'rewallet.required' => 'The Retype Wallet Address / Account ID is required',
                'rewallet.same' => 'The Retype Wallet Address / Account ID did not match',
                'amount.required' => 'Amount is required',
                // 'amount.min' => 'Amount must not less than ₦500',
            ]);
            if ($request->amount > Auth::user()->balance) {
                Session::flash('error', 'Not enough balance in your Naira Wallet, fund it and try again');
                return redirect('user/buy-coin');
            }
            if ($g != null) {
                $trx = strtoupper(str_random(16));
                $depo['user_id'] = Auth::id();
                $depo['type'] = "Buy";
                $depo['trx'] = $trx;
                $depo['gateway_id'] = 0;
                $depo['amount'] = $request->amount;
                $depo['currency_id'] = $request->coin;
                $depo['wallet'] = $request->wallet;
                $depo['currency_amount_usd'] = $request->usd;
                $depo['currency_rate'] = $request->coin_rate;
                $depo['status'] = "Pending";

                Transaction::create($depo);

                $user = User::find(Auth::user()->id);
                $user->balance = $user->balance - $request->amount;
                $user->save();

                Message::create([
                    'user_id' => Auth::id(),
                    'title' => 'Deposit To Naira Wallet',
                    'details' => 'Your Buy Request Transaction of ' . $basic->currency_sym . $request->amount . ' of ' . $coin->symbol . ' was successful. Your Wallet will be credited once payment is confirmed by Admin, Thank you for choosing us',
                    'admin' => 1,
                    'status' =>  0
                ]);
                return redirect()->route('transaction')->with("success", "  Your Buy Request was successful,  awaiting Admin Approver for Confirmation");
            } else {
                Session::flash('error', 'The coin is not available to buy at the moment, Try again later');
                return redirect()->route('transaction');
            }
        } else {
            if (Session::get('currency_buy') != null) {
                $get['currency'] = $g = Currency::whereStatus(1)->where('id', Session::get('currency_buy'))->first();
                if ($g != null) {
                    //dd($g);
                    $get['gates'] = $g = Gateway::whereStatus(1)->orderBy('name', 'asc')->get();
                    $get['method'] = PaymentMethod::whereStatus(1)->orderBy('name', 'asc')->get();
                    $get['bank'] = Bank::whereStatus(1)->orderBy('name', 'asc')->get();
                    $get['page_title'] = "Confrim Buy Transaction";
                    return view('user.buy.confirm', $get);
                } else {
                    return redirect('user/buy-coin');
                }
            } else {
                return redirect('user/buy-coin');
            }
        }
    }


    public function sellcoin()
    {
        if (Auth::user()->verified != 2) {
            return redirect()->route('verification')->with('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
        }
        $get['localbanks'] = DB::table('localbanks')->get();
        $get['page_title'] = "Sell Currency";
        $get['currency'] = Currency::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['method'] = PaymentMethod::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['gates'] = $g = Gateway::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['bank'] = Bank::whereStatus(1)->orderBy('name', 'asc')->get();
        //dd($g);
        return view('user.sell.index', $get);
    }

    public function sell_form($id)
    {
        if (Auth::user()->verified != 2) {
            session()->flash('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
            return redirect()->route('verification');
        }
        $data['currency'] = $coin = Currency::whereStatus(1)->where('id', $id)->first();
        if ($coin != null) {
            return view('user.sell.form', $data);
        } else {
            return redirect()->route('sell')->with("error", "Transaction can not be confirmed");
        }
    }


    public function confirm_sell(Request $request)
    {
        if (Auth::user()->verified != 2) {
            session()->flash('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
            return redirect()->route('verification');
        }
        $get['basic'] = $basic = GeneralSettings::first();
        $coin = $g = Currency::whereStatus(1)->where('id', $request->coin)->first();
        //dd($g);
        if ($_POST) {
            //dd($request->all());
            $this->validate($request, [
                'amount' => 'required',
            ], [
                'amount.required' => 'Amount is required',
            ]);
            if ($request->amount < 500) {
                return redirect()->route('sell')->with('warning', 'The Mininmum Amount to sell is ₦500');;
            }
            if ($g != null) {
                $trx = strtoupper(str_random(16));
                $depo['user_id'] = Auth::id();
                $depo['type'] = "Sell";
                $depo['trx'] = $trx;
                $depo['gateway_id'] = 0;
                $depo['amount'] = $request->amount;
                $depo['currency_id'] = $request->coin;
                $depo['currency_amount_usd'] = $request->usd;
                $depo['currency_rate'] = $request->coin_rate;
                $depo['status'] = "Pending";

                Transaction::create($depo);

                return redirect()->route('sell_get', $trx);
                // ->with("success", "  Your Sell Request was successful,  awaiting Admin Approver for Confirmation");

            } else {
                Session::flash('error', 'The coin is not available to buy at the moment, Try again later');
                return redirect()->route('sell');
            }
        } else {
            return redirect('user/buy-coin');
        }
    }

    public function cancel_sell($id)
    {
        if (Auth::user()->verified != 2) {
            session()->flash('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
            return redirect()->route('verification');
        }
        $trans = Transaction::where('trx', $id)->where('status', 'Pending')->where('user_id', Auth::user()->id)->first();
        if ($trans != null) {
            $trans['status'] = 'Cancelled';
            $trans->save();
            session()->flash('success', 'The Transaction has been cancelled');
            return redirect()->route('sell');
        } else {
            return redirect()->route('sell');
        }
    }

    public function sell_get($id)
    {
        if (Auth::user()->verified != 2) {
            session()->flash('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
            return redirect()->route('verification');
        }
        $data['basic'] = $basic = GeneralSettings::first();
        $data['data'] = $data = Transaction::where('user_id', Auth::user()->id)->where('status', 'Pending')->where('trx', $id)->with('currency:*')->first();
        if ($data != null) {
            return view('user.sell.saved', $data);
        } else {
            return redirect()->route('sell')->with('warning', 'The Transaction is not found or has been processed');
        }
    }

    public function save_sell(Request $request)
    {
        if (Auth::user()->verified != 2) {
            session()->flash('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
            return redirect()->route('verification');
        }
        $g = Transaction::where('trx', $request->id)->where('status', 'Pending')->where('user_id', Auth::user()->id)->first();
        //dd($request->all());        
        $basic = GeneralSettings::first();
        $this->validate($request, [
            'trans_number' => 'required',
            'prove' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ], [
            'prove.required' => 'The Transaction Attachment Prove is required',
            'trans_number.required' => 'The Transaction Number is required',
        ]);
        $trans = Transaction::where('trx', $request->trx)->where('status', 'Pending')->where('user_id', Auth::user()->id)->with('currency:*')->first();
        // dd($trans);
        if ($trans != null) {
            if ($trans->status == "Pending") {
                if ($request->hasFile('prove')) {
                    $trans->image = uniqid() . '.jpg';
                    $request->prove->move('transaction_proves', $trans->image);
                }
                $trans->status = "Paid";
                $trans->trans_prove_num = $request->trans_number;
                $trans->save();


                Message::create([
                    'user_id' => Auth::id(),
                    'title' => 'Sell To Naira Wallet',
                    'details' => 'Your Sell Request Transaction of ' . $basic->currency_sym . $request->amount . ' of ' . $trans->currency->symbol . ' was successful. Your transaction will be confirmed by Admin, Thank you for choosing us',
                    'admin' => 1,
                    'status' =>  0
                ]);
                return redirect()->route('transaction')->with("success", "  Your Sell was successful,  awaiting Admin Approver for Confirmation");
            } else {
                session()->flash('warning', 'The Transaction Status is not Pending, check again.');
                return redirect()->route('sell');
            }
        } else {
            session()->flash('error', 'The Transaction is not found.');
            return redirect()->route('sell');
        }
    }

    //Withdraw
    public function withdraw(Request $request)
    {
        //dd($request->all());
        if (Auth::user()->verified != 2) {
            return redirect()->route('verification')->with('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
        }
        if ($_POST) {
            $this->validate($request, [
                'amount' => 'required|numeric|min:20000',
                'terms' => 'required',
                'confirm' => 'required',
                'confirm_fee' => 'required',
            ], [
                'amount.min' => 'The minimum amount you can withdraw is ₦20,000.00',
                'amount.required' => 'The Amount to withdraw is required',
                'terms.required' => 'Terms and Agreement is required',
                'confirm.required' => 'Confirm Details is required',
                'confirm_fee.required' => 'Transaction Fee Confirmation is required',
            ]);
            if (($request->amount + 1000) > Auth::user()->balance) {
                return back()->with('warning', 'You do not have upto the requested amount in Naira Wallet');
            }
            $user = User::find(Auth::user()->id);
            $user->balance = $user->balance - $request->amount - 1000;
            $user->save();


            $trx = strtoupper(str_random(16));
            $depo['user_id'] = Auth::id();
            $depo['type'] = "Withdraw";
            $depo['trx'] = $trx;
            $depo['amount'] = $request->amount;
            $depo['bank'] = Auth::user()->bank;
            $depo['acc_name'] = Auth::user()->accountname;
            $depo['acc_num'] = Auth::user()->accountno;
            $depo['currency_amount_usd'] = $request->usd;
            $depo['status'] = "Pending";

            Transaction::create($depo);

            return redirect('user/withdraw-history')->with('success', 'Your Withdraw request has been placed, Your request will be processed, Thank you.');
        } else {
            $data['gates'] = $g = Gateway::whereStatus(1)->orderBy('name', 'asc')->get();
            $data['currency'] = Currency::whereStatus(1)->orderBy('name', 'asc')->get();
            $data['method'] = PaymentMethod::whereStatus(1)->orderBy('name', 'asc')->get();
            $data['bank'] = Bank::whereStatus(1)->orderBy('name', 'asc')->get();
            return view('user.withdraw.index', $data);
        }
    }

    public function withdraw_log()
    {
        if (Auth::user()->verified != 2) {
            return redirect()->route('verification')->with('error', 'You are not eligible to buy cryptocurrency. Please verify your account first');
        }
        $user = Auth::user();
        $data['page_title'] = "Withdraw Log";
        $data['invests'] = $d = Transaction::where('user_id', Auth::user()->id)->where('type', 'Withdraw')->latest()->get();
        return view('user.withdraw.log', $data);
    }

    public function check_bank(Request $request)
    {
        $this->validate($request, [
            'bank' => 'required',
            'acctnumber' => 'required',
        ], [
            'bank.required' => 'Select your bank',
            'acctnumber.required' => 'Account Number is required',
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $gate = Gateway::whereId(107)->first();
        $bankCode = $request->bank;
        $bank = Banky::whereCode($request->bank)->first();
        $bankname = $bank->bank;

        $AccountID = "$request->acctnumber";
        $baseUrl = "https://api.paystack.co";
        $endpoint = "/bank/resolve?account_number=" . $AccountID . "&bank_code=" . $bankCode;
        $httpVerb = "GET";
        $contentType = "application/json"; //e.g charset=utf-8
        $authorization = "$gate->val2"; //gotten from paystack dashboard


        $headers = array(
            "Content-Type: $contentType",
            "Authorization: Bearer $authorization"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = json_decode(curl_exec($ch), true);
        $err     = curl_errno($ch);
        $errmsg  = curl_error($ch);

        curl_close($ch);

        if ($content['status']) {
            $response['account_name'] = $content['data']['account_name'];
            $bname =  $response['account_name'];
            $user->bank = $bank->bank;
            $user->accountno = $AccountID;
            $user->accountname = $bname;
            $user->save();
            return back()->with('success', 'Account Details Verified and saved Successfully');
        } else {
            return back()->with('danger', 'Account Number Not Registered With ' . $bankname . '');
        }
    }



    public function activitylog()
    {
        $data['page_title'] = " Activities";
        $data['activity'] = UserLogin::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('user.activity-log', $data);
    }


    public function referral()
    {
        $data['referral'] =  User::whereRefer(Auth::user()->id)->get();
        $data['page_title'] = "Referral Log";
        return view('user.referral-log', $data);
    }



    public function kyc()
    {
        $data['user'] =  Auth::user()->id;
        $data['page_title'] = "Account Verification";
        $data['docs'] = $u = Verification::where('user_id', Auth::id())->latest()->first();
        //dd($u);
        return view('user.account-verification', $data);
    }



    public function kyc2(Request $request)
    {

        $this->validate(
            $request,
            [
                'type' => 'required',
                'date' => 'required',
                'number' => 'required',
                'img_shot' => 'required',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'photo2' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ],
            [
                'type.required' => 'Document Type must not be empty',
                'date.required' => 'ID Expiry Date must not be empty',
                'number.required' => 'ID Number must not be empty',
                'img_shot.required' => 'Your Selfie shot is required',
                'photo.required' => 'The Front View Of Document is required',
                'photo.image' => 'The Front View Of Documen must be Image',
                'photo2.required' => 'Picture Of You Holding The Document is required',
                'photo2.image' => 'Picture Of You Holding The Document must be Image',
            ]
        );

        $docm['user_id'] = Auth::id();
        $docm['type'] = $request->type;
        $docm['date'] = $request->date;
        $docm['number'] = $request->number;
        $docm['status'] = 0;
        $docm['selfie'] = $request->img_shot;

        if ($request->hasFile('photo')) {
            $docm['image1'] = uniqid() . '.jpg';
            $request->photo->move('kyc', $docm['image1']);
        }
        if ($request->hasFile('photo2')) {
            $docm['image2'] = uniqid() . '.jpg';
            $request->photo2->move('kyc', $docm['image2']);
        }

        Verification::create($docm);

        $user = User::find(Auth::id());
        $user['verified'] = 1;
        $user->save();


        Message::create([
            'user_id' => $user->id,
            'title' => 'KYC Submited',
            'details' => 'Your KYC submission has been received. Please wait while we verify your submissin. You will receive a message once your submission has been approved',
            'admin' => 1,
            'status' =>  0
        ]);




        session()->flash('success', 'Account Verification Request Sent Successfully. ');

        return redirect()->route('home');
    }



    public function bank()
    {
        $data['user'] =  Auth::user()->id;
        $data['page_title'] = "Bank Account";
        return view('user.bank', $data);
    }


    public function postbank(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        if (isset($request->paypal)) {
            $user->paypal = $request->paypal;
            $user->save();
        }

        $gate = Gateway::whereId(107)->first();
        $bankCode = "$request->bank"; //bank CBN code https://bank.codes/api-nigeria-nuban/
        $bank = Banky::whereCode($bankCode)->first();
        $bankname = $bank->bank;

        $AccountID = "$request->accountno"; //NUBAN account number
        $baseUrl = "https://api.paystack.co";
        $endpoint = "/bank/resolve?account_number=" . $AccountID . "&bank_code=" . $bankCode;
        $httpVerb = "GET";
        $contentType = "application/json"; //e.g charset=utf-8
        $authorization = "$gate->val2"; //gotten from paystack dashboard


        $headers = array(
            "Content-Type: $contentType",
            "Authorization: Bearer $authorization"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = json_decode(curl_exec($ch), true);
        $err     = curl_errno($ch);
        $errmsg  = curl_error($ch);

        curl_close($ch);

        if ($content['status']) {
            $response['account_name'] = $content['data']['account_name'];
            $bname =  $response['account_name'];

            $user->bank = 'Bank Name: ' . $bankname . ', Account Number: ' . $AccountID . ', Account Name: ' . $bname . '';
            $user->save();
        } else {

            return back()->with('danger', 'Account Number Not Registered With ' . $bankname . '');
        }

        return back()->with('success', 'Bank Account Updated Successfuly');
    }

    public function veribank(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $gate = Gateway::whereId(107)->first();
        $bankCode = $request->bank;
        $bank = Banky::whereCode($request->bank)->first();
        $bankname = $bank->bank;

        $AccountID = "$request->accountno";
        $baseUrl = "https://api.paystack.co";
        $endpoint = "/bank/resolve?account_number=" . $AccountID . "&bank_code=" . $bankCode;
        $httpVerb = "GET";
        $contentType = "application/json"; //e.g charset=utf-8
        $authorization = "$gate->val2"; //gotten from paystack dashboard


        $headers = array(
            "Content-Type: $contentType",
            "Authorization: Bearer $authorization"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = json_decode(curl_exec($ch), true);
        $err     = curl_errno($ch);
        $errmsg  = curl_error($ch);

        curl_close($ch);

        if ($content['status']) {
            $response['account_name'] = $content['data']['account_name'];
            $bname =  $response['account_name'];

            $user->bank = $bank->bank;
            $user->accountno = $AccountID;
            $user->accountname = $bname;
            $user->save();
            session()->flash('ready', 'Verification Code Did not matched');
            return back()->with('success', 'Account Number Is Valid');
        } else {

            return back()->with('danger', 'Account Number Not Registered With ' . $bankname . '');
        }
    }

    public function validatebank($id)
    {
        $user = User::whereAccountno($id)->first();
        $user->bankyes = 1;
        $user->save();
        return back()->with('success', 'Bank Details Addes Successfully');
    }



    public function depositDataInsert(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:1',
            'gateway' => 'required',
        ]);
        $basic = GeneralSettings::first();
        if ($request->amount <= 0) {
            return back()->with('danger', 'Invalid Amount Entered');
        }
        if ($request->gateway == "bank") {
            $usdamo = ($request->amount + 0) / $basic->rate;
            $depo['user_id'] = Auth::id();
            $depo['gateway_id'] = 0;
            $depo['amount'] = $request->amount;
            $depo['charge'] = 0;
            $depo['usd'] = round($usdamo, 2);
            $depo['btc_amo'] = 0;
            $depo['btc_wallet'] = "";
            $depo['trx'] = str_random(16);
            $depo['try'] = 0;
            $depo['status'] = 0;
            Deposit::create($depo);

            Session::put('Track', $depo['trx']);

            return redirect()->route('user.deposit.preview');
        } else {
            $gate = Gateway::findOrFail($request->gateway);

            if (isset($gate)) {
                if ($gate->minamo <= $request->amount && $gate->maxamo >= $request->amount) {
                    $charge = 0;
                    $usdamo = ($request->amount + $charge) / $basic->rate;


                    $depo['user_id'] = Auth::id();
                    $depo['gateway_id'] = $gate->id;
                    $depo['amount'] = $request->amount;
                    $depo['charge'] = $charge;
                    $depo['usd'] = round($usdamo, 2);
                    $depo['btc_amo'] = 0;
                    $depo['btc_wallet'] = "";
                    $depo['trx'] = str_random(16);
                    $depo['try'] = 0;
                    $depo['status'] = 0;
                    Deposit::create($depo);

                    Session::put('Track', $depo['trx']);

                    return redirect()->route('user.deposit.preview');
                } else {
                    return back()->with('danger', 'Please Follow Deposit Limit');
                }
            } else {
                return back()->with('danger', 'Please Select Deposit gateway');
            }
        }
    }

    public function depositPreview()
    {

        $track = Session::get('Track');
        $data = Deposit::where('status', 0)->where('trx', $track)->first();
        $page_title = "Deposit Preview";
        $auth = Auth::user();
        return view('user.payment.preview', compact('data', 'page_title'));
    }


    public function wallet()
    {
        $data['page_title'] = "Crypto Wallets";
        $data['wallet'] = Cryptowallet::where('user_id', Auth::id())->orderBy('name', 'asc')->get();
        return view('user.wallet', $data);
    }


    public function updatewallet(Request $request)
    {
        $wallet = Cryptowallet::findOrFail($request->wallet);
        $wallet->address = $request->address;
        $wallet->save();

        return back()->with('success', 'Wallet Address Updated Successfully.');


        return view('user.wallet', $data);
    }





    public function convertbonus()
    {
        $data['page_title'] = "Convert Bonus";
        return view('user.convert', $data);
    }



    public function updateconvert(Request $request)
    {
        $basic = GeneralSettings::first();
        $this->validate($request, [
            'amount' => 'required|numeric|min:' . $basic->minbonus . '',
        ], [
            'amount.required' => 'The minimum amount you can convert is ' . $basic->currency . '' . $basic->minbonus . ' '
        ]);
        $user = Auth::user();

        if ($request->amount > $user->bonus) {
            return back()->with('alert', 'You Cant Convert An Amount Greater Than Your Current Bonus Balance.');
        }



        $tr = strtoupper(str_random(20));
        Trx::create([
            'user_id' =>  Auth::user()->id,
            'amount' => round($request->amount, $basic->decimal),
            'charge' => 0,
            'type' => '+',
            'reffer' => 1,
            'action' => "Convert",
            'title' => 'Converted Bonus To Spendable Fund',
            'trx' => $tr
        ]);


        $user->balance = $user->balance + $request->amount;
        $user->bonus = $user->bonus - $request->amount;
        $user->save();
        return back()->with('success', 'Bonus Cpnverted Successfuly.');
    }

    public function transfer()
    {
        $data['page_title'] = "Transfer Fund";
        return view('user.transfer', $data);
    }


    public function updatetransfer(Request $request)
    {
        $user = Auth::user();
        $basic = GeneralSettings::first();
        if ($request->amount > $user->balance) {
            return back()->with('alert', 'You Cant Transfer An Amount Greater Than Your Current Balance.');
        }

        $count = User::whereUsername($request->username)->count();
        if ($count < 1) {
            return back()->with('alert', 'There is no username with such username on ' . $basic->sitename . ' Please re-check and try again.');
        }

        if ($count > 0) {
            $receiver = User::whereUsername($request->username)->first();

            if ($user->username == $request->username) {
                return back()->with('alert', 'You cant transfer fund to the same wallet.  Please re-check and try again.');
            }



            $receiver->balance = $receiver->balance + $request->amount;
            $receiver->save();
        }

        $tr = strtoupper(str_random(20));
        $w['amount'] = $request->amount;
        $w['transaction_id'] = $tr;
        $w['user_id'] = Auth::user()->id;
        $w['send_details'] = $request->username;
        $w['status'] = 2;
        $trr = Transfer::create($w);


        Trx::create([
            'user_id' =>  Auth::user()->id,
            'amount' => round($request->amount, $basic->decimal),
            'charge' => 0,
            'type' => '-',
            'reffer' => 1,
            'action' => "Transfer",
            'title' => 'Transfer fund to ' . $request->username,
            'trx' => $tr
        ]);


        $user->balance = $user->balance - $request->amount;
        $user->save();
        return back()->with('success', 'Fund transfered to ' . $request->username . ' successfully.');
    }
    public function transferlog()
    {
        $data['transfer'] = Transfer::where('user_id', Auth::id())->get();
        return view('user.transfer-log', $data);
    }




    public function withdrawMoney()
    {
        $data['withdrawMethod'] = WithdrawMethod::where('id', '>', 1)->orderBy('name', 'asc')->get();
        $data['withdrawMethod1'] = WithdrawMethod::whereId(1)->orderBy('name', 'asc')->get();
        $data['page_title'] = "Withdraw Money";
        $data['wallet'] = Cryptowallet::where('user_id', Auth::id())->orderBy('name', 'asc')->get();
        return view('user.withdraw-money', $data);
    }

    public function requestcrypto(Request $request)
    {
        $this->validate($request, [
            'method_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'wallet' => 'required'
        ]);
        $basic = GeneralSettings::first();
        $wallet = Cryptowallet::findOrFail($request->wallet);


        $method = WithdrawMethod::findOrFail($request->method_id);
        $currency = Currency::findOrFail($wallet->coin_id);
        $ch = 0;
        $reAmo = $request->amount + $ch;
        if ($wallet->address == 0) {
            return back()->with('alert', 'You need to update your ' . $wallet->name . ' wallet details before you can withdraw from your ' . $wallet->name . ' wallet.');
        }
        if ($reAmo < $method->withdraw_min) {
            return back()->with('alert', 'The Requested Amount is Smaller Than Withdraw Minimum Amount.');
        }
        if ($reAmo > $method->withdraw_max) {
            return back()->with('alert', 'The Requested Amount is Larger Than Withdraw Maximum Amount.');
        }
        if ($reAmo > $wallet->balance) {
            return back()->with('alert', 'The Request Amount is More Than Your ' . $wallet->name . ' Wallet Current Balance.');
        }

        $tr = strtoupper(str_random(20));
        $w['amount'] = $request->amount;
        $w['method_id'] = $request->method_id;
        $w['charge'] = $ch;
        $w['transaction_id'] = $tr;
        $w['net_amount'] = $reAmo;
        $w['user_id'] = Auth::user()->id;
        $w['currency_id'] = $currency->id;
        $w['wallet_id'] = $request->wallet;
        $trr = WithdrawLog::create($w);
        $data['withdraw'] = $trr;
        Session::put('wtrx', $trr->transaction_id);

        $data['method'] = $method;
        $data['amount'] = $request->amount;
        $data['charge'] = $ch;
        $data['wallet'] = Cryptowallet::findOrFail($request->wallet);;

        $data['page_title'] = "Withdraw Preview";
        return view('user.withdraw-crypto', $data);
    }


    public function requestwithdrawal(Request $request)
    {
        $this->validate($request, [
            'method_id' => 'required|numeric',
            'amount' => 'required|numeric|min:1',
            'wallet' => 'required'
        ]);
        $basic = GeneralSettings::first();
        $user = Auth::user();
        $method = WithdrawMethod::findOrFail($request->method_id);
        $ch = 0;
        $reAmo = $request->amount + $ch;

        if ($request->method_id == 2) {
            if ($user->paypal == "Not Set") {
                return back()->with('alert', 'You need to update your Paypal Account details before you can withdraw using Paypal.');
            }
        }
        if ($request->method_id == 3) {
            if ($user->bank == "Not Set") {
                return back()->with('alert', 'You need to update your Bank Account details before you can withdraw using Bank Transfer.');
            }
        }
        if ($reAmo < $method->withdraw_min) {
            return back()->with('alert', 'The Requested Amount is Smaller Than Withdraw Minimum Amount.');
        }
        if ($reAmo > $method->withdraw_max) {
            return back()->with('alert', 'The Requested Amount is Larger Than Withdraw Maximum Amount.');
        }
        if ($reAmo > $user->balance) {
            return back()->with('alert', 'The Request Amount is More Than Your Deposit Wallet Current Balance.');
        }

        $tr = strtoupper(str_random(20));
        $w['amount'] = $request->amount;
        $w['method_id'] = $request->method_id;
        $w['charge'] = $ch;
        $w['transaction_id'] = $tr;
        $w['net_amount'] = $reAmo;
        $w['user_id'] = Auth::user()->id;
        $trr = WithdrawLog::create($w);
        $data['withdraw'] = $trr;
        Session::put('wtrx', $trr->transaction_id);

        $data['method'] = $method;
        $data['amount'] = $request->amount;
        $data['charge'] = $ch;

        $data['page_title'] = "Withdraw Preview";
        return view('user.withdraw-fiat', $data);
    }


    public function requestSubmit(Request $request)
    {
        $basic = GeneralSettings::first();
        $this->validate($request, [
            'withdraw_id' => 'required|numeric',
            'send_details' => 'required'
        ]);

        $ww = WithdrawLog::findOrFail($request->withdraw_id);
        $ww->send_details = $request->send_details;
        $ww->message = $request->message;
        $ww->status = 1;
        $ww->save();

        $user = Auth::user();
        $user->balance = $user->balance - $ww->net_amount;
        $user->save();

        $trx = Trx::create([
            'user_id' => $user->id,
            'amount' => $ww->amount,
            'main_amo' => round($user->balance, $basic->decimal),
            'charge' => 0,
            'type' => '-',
            'action' => 'Withdraw',
            'title' => 'Withdraw Via ' . $ww->method->name,
            'trx' => $ww->transaction_id
        ]);

        $text = $ww->amount . " - " . $basic->currency . " Withdraw Request Send via " . $ww->method->name . ". <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
        notify($user, 'Withdraw Via ' . $ww->method->name, $text);
        return redirect()->route('user.withdrawLog')->with('success', 'Withdraw request has been successfully submitted. Please Wait For Confirmation.');
    }



    public function activity()
    {
        $user = Auth::user();
        $data['invests'] = Trx::whereUser_id($user->id)->latest()->paginate(15);
        $data['page_title'] = "Transaction Log";
        return view('user.trx', $data);
    }

    public function withdrawLog()
    {
        $user = Auth::user();
        $data['invests'] = WithdrawLog::whereUser_id($user->id)->where('status', '!=', 0)->latest()->get();
        $data['page_title'] = "Withdraw Log";
        return view('user.withdraw-log', $data);
    }






    public function buywallet(Request $request)
    {
        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $currency = Currency::whereId($request->coin)->first();
        $wallet = Cryptowallet::whereUser_id($auth->id)->whereCoin_id($request->coin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);

        $lenght = strlen($request->address);
        if ($auth->balance < $request->amount) {
            return back()->with("alert", "You dont have enough balance in your deposit to make this purchase ");
        }

        if ($wallet->address == "0") {
            return back()->with("alert", "Please setup your $wallet->name wallet addres first before you make purchase");
        }


        if ($lenght < 10) {
            return back()->with("alert", "You have setup a wrong $wallet->name wallet address. Please update your wallet address");
        }

        $auth->balance = $auth->balance - $request->amount;
        $auth->save();

        $buy['currency_id'] = $currency->id;
        $buy['enter_amount'] =  round($request->amount, $basic->decimal);
        $buy['get_amount'] = $request->unit;
        $buy['buy_charge'] = 0;
        $buy['buy_price'] = $currency->price;
        $buy['user_id'] = Auth::id();
        $buy['type'] = 0;
        $buy['status'] = 1;
        $buy['account'] = $request->address;
        $buy['info'] = "Bought " . $wallet->name . " using wallet balance";
        $buy['trx'] = $trx;
        $data = BuyMoney::create($buy)->trx;

        Trx::create([
            'user_id' => $auth->id,
            'amount' => $request->amount,
            'main_amo' => round($auth->balance, $basic->decimal),
            'charge' => 0,
            'type' => '-',
            'action' => 'Purchase',
            'title' => ' Bought ' . $request->unit . ' ' . $currency->symbol,
            'trx' => $trx
        ]);

        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Purchased',
            'details' => 'Your cryptocurrency purchase was successful. Please wait while we verify your purchase. Your wallet will be credited once payment is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' =>  0
        ]);


        $txt = $request->amount . ' ' . $currency->symbol . ' Buy Amount  ';
        send_email($auth->email, $auth->username, 'Buy Amount', $txt);
        return redirect()->route('home')->with("success", "  Your coin purchase was successful");
    }

    public function buyecoin(Request $request)
    {
        $this->validate($request, [
            'wallet' => 'required',
            'rewallet' => 'required',
            'usd' => 'required',
            'local' => 'required',
            'payment' => 'required',
        ]);


        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $currency = Currency::whereId($request->coin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);


        if ($request->wallet != $request->rewallet) {
            return back()->with("alert", "Your confirm wallet address entry does not tally with the wallet address ");
        }

        if ($request->payment == 2) {


            $charge = 0;
            $usd = $request->usd * $currency->buy;
            $topay = $usd + $charge;
            $get = $request->usd / $currency->price;

            $buy['currency_id'] = $currency->id;
            $buy['amount'] =  $request->usd;
            $buy['main_amo'] = $topay;
            $buy['charge'] = $charge;
            $buy['price'] = $currency->price;
            $buy['getamo'] = $get;
            $buy['user_id'] = Auth::id();
            $buy['type'] = 1;
            $buy['method'] = $request->method;
            $buy['wallet'] = $request->wallet;
            $buy['rate'] = $currency->sell;
            $buy['bank'] = $request->bank;
            $buy['remark'] = $request->comment;
            $buy['status'] = 0;
            $buy['trx'] = $trx;
            $data = Trx::create($buy)->trx;

            Session::put('Track', $buy['trx']);
            return redirect()->route('user.ebuy');
        } elseif ($request->payment == 3) {
            //dd($request->all());

            if ($request->gateway ==  107) {
                $gate = Gateway::whereId(107)->first();
            }


            if ($request->gateway == 103) {
                $gate = Gateway::whereId(103)->first();
            }


            if ($request->gateway == 100) {
                $gate = Gateway::whereId(100)->first();
            }
            //dd($request->gateway);

            $charge = 0;
            $usd = $request->usd * $currency->buy;
            $topay = $usd + $charge;
            $get = $request->usd / $currency->price;

            $buy['currency_id'] = $currency->id;
            $buy['amount'] =  $request->usd;
            $buy['main_amo'] = $topay;
            $buy['charge'] = $charge;
            $buy['price'] = $currency->price;
            $buy['getamo'] = $get;
            $buy['user_id'] = Auth::id();
            $buy['type'] = 1;
            $buy['method'] = $request->method;
            $buy['wallet'] = $request->wallet;
            $buy['rate'] = $currency->sell;
            $buy['bank'] = $request->bank;
            $buy['gateway'] = $gate->id;
            $buy['remark'] = $request->comment;
            $buy['status'] = 0;
            $buy['trx'] = $trx;
            $data = Trx::create($buy)->trx;

            Session::put('Track', $buy['trx']);
            return redirect()->route('user.ebuy');
        }
    }

    public function ebuyonlinePreview()
    {

        $track = Session::get('Track');
        $data = Trx::where('status', 0)->where('trx', $track)->first();
        $page_title = "Purchase Preview";
        $auth = Auth::user();
        return view('user.ebuy', compact('data', 'page_title'));
    }

    public function ebuyonlinepay($id)
    {
        $data = Trx::where('status', 0)->where('trx', $id)->first();
        $page_title = "Purchase Preview";
        $auth = Auth::user();
        return view('user.ebuypay', compact('data', 'page_title'));
    }

    public function ebuydel($id)
    {
        $data = Trx::where('status', 0)->where('trx', $id)->first();
        $page_title = "Purchase Preview";
        $auth = Auth::user();
        $data->delete();
        return redirect()->route('home')->with("success", "Unpaid Transaction Was Deleted successful");
    }



    public function ebuyonlinepost($id)
    {
        $data = Trx::where('status', 0)->where('trx', $id)->first();
        Session::put('Track', $data->trx);
        return redirect()->route('ebuypost2');
    }


    public function ebuyonlinepost2()
    {
        $track = Session::get('Track');
        $data = Trx::where('status', 0)->where('trx', $track)->first();
        $method = PaymentMethod::all();
        $page_title = "Purchase Coin";
        $auth = Auth::user();
        return view('user.ebuypay', compact('data', 'method', 'page_title'));
    }



    public function ebuyupload(Request $request)
    {

        $this->validate(
            $request,
            [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]
        );

        $basic = GeneralSettings::first();
        $data = Trx::where('status', 0)->where('trx', $request->trx)->first();
        $page_title = "Purchased Coin";
        $auth = Auth::user();

        $data->amountpaid = $request->amount;
        $data->depositor = $request->payer;
        $data->tnum = $request->tnum;
        $data->method = $request->method;
        $data->status = 1;
        if ($request->hasFile('photo')) {
            $data['image'] = uniqid() . '.jpg';
            $request->photo->move('uploads/payments', $data['image']);
        }


        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Purchased',
            'details' => 'Your ' . $basic->currency_sym . '' . $request->amount . ' with transaction number ' . $data->trx . 'cryptocurrency purchase was successful. Please wait while our server verifies your purchase. Your account will be credited once payment is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' =>  0
        ]);

        $data->save();
        return redirect()->route('home')->with("success", "  Your coin purchase was successful");
    }



    public function sellecoin(Request $request)
    {
        $this->validate($request, [
            'coin' => 'required',
            'bank' => 'required',
            'usd' => 'required',
            'local' => 'required',
        ]);


        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $currency = Currency::whereId($request->coin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);

        $gate = Gateway::whereId(107)->first();
        $bankCode = $request->bank;
        $bank = Banky::whereCode($request->bank)->first();


        if ($request->bank == "other") {
            $bname = $request->bankname;
            $acctname = $request->acctname;
            $acctnumber = $request->actnumber;
        } else {

            $acctnumber = $request->acctnumber;
            $AccountID = "$request->actnumber";
            $baseUrl = "https://api.paystack.co";
            $endpoint = "/bank/resolve?account_number=" . $AccountID . "&bank_code=" . $bankCode;
            $httpVerb = "GET";
            $contentType = "application/json"; //e.g charset=utf-8
            $authorization = "$gate->val2"; //gotten from paystack dashboard


            $headers = array(
                "Content-Type: $contentType",
                "Authorization: Bearer $authorization"
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_URL, $baseUrl . $endpoint);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $content = json_decode(curl_exec($ch), true);
            $err     = curl_errno($ch);
            $errmsg  = curl_error($ch);

            curl_close($ch);

            //dd($content);
            if ($content['status']) {
                $acctname = $content['data']['account_name'];
                $bname = $bank->bank;
            } else {

                return back()->with('danger', 'Account Number Not Registered With ' . $bankname . '');
            }
        }


        $charge = 0;
        $usd = $request->usd * $currency->buy;
        $topay = $usd + $charge;


        $buy['currency_id'] = $currency->id;
        $buy['amount'] =  $request->usd;
        $buy['main_amo'] = $topay;
        $buy['charge'] = $charge;
        $buy['price'] = $currency->price;
        $buy['user_id'] = Auth::id();
        $buy['type'] = 0;
        $buy['bank'] = 0;
        $buy['bankname'] = $bname;
        $buy['accountname'] = $acctname;
        $buy['accountnumber'] = $request->actnumber;
        $buy['rate'] = $currency->buy;
        $buy['status'] = 0;
        $buy['trx'] = $trx;
        $data = Trx::create($buy)->trx;

        Session::put('Track', $buy['trx']);
        return redirect()->route('user.esell');
    }

    public function esellonlinePreview()
    {

        $track = Session::get('Track');
        $data = Trx::where('status', 0)->where('trx', $track)->first();
        $page_title = "Purchase Preview";
        $auth = Auth::user();
        return view('user.esell', compact('data', 'page_title'));
    }

    public function esellonlinepay()
    {
        $track = Session::get('Track');
        $data = Trx::where('status', 0)->where('trx', $track)->first();
        //dd($data);
        $page_title = "Sales Preview";
        $auth = Auth::user();
        return view('user.esellpay', compact('data', 'page_title'));
    }

    public function esellscan()
    {
        $track = Session::get('Track');
        $data = Trx::where('status', 0)->where('trx', $track)->first();
        //dd($data);
        $page_title = "Sales Preview";
        $auth = Auth::user();
        return view('user.esellscan', compact('data', 'page_title'));
    }


    public function esellscan2($id)
    {
        $data = Trx::where('status', 0)->where('trx', $id)->first();
        $page_title = "Sales Preview";
        $auth = Auth::user();
        return view('user.esellscan', compact('data', 'page_title'));
    }

    public function eselldel($id)
    {
        $data = Trx::where('status', 0)->where('trx', $id)->first();
        $page_title = "Sale Preview";
        $auth = Auth::user();
        $data->delete();
        return redirect()->route('home')->with("success", "Unpaid Transaction Was Deleted successful");
    }



    public function esellonlinepost($id)
    {
        $data = Trx::where('status', 0)->where('trx', $id)->first();
        Session::put('Track', $data->trx);
        return redirect()->route('esellpost2');
    }


    public function esellupload(Request $request)
    {
        $this->validate(
            $request,
            [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'trxx' => 'required',
            ]
        );

        $basic = GeneralSettings::first();
        $data = Trx::where('status', 0)->where('trx', $request->trx)->first();
        $page_title = "Sold Coin";
        $auth = Auth::user();

        $data->tnum = $request->trxx;
        $data->status = 1;
        if ($request->hasFile('photo')) {
            $data['image'] = uniqid() . '.jpg';
            $request->photo->move('uploads/payments', $data['image']);
        }


        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Sold',
            'details' => 'Your USD' . $data->amount . ' sale with transaction number ' . $data->trx . ' was successful. Please wait while our server verifies your sale. Your account will be credited once payment is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' =>  0
        ]);

        $data->save();
        return redirect()->route('home')->with("success", "  Your coin sale was successful");
    }







    public function buyonline(Request $request)
    {
        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $currency = Currency::whereId($request->coin)->first();
        $wallet = Cryptowallet::whereUser_id($auth->id)->whereCoin_id($request->coin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);

        $lenght = strlen($request->address);


        if ($request->radio ==  "paystack") {
            $gate = Gateway::whereId(107)->first();
        }


        if ($request->radio == "stripe") {
            $gate = Gateway::whereId(103)->first();
        }


        if ($request->radio == "rave") {
            $gate = Gateway::whereId(100)->first();
        }




        if ($wallet->address == "0") {
            return back()->with("alert", "Please setup your $wallet->name wallet addres first before you make withdrawal");
        }


        if ($lenght < 10) {
            return back()->with("alert", "You have setup a wrong $wallet->name wallet address. Please update your walletaddress");
        }


        $buy['currency_id'] = $currency->id;
        $buy['enter_amount'] =  round($request->amount, $basic->decimal);
        $buy['get_amount'] = $request->unit;
        $buy['buy_charge'] = 0;
        $buy['buy_price'] = $currency->price;
        $buy['user_id'] = Auth::id();
        $buy['type'] = 1;
        $buy['status'] = 0;
        if ($request->radio == "bank") {
            $buy['gateway'] = 999;
        } else {
            $buy['gateway'] = $gate->id;
        }
        if ($request->radio == "bank") {
            $buy['info'] = "Bought " . $wallet->name . " using Bank Transfer";
        } else {
            $buy['info'] = "Bought " . $wallet->name . " using Credit Card";
        }
        $buy['account'] = $request->address;
        $buy['trx'] = $trx;
        $data = BuyMoney::create($buy)->trx;

        Session::put('Track', $buy['trx']);
        return redirect()->route('user.onlinebuy');
    }

    public function buyonlinePreview()
    {

        $track = Session::get('Track');
        $data = Buymoney::where('status', 0)->where('trx', $track)->first();
        $page_title = "Purchase Preview";
        $auth = Auth::user();
        return view('user.onlinebuy', compact('data', 'page_title'));
    }

    public function sellwallet(Request $request)
    {
        $this->validate($request, [
            'radio2' => 'required',
        ], [
            'radio2.required' => 'Please select a method to payment '
        ]);
        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $currency = Currency::whereId($request->coin)->first();
        $wallet = Cryptowallet::whereUser_id($auth->id)->whereCoin_id($request->coin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);

        $lenght = strlen($request->radio2);
        if ($wallet->balance < $request->unit) {
            return back()->with("alert", "You dont have enough balance in your " . $wallet->name . " wallet");
        }

        if ($wallet->address == "0") {
            return back()->with("alert", "Please setup your payment account first before your make sales");
        }


        if ($lenght < 5) {
            return back()->with("alert", "You have setup a wrong payment account. Please update your payment account");
        }

        $wallet->balance = $wallet->balance - 3;
        $wallet->save();

        $buy['currency_id'] = $currency->id;
        $buy['enter_amount'] =  round($request->amount, $basic->decimal);
        $buy['get_amount'] = $request->unit;
        $buy['sell_charge'] = 0;
        $buy['sell_price'] = $currency->price;
        $buy['user_id'] = Auth::id();
        $buy['type'] = 0;
        $buy['status'] = 1;
        if ($request->radio2 == "Deposit Wallet") {
            $buy['payout'] = 1;
        }
        $buy['email'] = $request->radio2;
        $buy['trx'] = $trx;
        $data = SellMoney::create($buy)->trx;

        Trx::create([
            'user_id' => $auth->id,
            'amount' => $request->amount,
            'main_amo' => round($auth->balance, $basic->decimal),
            'charge' => 0,
            'type' => '-',
            'action' => 'Sales',
            'title' => ' Sold ' . $request->unit . ' ' . $currency->symbol,
            'trx' => $trx
        ]);

        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Sold',
            'details' => 'Your ' . $request->unit . '' . $currency->symbol . ' cryptocurrency sales valued at ' . $basic->currency . '' . round($request->amount - 0, $basic->decimal) . ' was successful. ' . $request->unit . '' . $currency->symbol . ' was debited from your ' . $basic->sitename . '  ' . $currency->name . ' wallet. Please wait while our server verifies your sale. Your account will be credited once coin is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' =>  0
        ]);



        $txt = $request->amount . ' ' . $currency->symbol . ' Sold Amount  ';
        send_email($auth->email, $auth->username, 'Sold Amount', $txt);
        return redirect()->route('home')->with("success", "  Your coin sales was successful");
    }

    public function sellonline(Request $request)
    {
        $this->validate($request, [
            'radio' => 'required',
        ], [
            'radio.required' => 'Please select a method to payment '
        ]);
        $auth = Auth::user();
        $currency = Currency::whereId($request->coin)->first();
        $basic = GeneralSettings::first();
        $trx = rand(000000, 999999) . rand(000000, 999999);
        $sell['currency_id'] = $currency->id;
        $sell['enter_amount'] =  round($request->amount, $basic->decimal);
        $sell['get_amount'] = $request->unit;
        $sell['sell_charge'] = 0;
        $sell['sell_price'] = $currency->price;
        $sell['user_id'] = Auth::id();
        $sell['type'] = 1;
        $sell['status'] = 0;
        if ($request->radio2 == "Deposit Wallet") {
            $buy['payout'] = 1;
        }

        $sell['account'] = $request->account;
        $sell['email'] = $request->radio;
        $sell['trx'] = $trx;
        $sell = SellMoney::create($sell)->trx;

        Trx::create([
            'user_id' => $auth->id,
            'amount' => $request->amount,
            'main_amo' => round($auth->balance, $basic->decimal),
            'charge' => 0,
            'type' => '-',
            'action' => 'Sales',
            'title' => ' Sold ' . $request->unit . ' ' . $currency->symbol,
            'trx' => $trx
        ]);



        $auth = Auth::user();
        $sell = SellMoney::where('trx', $trx)->where('user_id', $auth->id)->whereStatus(0)->first();
        $basic = GeneralSettings::first();
        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Sold',
            'details' => 'Your ' . $request->unit . '' . $currency->symbol . ' cryptocurrency sales valued at ' . $basic->currency . '' . round($request->amount - 0, $basic->decimal) . ' was successful. Please wait while our server verifies your sale. Your account will be credited once coin is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' =>  0
        ]);



        if ($sell) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $sell->trx . '.jpg';
                $location = 'sales/' . $filename;
                $sell->image = $filename;
                Image::make($image)->save($location);
            }
            $sell->account = $request->account;
            $sell->info = $request->info;
            $sell->status = 1;
            $sell->save();
            return redirect()->route('home')->with("success", "  Your Coin Sale Was Successful");
        }
        abort(404);
    }


    public function exchange()
    {
        $get['page_title'] = "Exchange Currency";
        $get['currency'] = Currency::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['currency2'] = Currency::whereStatus(1)->orderBy('name', 'asc')->get();
        return view('user.exchange', $get);
    }

    public function exchangewallet(Request $request)
    {
        $this->validate($request, [
            'radio2' => 'required',
        ], [
            'radio2.required' => 'Please select a method of payment '
        ]);
        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $hwallet = Cryptowallet::whereUser_id($auth->id)->whereCoin_id($request->hcoin)->first();
        $gwallet = Cryptowallet::whereUser_id($auth->id)->whereCoin_id($request->gcoin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);

        $lenght = strlen($request->radio);
        if ($hwallet->balance < $request->hhave) {
            return back()->with("alert", "You dont have enough balance in your " . $hwallet->name . " wallet");
        }

        if ($request->radio2 == 0) {
            if ($gwallet->address == "0") {
                return back()->with("alert", "Please setup your payment account first before your make exchange");
            }
        }

        if ($request->gcoin == $request->hcoin) {
            return back()->with("alert", "You cant exchange the same type of coin. Please check and try again later");
        }

        if ($request->radio2 == 0) {
            $hwallet->balance = $hwallet->balance - $request->hhave;
            $gwallet->balance = $gwallet->balance + $request->gget;
            $hwallet->save();
            $gwallet->save();
        } else {
            $hwallet->balance = $hwallet->balance - $request->hhave;
            $hwallet->save();
        }


        $data['user_id'] = Auth::id();
        $data['trx'] = $trx;
        $data['transaction_number'] = $trx;
        if ($request->radio2 == 0) {
            $data['info'] = "" . $basic->sitename . " Wallet";
            $data['status'] = 2;
        } else {
            $data['info'] = $hwallet->address;
            $data['status'] = 1;
        }

        $data['from_amount'] = round($request->hhave, 6);
        $data['from_amount_charge'] = 0;
        $data['from_currency_id'] = $request->hcoin;
        $data['receive_amount'] = round($request->gget, 6);
        $data['receive_currency_id'] = $request->gcoin;

        $data['type'] = 0;
        $getTrx = ExchangeMoney::create($data)->trx;


        Trx::create([
            'user_id' => $auth->id,
            'amount' => $request->hamount,
            'main_amo' => round($auth->balance, $basic->decimal),
            'charge' => 0,
            'type' => '-',
            'action' => 'Exchange',
            'title' => ' Exchange ' . $request->unithave . ' ' . $hwallet->name,
            'trx' => $trx
        ]);


        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Exchanged',
            'details' => 'Your ' . $request->hhave . '' . $hwallet->name . ' cryptocurrency exchange was successful. ' . $request->gget . '' . $gwallet->name . ' will be credited to your ' . $gwallet->name . ' wallet. Please wait while our server verify your exchange. Your account will be credited once coin exchange is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' =>  0
        ]);




        $txt = $request->hhave . ' ' . $hwallet->name . ' Exchange Amount  ';
        send_email($auth->email, $auth->username, 'Exchange Amount', $txt);
        return redirect()->route('home')->with("success", "  Your coin sales was successful");
    }




    public function exchangeonline(Request $request)
    {
        $this->validate($request, [
            'radio2' => 'required',
        ], [
            'radio2.required' => 'Please select a method of payment '
        ]);
        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $hwallet = Cryptowallet::whereUser_id($auth->id)->whereCoin_id($request->hcoin)->first();
        $gwallet = Cryptowallet::whereUser_id($auth->id)->whereCoin_id($request->gcoin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);

        $lenght = strlen($request->radio);

        if ($request->radio2 == 0) {
            if ($gwallet->address == "0") {
                return back()->with("alert", "Please setup your payment account first before your make exchange");
            }
        }

        if ($request->gcoin == $request->hcoin) {
            return back()->with("alert", "You cant exchange the same type of coin. Please check and try again later");
        }


        $data['user_id'] = Auth::id();
        $data['trx'] = $trx;
        $data['transaction_number'] = $request->account;
        if ($request->radio2 == 0) {
            $data['info'] = "" . $basic->sitename . " Wallet";
        } else {
            $data['info'] = $hwallet->address;
        }
        $data['status'] = 1;

        $data['type'] = 1;
        $data['from_amount'] = round($request->hhave, 6);
        $data['from_amount_charge'] = 0;
        $data['from_currency_id'] = $request->hcoin;
        $data['receive_amount'] = round($request->gget, 6);
        $data['receive_currency_id'] = $request->gcoin;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $request->account . '.jpg';
            $location = 'exchange/' . $filename;
            $data['image'] = $filename;
            Image::make($image)->save($location);
        }
        $getTrx = ExchangeMoney::create($data)->trx;


        Trx::create([
            'user_id' => $auth->id,
            'amount' => $request->hamount,
            'main_amo' => round($auth->balance, $basic->decimal),
            'charge' => 0,
            'type' => '-',
            'action' => 'Exchange',
            'title' => ' Exchange ' . $request->unithave . ' ' . $hwallet->name,
            'trx' => $trx
        ]);


        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Exchanged',
            'details' => 'Your ' . $request->hhave . '' . $hwallet->name . ' cryptocurrency exchange was successful. ' . $request->gget . '' . $gwallet->name . ' will be credited to your ' . $gwallet->name . ' wallet. Please wait while our server verify your exchange. Your account will be credited once coin exchange is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' =>  0
        ]);

        $auth = Auth::user();
        $exchange = ExchangeMoney::where('transaction_number', $request->account)->where('user_id', $auth->id)->whereStatus(0)->first();
        $basic = GeneralSettings::first();


        return redirect()->route('home')->with("success", "  Your Exchange Request Was Successful. Please wait while our server verify your transaction");
    }


    public function transactions()
    {
        $auth = Auth::user();
        $data['page_title'] = "My Transactons";
        $data['buy'] = $tt = Transaction::where('user_id', Auth::user()->id)->where('type', 'Buy')->with('currency:*')->latest()->get();
        $data['sell'] = $t = Transaction::where('user_id', Auth::user()->id)->where('type', 'Sell')->with('currency:*')->latest()->get();
        //dd($tt);
        return view('user.transactions.index', $data);
    }


    public function notifications()
    {
        $auth = Auth::user();
        $data['page_title'] = "Notifications";
        $data['notify'] =  Post::whereNotify(1)->latest()->get();
        return view('user.notifications', $data);
    }



    public function inbox()
    {
        $auth = Auth::user();
        $data['page_title'] = "Inbox";
        $data['inbox'] =  Message::where('user_id', $auth->id)->whereAdmin(1)->orderBy('created_at', 'desc')->get();
        return view('user.inbox', $data);
    }




    public function inboxview($id)
    {
        $auth = Auth::user();
        $data['page_title'] = "Inbox View";
        $data['inbox'] =  Message::where('user_id', $auth->id)->whereId($id)->first();
        $inbox =  Message::where('user_id', $auth->id)->whereId($id)->first();

        $inbox->status = 1;
        $inbox->save();
        return view('user.inbox-view', $data);
    }


    public function inboxdelete($id)
    {
        $auth = Auth::user();
        $data['page_title'] = "Inbox Delete";
        $data['inbox'] =  Message::where('user_id', $auth->id)->whereId($id)->first();
        $inbox =  Message::where('user_id', $auth->id)->whereId($id)->first();
        $inbox->delete();
        return back()->with("message", "Message Deleted successfully");
    }



    public function messages()
    {
        $data['page_title'] = "Create Message";
        $data['code'] = strtoupper(Str::random(6));
        return view('user.create_message', $data);
    }


    public function postmessage(Request $request)
    {
        $data['user_id'] = Auth::id();
        $data['title'] = $request->subject;
        $data['details'] = $request->body;
        $data['status'] = 0;
        if ($request->hasFile('image')) {

            $this->validate(
                $request,
                [
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ]
            );


            $data['image'] = uniqid() . '.jpg';
            $request->image->move('uploads/messages', $data['image']);
        }


        Message::create($data);

        return back()->with("message", "Message sent successfully");
    }


    public function usertest()
    {
        $data['page_title'] = "Create Testimonial";
        $data['code'] = strtoupper(Str::random(6));
        return view('user.create_testimonial', $data);
    }


    public function posttestimonial(Request $request)
    {
        $data['user_id'] = Auth::id();
        $data['details'] = $request->body;
        $data['code'] = $request->code;
        $data['status'] = 0;

        Testimonial::create($data);

        return back()->with("message", "Your testimonial has been created successfully. Your testimonial will appear on the front page once testimonial is approved");
    }
}
