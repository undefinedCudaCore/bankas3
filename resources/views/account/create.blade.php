@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header p-3 bg-secondary text-white">Sąskaitos sukūrimas</div>

               <div class="card-body">
                    <form method="POST" action="{{route('account.store')}}">
                        <div class="card-body  shadow p-3 bg-white rounded">
                            <div class="form-group">
                                {{-- <label>Sąskaitos numeris</label>
                            <input type="text" name="account_account_number" class="form-control" value=""> --}}
                                <label>Klientas</label>
                                <select name="client_id" class="form-control" multiple>
                                    @foreach ($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}} {{$client->surname}} {{$client->personal_code}}</option>
                                    @endforeach
                                </select>
                                <label>Suma</label>
                                <input type="text" name="account_amount" class="form-control" placeholder="Įrašykite sumą.">
                                <label>Kliento informacija</label>
                                <textarea name="account_client_notices" class="form-control" placeholder="Įrašykite papildomą informaciją." id="summernote"></textarea>
                                <br>

                                <small class="form-text text-muted">Prieš sukurdami patikrinkite duomenis.</small>
                            </div>
                            @csrf
                            <button type="submit" class="btn btn-success">Sukurti sąskaitą</button>
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



 