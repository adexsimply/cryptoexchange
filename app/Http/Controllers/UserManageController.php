<?php

namespace App\Http\Controllers;

use App\Country;
use App\Deposit;
use App\GeneralSettings;
use App\Trx;
use App\User;
use App\Currency;
use App\Verification;
use App\Category;
use App\Post;
use App\UserLogin;
use App\Cryptowallet;
use App\Testimonial;
use App\Message;
use App\Transaction;
use App\WithdrawLog;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;

class UserManageController extends Controller
{
    public function users()
    {
        $data['page_title'] = "User Manage";
        $data['users'] = User::latest()->get();
        return view('admin.users.index', $data);
    }

    public function userSearch(Request $request)
    {
        $this->validate(
            $request,
            [
                'search' => 'required',
            ]
        );
        $data['users'] = User::where('username', 'like', '%' . $request->search . '%')->orWhere('email', 'like', '%' . $request->search . '%')->orWhere('fname', 'like', '%' . $request->search . '%')->orWhere('lname', 'like', '%' . $request->search . '%')->get();
        $data['page_title'] = "Search User";
        return view('admin.users.search', $data);
    }

    public function singleUser($id)
    {
        $user = User::findorFail($id);

        $data['page_title'] = "User Manage";
        $data['user'] = $user;
        $data['last_login'] = UserLogin::whereUser_id($user->id)->orderBy('id', 'desc')->first();
        $data['coin'] = Currency::whereStatus(1)->orderBy('id', 'desc')->get();
        return view('admin.users.single', $data);
    }

    public function userPasschange(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate(
            $request,
            [
                'password' => 'required|string|min:5|confirmed'
            ]
        );
        if ($request->password == $request->password_confirmation) {
            $user->password = bcrypt($request->password);
            $user->save();
            $msg = 'Password Changed By Admin. New Password is: ' . $request->password;
            send_email($user->email, $user->username, 'Password Changed', $msg);
            $notification = array('message' => 'Password Changed!', 'alert-type' => 'success');
            return back()->with($notification);
        } else {
            $notification = array('message' => 'Password Not Matched', 'alert-type' => 'danger');
            return back()->with($notification);
        }
    }


