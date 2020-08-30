@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
            <div class="card-header p-3 bg-secondary text-white">Kliento kortelė</div>

               <div class="card-body">
               <div class="card-body shadow p-3 bg-white rounded">
                <label>Klientas</label>
                <h4>{{$account->accountClient->name}} {{$account->accountClient->surname}}</h4>
                <label>Asmens kodas</label>
                <h4>{{$account->accountClient->personal_code}}</h4>
                <label>Sąskaitos numeris</label>
                <h4>{{$account->account_number}}</h4>
                <label>Sąskaitos suma</label>
                <h4>{{$account->amount}} €</h4>
                <label>Profesija</label>
                <h4>{!!$account->client_notices!!}</h4>
               </div>
               </div>
               {{-- <div class="card-body">
                @foreach ($client as $client)
                  <a href="{{route('client.edit',[$client])}}">{{$client->name}} {{$client->surname}} {{$client->personal_code}}</a>
                  <form method="POST" action="{{route('client.destroy', [$client])}}">
                    @csrf
                  </form>
                  <br>
                @endforeach
               </div> --}}
           </div>
       </div>
   </div>
</div>
@endsection
