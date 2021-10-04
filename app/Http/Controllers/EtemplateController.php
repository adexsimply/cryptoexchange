<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etemplate;
class EtemplateController extends Controller
{
    public function index()
    {
        $data['page_title'] =  "Email & SMS Settings";
        $temp = $data['temp'] = Etemplate::first();
        if(is_null($temp))
        {
            $default = [
                'esender' => 'email@example.com',
                'emessage' => 'Email Message',
                'smsapi' => 'SMS Message',
                'mobile' => '88019xxxxxx'
            ];
            Etemplate::create($default);
            $temp = Etemplate::first();
        }

        return view('admin.mailsms.sms_email', $data);
    }


    public function update(Request $request)
    {
        $temp = Etemplate::first();

        $this->validate($request,
               [
                'esender' => 'required',
                'emessage' => 'required',
                'smsapi' => 'required',
//                'mobile' => 'required'
                ]);

//        $temp['mobile'] = $request->mobile;
        $temp['esender'] = $request->esender;
        $temp['emessage'] = $request->emessage;
        $temp['smsapi'] = $request->smsapi;

        $temp->save();

        return back()->with('success', 'Email Settings Updated Successfully!');
    }

}
