@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header p-3 bg-secondary text-white">Sąskaitos duomenų redagavimas</div>

               <div class="card-body">
                    <form method="POST" action="{{route('account.update',[$account])}}">
                        <div class="card-body  shadow p-3 bg-white rounded">
                            <div class="form-group">
                                
                                <label>Sąskaitos numeris</label>
                                <input type="text" name="account_account_number" value="{{$account->account_number}}" class="form-control" readonly>
                                <label>Suma</label>
                                <small class="form-text text-muted">Norėdami pridėti sumą tiesiog rašome sumą. Norėdami atimti sumą naudojame minusą " - " pradžioje skaičiaus.</small>
                                <input type="text" name="account_amount" class="form-control">
                                <label>Kliento informacija</label>
                                <textarea name="account_client_notices" class="form-control" id="summernote">{{$account->client_notices}}</textarea>
                                <br>
                                <label>Klientas. Pinigų suma: {{$account->amount}} €</label>
                                <select name="client_id" class="form-control">
                                    @foreach ($clients as $client)
                                        <option value="{{$client->id}}" @if($client->id == $account->client_id) selected @endif>
                                            {{$client->name}} {{$client->surname}} {{$client->personal_code}}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Prieš saugodami patikrinkite duomenis.</small>
                            </div>
                            @csrf
                            <button type="submit" class="btn btn-success">Išsaugoti</button>
                        </div>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
<script>
    $(document).ready(function() {
       $('#summernote').summernote();
     });
</script>
@endsection



