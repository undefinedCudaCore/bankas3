@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header p-3 bg-secondary text-white">Sąskaitų sąrašas</div>

               <div class="card-body">
                 @foreach ($accounts as $account)
                  <div class="card-body  shadow p-3 bg-white rounded">
                    <label style="font-size: 15px; width: 100%;" class="border-bottom">Klientas</label><br>
                    <a href="{{route('account.edit',[$account])}}" style="font-size: 25px; color: black;">{{$account->accountClient->name}} {{$account->accountClient->surname}}</a>
                    <form method="POST" action="{{route('account.destroy', [$account])}}">
                      @csrf
                      <label style="font-size: 15px; width: 100%;" class="border-bottom">Sąskaita</label>
                      <a href="{{route('account.show', [$account])}}" style="font-size: 20px; color: black;">Sąskaitos informacija</a><br>
                      <button type="submit" class="btn btn-success">Ištrinti sąskaitą</button>
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



