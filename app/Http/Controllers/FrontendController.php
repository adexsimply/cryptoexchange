<?php

namespace App\Http\Controllers;

use App\BuyMoney;
use App\Category;
use App\Continent;
use App\Country;
use App\Currency;
use App\ExchangeMoney;
use App\Faq;
use App\GeneralSettings;
use App\Mentor;
use App\Menu;
use App\Post;
use App\User;
use App\SellMoney;
use App\Service;
use App\Subscriber;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FrontendController extends Controller
{
    public function index()
    {
        $basic = GeneralSettings::first();
        $data['page_title'] = "Home";
        $data['currency'] = Currency::whereStatus(1)->orderBy('symbol','asc')->get();
        $data['currency2'] = Currency::whereStatus(1)->orderBy('symbol','desc')->get();
        $data['testimonial'] = Testimonial::whereStatus(1)->get();
        $data['faq'] = Faq::all();
        // dd(Hash::make('password'));

        if($basic->maintain == 1){
        return view('front.maintain', $data);
        }

        return view('front.home', $data);
    }
    public function index2()
    {
        $basic = GeneralSettings::first();
        $data['page_title'] = "Home";
        $data['currency'] = Currency::whereStatus(1)->orderBy('symbol','asc')->get();
        $data['currency2'] = Currency::whereStatus(1)->orderBy('symbol','desc')->get();
        $data['testimonial'] = Testimonial::whereStatus(1)->get();
        $data['faq'] = Faq::all();
        $data['currency'] = Currency::whereDeleted_at(Null)->orderBy('symbol','asc')->get();
        // dd(Hash::make('password'));

        if($basic->maintain == 1){
        return view('front.maintain', $data);
        }

        return view('landing.index', $data);
    }

     public function rate()
    {
        $basic = GeneralSettings::first();
        $data['page_title'] = "Exchange Rate";
        $data['currency'] = Currency::whereDeleted_at(Null)->orderBy('symbol','asc')->get();

        if($basic->maintain == 1){
        return view('front.maintain', $data);
        }

        return view('landing.rate', $data);
        // return view('front.rate', $data);
    }

   public function privacy()
    {
        $basic = GeneralSettings::first();
        $data['page_title'] = "Privacy & Policy";

        if($basic->maintain == 1){
        return view('front.maintain', $data);
        }

        return view('landing.privacy', $data);
    }

    public function blog()
    {
        $data['page_title'] = "Blogs";
        $data['blogs'] = Post::where('status', 1)->whereNotify(0)->latest()->get();
        return view('front.blog', $data);
    }


    public function blogview($id)
    {
        $data['page_title'] = "Blogs";
        $data['blog'] = Post::whereId($id)->first();
        return view('front.blogview', $data);
    }

    public function categoryByBlog($id)
    {
        $cat = Category::find($id);
        $data['page_title'] = "$cat->name";
        $data['blogs'] = $cat->posts()->latest()->paginate(3);
        return view('front.blog', $data);
    }

    public function details($id)
    {
        $post = Post::find($id);
        if ($post) {
            $data['page_title'] = "Blog Details";
            $data['post'] = $post;
            return view('front.details', $data);
        }
        abort(404);
    }

    public function faqs()
    {
        $data['page_title'] = "Faq";
        $data['faqs'] = Faq::all();
        return view('front.faq', $data);
    }
    public function termsCondition()
    {
        $data['page_title'] = "Terms & Condition";

        return view('front.terms', $data);
    }
    public function privacyPolicy()
    {
        $data['page_title'] = "Privacy & Policy";
        return view('front.policy', $data);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $macCount = Subscriber::where('email', $request->email)->count();
        if ($macCount > 0) {
            return back()->with('alert', 'This Email Already Exist !!');
        } else {
            Subscriber::create($request->all());
            return back()->with('success', ' Subscribe Successfully!');
        }
    }

    public function contactUs()
    {
        $data['page_title'] = "Contact Us";
        return view('front.contact', $data);
    }

    public function contactSubmit(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'subject' => 'required',
            'phone' => 'required',
        ]);
        $subject = $request->subject;
        $phone = "<br><br>" . "Contact Number : " . $request->phone . "<br><br>";

        $txt = $request->message . $phone;

        send_contact($request->email, $request->name, $subject, $txt);
        return back()->with('success', ' Contact Message Send Successfully!');
    }

    public function about()
    {
        $data['page_title'] = "About Us";
        $data['mentors'] = Mentor::all();
        $data['service'] = Service::all();
        return view('front.about', $data);
    }

    public function service($id)
    {
        $service = Service::find($id);
        if ($service) {
            $get['data'] = $service;
            $get['page_title'] = "Service";
            return view('front.service-info', $get);
        }
        abort(404);
    }

    public function menu($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            $data['page_title'] = $menu->name;
            $data['menu'] = $menu;
            return view('front.menu', $data);
        }
        abort(404);
    }


    public function register($reference)
    {
        $page_title = "Home";
        $faq = Faq::all();

        $exist = User::where('username', $reference)->count();

        if($exist > 0){
        session()->flash('ref', 'You are about to register using '.$reference.' as your sponsor. You can Also Share Your Referral Link To Earn Bonus When You Register');
        return view('auth.register',compact('faq','reference','page_title')); }

        else {
        session()->flash('referror', 'No user with this referral link. Please check and try again later');
        return redirect()->route('main');
        }
    }




    public function cronPrice()
    {
          $basic = GeneralSettings::first();
            $baseUrl = "https://api.coingate.com";
			$endpoint = "/v2/rates/merchant/USD/".$basic->currency."";
			$httpVerb = "GET";
			$contentType = "application/json"; //e.g charset=utf-8
			$headers = array (
				"Content-Type: $contentType",

        );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_URL, $baseUrl.$endpoint);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $usdrate = json_decode(curl_exec( $ch ),true);
            $err     = curl_errno( $ch );
            $errmsg  = curl_error( $ch );
        	curl_close($ch);


        	$basic['rate'] = $usdrate;
        	$basic->save();


        	$baseUrl = "https://api.alternative.me";
			$endpoint = "/v2/ticker/";
			$httpVerb = "GET";
			$contentType = "application/json"; //e.g charset=utf-8
			$headers = array (
				"Content-Type: $contentType",

        );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_URL, $baseUrl.$endpoint);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $rate = json_decode(curl_exec( $ch ),true);
            $err     = curl_errno( $ch );
            $errmsg  = curl_error( $ch );
        	curl_close($ch);




        	$coinrate  = $rate['data']['1'];
         	$amount = $coinrate['quotes']['USD'];
         	$rrate = $amount['price'];
         	$btc  = Currency::find(5);
			$btc['price'] = $rrate;
        	$btc->save();

    	    $coinrate  = $rate['data']['2'];
         	$amount = $coinrate['quotes']['USD'];
         	$rrate = $amount['price'];
         	$ltc  = Currency::find(4);
			$ltc['price'] = $rrate;
        	$ltc->save();

        	$coinrate  = $rate['data']['1321'];
         	$amount = $coinrate['quotes']['USD'];
         	$rrate = $amount['price'];
         	$eth  = Currency::find(1);
			$eth['price'] = $rrate;
        	$eth->save();

        	$coinrate  = $rate['data']['1831'];
         	$amount = $coinrate['quotes']['USD'];
         	$rrate = $amount['price'];
         	$bch  = Currency::find(3);
			$bch['price'] = $rrate;
        	$bch->save();

        	$coinrate  = $rate['data']['131'];
         	$amount = $coinrate['quotes']['USD'];
         	$rrate = $amount['price'];
         	$bch  = Currency::find(10);
			$bch['price'] = $rrate;
        	$bch->save();


    }


}
