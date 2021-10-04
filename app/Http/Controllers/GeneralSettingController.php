<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\GeneralSettings;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use File;
use Image;


class GeneralSettingController extends Controller
{

	public function __construct(){
		$Gset = GeneralSettings::first();
		$this->sitename = $Gset->sitename;
	}
	public function GenSetting(){
		$data['page_title'] = 'System Settings';
			$data['general'] = GeneralSettings::first();
		return view('admin.general', $data);
	}

	public function UpdateGenSetting(Request $request)
    {
        $request->validate([

            'currency' => 'required',
            'currency_sym' => 'required',
            'sitename' => 'required',
            'ref' => 'required',
            'kyc' => 'required',
            'decimal' => 'required|integer|min:1',
        ],[
            'currency_sym.required' => 'Currency symbol must not be empty',
            ]);


        $gs = GeneralSettings::first();
        $in = Input::except('_token','logo','favicon');
        $in['registration'] = $request->registration == 'on' ? '1' : '0';
        $in['login'] = $request->login == 'on' ? '1' : '0';
        $in['maintain'] = $request->maintain == 'on' ? '1' : '0';
        $in['email_verification'] = $request->email_verification == 'on' ? '1' : '0';
        $in['sms_verification'] = $request->sms_verification == 'on' ? '1' : '0';
        $in['email_notification'] = $request->email_notification == 'on' ? '1' : '0';
        $in['sms_notification'] = $request->sms_notification == 'on' ? '1' : '0';
        $res = $gs->fill($in)->save();

            if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = 'logo.png';
            $location = 'assets/images/logo/' . $filename;
            Image::make($image)->save($location);
        }
        if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $filename = 'favicon.png';
            $location = 'assets/images/logo/' . $filename;
            Image::make($image)->save($location);
        }

			if ($res) {
				return back()->with('success', 'System Settings Has Been Updated Successfully!');
			}else{
				return back()->with('alert', 'Problem With Updating');
			}
	}


    public function getContact()
    {
        $data['basic'] = GeneralSettings::first();
        $data['page_title'] = "Contact Settings";
        return view('admin.webControl.contact-setting',$data);
    }

    public function putContactSetting(Request $request)
    {
        $basic = GeneralSettings::first();
        $request->validate([
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        $in = Input::except('_method','_token');
        $in['location'] = $request->location == 'on' ? '1' : '0';
        $basic->fill($in)->save();

        $notification =  array('message' => 'Contact  Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }



}
