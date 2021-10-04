<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposit;
use App\Trx;
use App\User;
use App\Package;
use App\Transfer;
use App\General;

class DepositController extends Controller
{
    public function __construct()
    {

    }

      public function index()
    {
    	$deposits = Deposit::where('status', 1)->orderBy('id', 'desc')->get();
    	$page_title = "Deposit  Log";

    	return view('admin.deposit.deposits', compact('deposits','page_title'));
    }

       public function transfer()
    {
    	$data = Transfer::where('status', 1)->orderBy('id', 'desc')->get();
    	$page_title = "Transfer  Log";

    	return view('admin.transfer.index', compact('data','page_title'));
    }

       public function transferdelete($id)
    {
        $transfer = Transfer::findorFail($id);

        $transfer->delete();

        return back()->with('success', 'Transfer Log Deleted Successfully!');
    }
       public function transferview($id)
    {
    	$data = Transfer::findorFail($id);
        $page_title = "View Transfer";
    	return view('admin.transfer.details', compact('data','page_title'));
    }




    public function requests()
    {
    	$deposits = Deposit::where('status', 2)->orderBy('id', 'desc')->get();
        $page_title = "Deposit Requests";
    	return view('admin.deposit.requests', compact('deposits','page_title'));
    }

     public function view($id)
    {
    	$data = Deposit::findorFail($id);
        $page_title = "View Deposit";
    	return view('admin.deposit.details', compact('data','page_title'));
    }



     public function approve(Request $request, $id)
    {
        $deposit = Deposit::findorFail($id);

        $deposit['status'] = 1;
        $deposit->save();

        $user = User::find($deposit['user_id']);
        $user['balance'] = $user->balance + $deposit['amount'];
        $user->save();

        if ($user->refid != 0)
        {
            $pack = Package::first();
            $gnl= General::first();
           $refer = User::find($user->refid);
           $coms = ($gnl->refcom*$deposit['amount'])/100;
           $refer['balance'] = $refer->balance + $coms;
           $refer->save();

            $rlog['user_id'] = $refer->id;
           $rlog['trx'] = str_random(16);
           $rlog['amount'] = $coms;
           $rlog['type'] = 1;
           $rlog['action'] = 'Referal Commision';
           Trx::create($rlog);
        }

        $tlog['user_id'] = $user->id;
       $tlog['trx'] = str_random(16);
       $tlog['amount'] = $deposit['amount'];
       $tlog['type'] = 1;
       $tlog['action'] = 'Deposit';
       Trx::create($tlog);

        $msg =  'Your Deposit Processed Successfully';
        send_email($user->email, $user->firstname, 'Purchase Processed', $msg);
        $sms =  'Your Deposit Processed Successfully';
        send_sms($user->mobile, $sms);

        return back()->with('success', 'Deposit Request Approved Successfully!');
    }

    public function destroy($id)
    {
        $deposit = Deposit::findorFail($id);
        $user = User::find($deposit->user_id);

        $msg =  'Your Deposit Request canceled by Admin';
        send_email($user->email, $user->username, 'Deposit Canceled', $msg);
        $sms =  'Your Deposit Request canceled by Admin';
        send_sms($user->mobile, $sms);

        $deposit['status'] = -2;
        $deposit->save();

        return back()->with('success', 'Deposit Canceled Successfully!');
    }
}
