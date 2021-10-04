<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Manage Banks";
        $data['banks'] = Bank::orderBy('id', 'desc')->get();
        return view('admin.bank.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'account' => 'required',
        ],[
            'name.required' => 'Enter bank  number',
            'account.required' => 'Enter Payment Details ',
        ]);
        Bank::create($request->all());
        return back()->with('success','Bank created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'account' => 'required',
        ],[
            'name.required' => 'Enter bank  number',
            'account.required' => 'Enter Payment Details ',
        ]);
        $data = Bank::find($request->id);
        $in = Input::except('_method','_token');
        $data->fill($in)->save();
        return back()->with('success','Bank Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = Bank::find($id);
        $data->delete();
        return back()->with('success','Bank deleted Successfully');
    }
}
