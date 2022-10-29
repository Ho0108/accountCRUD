<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\account_info;


class AccountInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = account_info::orderBy('id','ASC')->paginate(5);
        return view('account.index')->with('accounts', $accounts);
    }
        
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'account' => 'required|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            'name' => 'required' ,
            'sex' => 'required' ,
            'birthday' => 'required' ,
            'mail' => 'required|email'  
        ]);

        // Create account
        $accounts = new account_info();
        $accounts->account = $request->input('account');
        $accounts->name = $request->input('name');
        $accounts->sex = $request->input('sex');
        $accounts->birthday = $request->input('birthday');
        $accounts->mail = $request->input('mail');
        $accounts->remark = $request->input('remark');
        $accounts->save();

        return redirect('/accounts')->with('success', 'Account Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required' ,
            'account' => 'required'
        ]);

        //Update account
        $accounts = account_info::find($id);
        $accounts->account = $request->input('account');
        $accounts->name = $request->input('name');
        $accounts->sex = $request->input('sex');
        $accounts->birthday = $request->input('birthday');
        $accounts->mail = $request->input('mail');
        $accounts->remark = $request->input('remark');
        $accounts->save();

        return redirect('/accounts')->with('success', 'Account Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function remove(Request $request)
    {
        // Remove account
        if($request->id) {
            account_info::destroy($request->id);
           }
   
    }

    public function search()
    {
        // Search account
        $search_account = $_GET['query'];
        $accounts = account_info::where('account', 'LIKE', '%'.$search_account.'%')->get();

        return view('account.search', compact('accounts'));


    }

       

    
}
