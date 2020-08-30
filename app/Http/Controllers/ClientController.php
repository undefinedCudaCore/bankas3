<?php

namespace App\Http\Controllers;

use Validator;
use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
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
        // $clients = Client::all();
        $clients = Client::orderBy('surname')->get();
        return view('client.index', ['clients' => $clients]);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
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
            'client_name' => ['required', 'min:3', 'max:64'],
            'client_surname' => ['required', 'min:3', 'max:64'],
            'client_personal_code' => ['required', 'min:11', 'max:11']
        ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $kodas = $request->client_personal_code;
        $rest1 = substr($kodas, 0, 1); // pirmas asmens kodo skaicius;
        $rest2 = substr($kodas, 1, 2); // gimimo metai;
        $rest3 = substr($kodas, 3, 2); // gimimo mėnuo;
        $rest4 = substr($kodas, 5, 2); // gimimo diena;
        $rest5 = substr($kodas, 7, 3); // gimimusiu vienetų skaičius;
        $rest6 = substr($kodas, 10, 1); // kontrolinis skaičius;

        if ($rest1 > 6) {
            return redirect()->route('client.create')->with('success_message', 'Blogai įrašytas pirmas asmens kodo skaicius.');
        } elseif ($rest2 < 1) {
            return redirect()->route('client.create')->with('success_message', 'Blogai įrašyti gimimo metai asmens kode.');
        } elseif ($rest3 < 1 || $rest3 > 12) {
            return redirect()->route('client.create')->with('success_message', 'Blogai įrašytas gimimo mėnuo asmens kode.');
        } elseif ($rest4 < 1 || $rest4 > 31) {
            return redirect()->route('client.create')->with('Blogai įrašyta gimimo diena asmens kode.');
        } elseif ($rest5 < 1 || $rest5 > 999) {
            return redirect()->route('client.create')->with('success_message', 'Ar jus ne iš šitos planetos? O gal dar negimęs?');
        }

        $client = new Client;
        $client->name = $request->client_name;
        $client->surname = $request->client_surname;
        $client->personal_code = $request->client_personal_code;
        $client->save();
        return redirect()->route('client.index')->with('success_message', 'Klientas sėkmingai sukurtas.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(),
        [
            'client_name' => ['required', 'min:3', 'max:64'],
            'client_surname' => ['required', 'min:3', 'max:64'],
            'client_personal_code' => ['required', 'min:11', 'max:11']
        ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
 
        $kodas = $request->client_personal_code;
        $rest1 = substr($kodas, 0, 1); // pirmas asmens kodo skaicius;
        $rest2 = substr($kodas, 1, 2); // gimimo metai;
        $rest3 = substr($kodas, 3, 2); // gimimo mėnuo;
        $rest4 = substr($kodas, 5, 2); // gimimo diena;
        $rest5 = substr($kodas, 7, 3); // gimimusiu vienetų skaičius;
        $rest6 = substr($kodas, 10, 1); // kontrolinis skaičius;

        if ($rest1 > 6) {
            return redirect()->route('client.edit', ['client' => $client])->with('success_message', 'Blogai įrašytas pirmas asmens kodo skaicius.');
        } elseif ($rest2 < 1) {
            return redirect()->route('client.edit', ['client' => $client])->with('success_message', 'Blogai įrašyti gimimo metai asmens kode.');
        } elseif ($rest3 < 1 || $rest3 > 12) {
            return redirect()->route('client.edit', ['client' => $client])->with('success_message', 'Blogai įrašytas gimimo mėnuo asmens kode.');
        } elseif ($rest4 < 1 || $rest4 > 31) {
            return redirect()->route('client.edit', ['client' => $client])->with('Blogai įrašyta gimimo diena asmens kode.');
        } elseif ($rest5 < 1 || $rest5 > 999) {
            return redirect()->route('client.edit', ['client' => $client])->with('success_message', 'Ar jus ne iš šitos planetos? O gal dar negimęs?');
        }

        $client->name = $request->client_name;
        $client->surname = $request->client_surname;
        $client->personal_code = $request->client_personal_code;
        $client->save();
        return redirect()->route('client.index')->with('success_message', 'Kliento informacija sėkmingai pakeista.');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if($client->clientAccounts->count()){
            return redirect()->route('client.index')->with('info_message', 'Trinti negalima, klientas turi pridėtų sąskaitų!');
        }
        $client->delete();
        return redirect()->route('client.index')->with('success_message', 'Klientas sėkmingai ištrintas.');
 
 
    }
}
