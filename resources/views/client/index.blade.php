@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header p-3 bg-secondary text-white">Klientų sąrašas</div>

               <div class="card-body">
                @foreach ($clients as $client)
                  <div class="card-body shadow p-3 bg-white rounded">
                    <label style="font-size: 15px; width: 100%;" class="border-bottom">Klientas</label><br>
                    <a href="{{route('client.edit',[$client])}}" style="font-size: 25px; color: black;">{{$client->name}} {{$client->surname}}</a><br>
                    <label style="font-size: 15px; width: 100%;" class="border-bottom">Asmens kodas</label>
                    <p style="font-size: 25px;">{{$client->personal_code}}</p>
                    <form method="POST" action="{{route('client.destroy', [$client])}}">
                    @csrf
                    <button type="submit" class="btn btn-success">Ištrinti vartotoją</button>
                    </form>
                  </div>
                  <br>
                @endforeach
               </div>
           </div>
       </div>
   </div>
</div>
@endsection