    public function statupdate(Request $request, $id)
    {

        $user = User::find($id);
        $this->validate($request, [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:255|unique:users,phone,' . $user->id,
        ], [
            'fname.required' => 'First Name must not be empty!',
            'lname.required' => 'Last Name must not be empty!',
        ]);
        $in = Input::except('_token', '_method');
        $user['status'] = $request->status == "1" ? 1 : 0;
        $user['email_verify'] = $request->email_verify == "1" ? 1 : 0;
        $user['phone_verify'] = $request->phone_verify == "1" ? 1 : 0;
        $user->fill($in)->save();

        $msg = 'Your Profile Updated by Admin';
        //send_email($user->email, $user->username, 'Profile Updated', $msg);

        $notification = array('message' => 'User Profile Updated Successfuly!', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function usertestimonial()
    {
        $data['page_title'] = "User Testimonials";
        $data['test'] = Testimonial::orderby('id', 'desc')->get();
        return view('admin.testimonial.index', $data);
    }

    public function usertestimonialdel($id)
    {
        $data['page_title'] = "User Testimoial";
        $data['test'] = Testimonial::find($id);
        $data['test']->delete();
        $notification = array('message' => 'User Testimonial Deleted Successfuly!', 'alert-type' => 'success');
        return back()->with($notification);
    }


    public function usertestimonialupdate(Request $request)
    {
        $data['page_title'] = "User Testimoial";
        $basic = GeneralSettings::first();
        $test = Testimonial::find($request->id);
        $test->status = $request->status;
        $test->details = $request->body;
        $test->save();

        if ($test->user_id > 1) {
            if ($request->status > 0) {
                Message::create([
                    'user_id' => $test->user_id,
                    'title' => 'Testimonial Submission Activated',
                    'details' => 'Your testimonial submission with id number ' . $test->code . ' has been processed and activated by the admin. Hence it is viewable on the website frontpage. Thank you for choosing ' . $basic->sitename . '',
                    'admin' => 1,
                    'status' =>  0
                ]);
            }

            if ($request->status < 1) {
                Message::create([
                    'user_id' => $test->user_id,
                    'title' => 'Testimonial Submission Deactivated',
                    'details' => 'Your testimonial submission  with id number ' . $test->code . ' has been rejected and deactivated hence it is not viewable on the website frontpage. Please try and create another testimonial. Thank you for choosing ' . $basic->sitename . '',
                    'admin' => 1,
                    'status' =>  0
                ]);
            }
        }
        $notification = array('message' => 'User Testimonial Update Successfuly!', 'alert-type' => 'success');
        return back()->with($notification);
    }


    public function usertestimonialcreate(Request $request)
    {
        $data['page_title'] = "User Testimoial";
        Testimonial::create([
            'user_id' => 0,
            'details' => $request->details,
            'status' =>  1
        ]);

        $notification = array('message' => 'Testimonial Created Successfuly!', 'alert-type' => 'success');
        return back()->with($notification);
    }



    public function usertickets()
    {
        $data['page_title'] = "User Tickets";
        $data['inbox'] = Message::where('admin', 0)->orderby('id', 'desc')->get();
        return view('admin.tickets.ticket', $data);
    }


    public function userticketview($id)
    {
        $data['page_title'] = "User Tickets";
        $data['inbox'] = Message::where('id', $id)->first();

        $data['inbox']->view = 1;
        $data['inbox']->save();
        return view('admin.tickets.ticket-view', $data);
    }

    public function userticketreply(Request $request)
    {


        Message::create([
            'user_id' => $request->id,
            'title' => $request->subject,
            'details' => $request->details,
            'admin' => 1,
            'status' =>  0
        ]);

        return back()->with('success', 'MEssage Replied Successfully!');
    }




    public function usernotify()
    {
        $data['category'] = Category::whereStatus(1)->get();
        $data['page_title'] = "Send Notification";
        return view('admin.post.notification', $data);
    }


    public function notifystore(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'cat_id' => 'required',
                'image' => 'required | mimes:jpeg,jpg,png,bmp | max:100000'
            ],
            [
                'title.required' => 'Post Title Must not be empty',
                'cat_id.required' => 'Please select a  Category',
            ]
        );

        $in = Input::except('_token');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'post_' . time() . '.jpg';
            $location = 'assets/images/post/' . $filename;
            Image::make($image)->resize(730, 450)->save($location);
            $in['image'] = $location;
        }
        $in['status'] =  1;
        $in['notify'] =  1;
        $res = Post::create($in);
        if ($res) {
            return back()->with('success', 'Notification Sent Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Plan');
        }
    }


    public function userEmail($id)
    {
        $data['user'] = User::findorFail($id);
        $data['page_title'] = "Send  Email To User";
        return view('admin.users.email', $data);
    }

    public function sendemail(Request $request)
    {

        $this->validate(
            $request,
            [
                'emailto' => 'required|email',
                'reciver' => 'required',
                'subject' => 'required',
                'emailMessage' => 'required'
            ]
        );
        $to = $request->emailto;
        $name = $request->reciver;
        $subject = $request->subject;
        $message = $request->emailMessage;

        Message::create([
            'user_id' => $request->id,
            'title' => $request->subject,
            'details' => $request->emailMessage,
            'admin' => 1,
            'status' =>  0
        ]);

        send_email($to, $name, $subject, $message);
        $notification = array('message' => 'Mail Sent To ' . $request->reciver . ' Successfuly!', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function banusers()
    {
        $data['page_title'] = "Banned User";
        $data['users'] = User::where('status', '0')->orderBy('id', 'desc')->get();
        return view('admin.users.banned', $data);
    }

    public function loginLogsByUsers($id)
    {
        $user =  User::find($id);
        $logs = UserLogin::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $page_title = 'Login Information';
        return view('admin.users.login-logs-by-users', compact('logs', 'page_title', 'user'));
    }
    public function userkyc()
    {
        $kyc = Verification::orderBy('status', 'DESC')->get();
        $page_title = 'User Verification';
        $user = '';
        //dd($kyc);
        return view('admin.kyc.verification', compact('kyc', 'page_title', 'user'));
    }
    public function delkyc($id)
    {
        $kyc = Verification::where('id', $id)->first();
        $kyc->delete();

        $user =  User::find($kyc->user_id);
        $user->verified = 0;
        $user->save();

        $path = './kyc/';
        $link1 = $path . $kyc->image1;
        $link2 = $path . $kyc->image2;
        if (file_exists($link1)) {
            @unlink($link1);
        }
        if (file_exists($link2)) {
            @unlink($link2);
        }


        Message::create([
            'user_id' => $user->id,
            'title' => 'KYC Submission Deleted',
            'details' => 'Your KYC submission has been deleted from our server. Please re-upload another document for verification purpose. You will receive a message once your submission has been approved',
            'admin' => 1,
            'status' =>  0
        ]);






        session()->flash('success', 'KYC Submission Deleted Successfully. ');

        return redirect()->route('admin.kyc');
    }
    public function viewkyc($id)
    {
        $kyc = Verification::where('id', $id)->first();
        $page_title = 'User Verification';
        return view('admin.kyc.view', compact('kyc', 'page_title'));
    }
    public function rejectkyc($id)
    {
        $basic = GeneralSettings::first();
        $kyc = Verification::where('id', $id)->first();
        $kyc->status = 2;
        $kyc->save();

        $user =  User::find($kyc->user_id);
        $user->verified = 3;
        $user->save();

        Message::create([
            'user_id' => $user->id,
            'title' => 'KYC Submission Rejected',
            'details' => 'Your KYC submission was not approved as it doesnt meet the requied standard or you uploaded un-supported document. Please try again',
            'admin' => 1,
            'status' =>  0
        ]);

        return back()->with('success', 'KYC Submission Rejected Successfully. A message has been sent to the customer');
    }

    public function approvekyc($id)
    {
        $basic = GeneralSettings::first();
        $kyc = Verification::where('id', $id)->first();
        $kyc->status = 1;
        $kyc->save();

        $user =  User::find($kyc->user_id);
        $user->verified = 2;
        $user->bonus = $user->bonus + $basic->kyc;
        $user->save();

        if ($user->reference) {
            $ref = User::find($user->reference);
            $ref->bonus = $ref->bonus + $basic->ref;
            $ref->save();
        }

        Message::create([
            'user_id' => $user->id,
            'title' => 'KYC Submission Approved',
            'details' => 'Your KYC submission has been approved. You are now eligible to buy cryptocurrencies and earn bonus as well as offers on ' . $basic->sitename . ' Congratulations',
            'admin' => 1,
            'status' =>  0
        ]);

        return back()->with('success', 'KYC Submission Approved Successfully. A message has been sent to the customer');
    }
    public function ManageBalanceByUsers($id)
    {
        $user =  User::find($id);
        $page_title = "Update Wallet Balance";
        return view('admin.users.balance-manage', compact('user', 'page_title'));
    }

    public function activate($id)
    {
        $user =  User::find($id);
        $user->status = 1;
        $user->save();
        return back()->with('success', 'User Activated Successfully');
    }

    public function block($id)
    {
        $user =  User::find($id);
        $user->status = 0;
        $user->save();
        return back()->with('success', 'User Blocked Successfully');
    }

    public function delete($id)
    {
        $user =  User::find($id);

        $user->delete();
        return back()->with('success', 'User Deleted Successfully');
    }

    public function saveBalanceByUsers(Request $request)
    {
        $basic = GeneralSettings::first();

        $user = User::find($request->id);
        $this->validate($request, [
            'amount' => 'required|numeric|min:0',
            'message' => 'required'
        ]);

        if ($request->operation == 1) {
            $user->balance += $request->amount;
            $user->save();

            Message::create([
                'user_id' => $user->id,
                'title' => 'Credit Alert',
                'details' => 'Your deposit wallet has been credited with a sum of ' . $basic->currency . '' . $request->amount . '. Thank you for choosing ' . $basic->sitename . '',
                'admin' => 1,
                'status' =>  0
            ]);


            $txt = $request->amount . ' ' . $basic->currency . ' credited in your account.' . '<br>' .  $request->message;
            notify($user, 'Credited our Account', $txt);
        } else {
            if (($user->balance > 0) && ($request->amount < $user->balance)) {
                $user->balance -= $request->amount;
                $user->save();


                Message::create([
                    'user_id' => $user->id,
                    'title' => 'Credit Alert',
                    'details' => 'Your deposit wallet has been debited of the sum of ' . $basic->currency . '' . $request->amount . '. Thank you for choosing ' . $basic->sitename . '',
                    'admin' => 1,
                    'status' =>  0
                ]);


                $txt = $request->amount . ' ' . $basic->currency . ' credited in your account.' . '<br>' . $request->message;
                notify($user, 'Debited Your Account', $txt);
            } else {
                return back()->with('alert', 'Insufficient Balance To Debit From User Wallet!');
            }
        }

        return back()->with('success', 'Wallet Balance Uppdated Successfully!');
    }

    public function savecoinwalletBalanceByUsers(Request $request)
    {
        $basic = GeneralSettings::first();
        $user = User::find($request->id);
        $wallet = Cryptowallet::whereUser_id($request->id)->whereCoin_id($request->wallet)->first();

        $this->validate($request, [
            'amount' => 'required|numeric|min:0',
            'wallet' => 'required',
            'id' => 'required'
        ]);

        if ($request->operation == 1) {
            $wallet->balance += $request->amount;
            $wallet->save();

            $txt = $request->amount . ' ' . $basic->currency . ' credited in your account.' . '<br>' .  $request->message;
            notify($user, 'Credited our Account', $txt);
        } else {
            if (($wallet->balance > 0) && ($request->amount < $wallet->balance)) {
                $wallet->balance -= $request->amount;
                $wallet->save();

                $txt = $request->amount . ' ' . $basic->currency . ' credited in your crypto wallet.' . '<br>' . $request->message;
                notify($user, 'Debited Your Account', $txt);
            } else {
                return back()->with('alert', 'Insufficient Balance To Debit From Crypto Wallet!');
            }
        }

        return back()->with('success', 'Coin Operation Successfully Completed!');
    }


    public function loginLogs($user = 0)
    {
        $user = User::find($user);
        if ($user) {
            $logs = UserLogin::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
            $page_title = 'Login Logs Of ' . $user->name;
        } else {
            $logs = UserLogin::orderBy('id', 'DESC')->paginate(20);
            $page_title = 'User Login Logs';
        }
        return view('admin.users.login-logs', compact('logs', 'page_title'));
    }


    public function userTrans($id)
    {
        $user = User::find($id);
        $page_title = "$user->username - All Transaction";
        $deposits = Transaction::whereUser_id($id)->with('method:*')->with('gateway:*')->orderBy('id', 'DESC')->get();
        return view('admin.users.user-trans', compact('deposits', 'page_title'));
    }
    public function userDeposit($id)
    {
        $user = User::find($id);
        $page_title = "$user->username - All Deposit";
        $deposits = Deposit::whereUser_id($id)->whereStatus(1)->latest()->get();
        return view('admin.users.user-deposit-log', compact('deposits', 'page_title'));
    }
    public function userWithdraw($id)
    {
        $user = User::find($id);
        $page_title = "$user->username - All Withdraw Request";
        $deposits = WithdrawLog::whereUser_id($id)->where('status', '!=', 0)->latest()->get();
        return view('admin.users.user-withdraw', compact('deposits', 'page_title'));
    }
}
