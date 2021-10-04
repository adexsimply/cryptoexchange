<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;
use Auth;
use App\GeneralSettings;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use File;
use Image;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Manage Currency';
        $data['currency'] = $g = Currency::get();
        //dd($g);
        return view('admin.currency.index', $data);
    }


    public function delete($id)
    {
        $data = Currency::find($id);
        $data->delete();
        $data->status = 0;
        $data->save();


        $notification =  array('message' => 'Coin Deleted Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
    }


    public function activate($id)
    {
        $data = Currency::find($id);
        $data->status = 1;
        $data->save();

        $notification =  array('message' => 'Coin Activated Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
    }


    public function deactivate($id)
    {
        $data = Currency::find($id);
        $data->status = 0;
        $data->save();

        $notification =  array('message' => 'Coin Deactivated Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Manage Currency';
        return view('admin.currency.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'buy' => 'required|min:0',
            'sell' => 'required|min:0',
            'price' => 'required|numeric|min:0',
            'symbol' => 'required',
            'payment_id' => 'required',
            'name' => 'required',
        ]);
        $in = Input::except('_method', '_token');
        $in['is_coin'] = $request->is_coin == "on" ? 1 : 0;
        $in['status'] = $request->status == "on" ? 1 : 0;


        Currency::create($in);
        return back()->with('success', 'Cryptocrrency Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        $data['currency'] = $currency;
        $data['page_title'] = "Manage Currency";
        return view('admin.currency.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {

        $request->validate([
            'buy' => 'required|min:0',
            'payment_id' => 'required',
            'sell' => 'required|min:0',
            'price' => 'required|numeric|min:0',
            'symbol' => 'required',
            'name' => 'required',
        ]);

        $data = Currency::find($request->id);
        $data['name'] = $request->name;
        $data['symbol'] = $request->symbol;
        $data['sell'] = $request->sell;
        $data['buy'] = $request->buy;
        $data['exchange'] = $request->exchange;
        $data['price'] = $request->price;
        $data['payment_id'] = $request->payment_id;
        $data->save();

        return back()->with('success', 'Currency Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        //
    }
}
