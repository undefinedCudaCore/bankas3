<?php

namespace App\Http\Controllers;

use Validator;
use App\Client;
use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::all();
        // $accounts = Account::orderBy('account_number')->get();
        return view('account.index', ['accounts' => $accounts]);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view('account.create', ['clients' => $clients]);
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            // 'account_account_number' => ['required', 'min:20', 'max:20'],
            'account_amount' => ['required', 'min:1', 'max:200'],
            'account_client_notices' => ['required']
        ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        if ($request->account_amount < 0) {
            return redirect()->route('account.index')->with('info_message', 'Neigiamas skaicius negalimas kuriant sąskaitą.');
        }
        $account = new Account;
        // $request->account_account_number = $this->accountGenerator();
        $account->account_number = $this->accountGenerator();
        $account->amount = $request->account_amount;
        $account->client_notices = $request->account_client_notices;
        $account->client_id = $request->client_id;
        $account->save();
        return redirect()->route('account.index')->with('success_message', 'Sąskaita sėkmingai sukurta.');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return view('account.show', ['account' => $account]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        $clients = Client::all();
        return view('account.edit', ['account' => $account, 'clients' => $clients]);
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $validator = Validator::make($request->all(),
        [
            // 'account_account_number' => ['required', 'min:20', 'max:20'],
            'account_amount' => ['required', 'min:1', 'max:200'],
            'account_client_notices' => ['required']
        ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        
        $account->account_number = $request->account_account_number;

        if ($request->account_amount < 0) {
            if (($account->amount + $request->account_amount) < 0) {
                $account->amount = 0;
            } else {
                $account->amount = $account->amount + $request->account_amount;
            }
        } else {
            $account->amount = $account->amount + $request->account_amount;
        }

        // $account->amount = $account->amount + $request->account_amount;
        $account->client_notices = $request->account_client_notices;
        $account->client_id = $request->client_id;
        $account->save();
        return redirect()->route('account.index')->with('success_message', 'Sąskaitos informacija sėkmingai pakeista.');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        if(!empty($account->amount)){
            return redirect()->route('account.index')->with('info_message', 'Trinti negalima, sąskaita nėra tuščia!');
        }
        $account->delete();
        return redirect()->route('account.index')->with('success_message', 'Sąskaita sėkmingai ištrinta.');
 
    }
    public function accountGenerator()
    {
        $string1 = '';
        $string2 = '';
        $string3 = '';
        $string4 = '';
        $string1 .= str_pad(rand(0,99), 2, "0", STR_PAD_LEFT);
        $string2 .= str_pad(rand(0,99), 4, "0", STR_PAD_LEFT);
        $string3 .= str_pad(rand(0,99), 4, "0", STR_PAD_LEFT);
        $string4 .= str_pad(rand(0,99), 4, "0", STR_PAD_LEFT);

        $generated = 'LT'.$string1.' '.'7300'.' '.$string2.' '.$string3.' '.$string4;
        // $request->account_account_number = $generated;
        // $account->account_number = $request->account_account_number;
        return $generated;
    }
}
