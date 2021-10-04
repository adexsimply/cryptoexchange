<?php

namespace App\Http\Controllers;

use App\Trx;
use App\Wallet;
use Illuminate\Http\Request;
use App\WithdrawMethod;
use App\WithdrawLog;
use App\User;
use App\GeneralSettings;
use Illuminate\Support\Facades\Input;

class WithdrawController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $page_title = "Withdraw Methods";
    	$withdarws = WithdrawMethod::latest()->get();
    	return view('admin.withdraw.index', compact('withdarws','page_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,png',
            'duration' => 'required',
            'fix' => 'required|numeric|min:0',
            'percent' => 'required|numeric|min:0',
            'withdraw_max' => 'required|numeric|min:0',
            'withdraw_min' => 'required|numeric|min:0',
        ]);

        $in = Input::except('_token','image');
        if($request->hasFile('image'))
        {
            $in['image'] = uniqid().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('assets/images',$in['image']);
        }

        WithdrawMethod::create($in);

        return back()->with('success', 'Withdraw Settings Updated Successfully!');
    }

    public function withdrawUpdateSettings(Request $request)
    {
        $request->validate([
            'image' => 'nullable|mimes:jpg,png',
            'duration' => 'required',
            'fix' => 'required|numeric|min:0',
            'percent' => 'required|numeric|min:0',
            'withdraw_max' => 'required|numeric|min:0',
            'withdraw_min' => 'required|numeric|min:0',
        ]);
        $data = WithdrawMethod::find($request->id);
        $in = Input::except('_token','image');
        if($request->hasFile('image'))
        {
            $path = 'assets/images/'.$data->image;
            if(file_exists($path)){
                @unlink($path);
            }
            $data['image'] = uniqid().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('assets/images',$data['image']);
        }
        $data->fill($in)->save();
        return back()->with('success', 'Withdraw Settings Updated Successfully!');
    }

    public function requests()
    {
    	$withdrawLog = WithdrawLog::latest()->where('status',1)->paginate(20);
        $page_title = " Withdraw Request";
    	return view('admin.withdraw.requests', compact('withdrawLog','page_title'));
    }

    public function requestsApprove()
    {
        $withdrawLog = WithdrawLog::latest()->where('status', 2)->paginate(20);
        $page_title = " Withdraw Approved";
        return view('admin.withdraw.index', compact('withdrawLog','page_title'));
    }

    public function requestsRefunded()
    {
        $withdrawLog = WithdrawLog::latest()->where('status', -2)->paginate(20);
        $page_title = " Withdraw Refunded";
        return view('admin.withdraw.history', compact('withdrawLog','page_title'));
    }

     public function view($id)
    {
        $basic = GeneralSettings::first();
        $data = WithdrawLog::findorFail($id);
        $page_title = " View Request";
        return view('admin.withdraw.details', compact('data','page_title'));
    }

     public function approve($id)
    {
        $basic = GeneralSettings::first();
        $withdr = WithdrawLog::findorFail($id);
        $withdr['status'] = 2;
        $withdr->save();
        return back()->with('success', 'Withdraw Request Approved Successfully!');
    }

       public function deleteAmount($id)
    {
        $basic = GeneralSettings::first();
        $withdr = WithdrawLog::findorFail($id);
        $withdr->delete();
        return back()->with('success', 'Withdraw Request Deleted Successfully!');
    }

    public function refundAmount($id)
    {
        $basic = GeneralSettings::first();
        $withdr = WithdrawLog::findorFail($id);
        $withdr['status'] = -2;
        $withdr->save();

        $userWallet = User::find($withdr['user_id']);
        $userWallet->balance += $withdr ->net_amount;
        $userWallet->save();

        $tr = strtoupper(str_random(20));
        $trx = Trx::create([
            'user_id' => $userWallet->id,
            'amount' => $withdr ->net_amount,
            'main_amo' => round($userWallet->balance, $basic->decimal),
            'charge' => 0,
            'type' => '+',
            'title' => 'Withdraw Amount '.$withdr ->net_amount . ' '.$basic->currency .' Refunded.',
            'trx' => $tr,
        ]);


        $msg =  'Your withdraw amount ' . $withdr ->net_amount. ' '.$basic->currency .' refund  successfully ' ;
        send_email($userWallet->email, $userWallet->username, 'Withdraw Amount Refund', $msg);
        send_sms($userWallet->phone, $msg);

        return back()->with('success', 'Withdraw Amount Refund Successfully!');
    }





}
