@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header p-3 bg-secondary text-white">Kliento sukūrimas</div>
               <div class="card-body">
                    <form method="POST" action="{{route('client.store')}}">
                        <div class="card-body  shadow p-3 bg-white rounded">
                            <div class="form-group">
                                <label>Vardas</label>
                                <input type="text" name="client_name" class="form-control" placeholder="Įrašykite vardą">
                                <label>Pavardė</label>
                                <input type="text" name="client_surname" class="form-control" placeholder="Įrašykite pavardę">
                                <label>Asmens kodas</label>
                                <input type="text" name="client_personal_code" class="form-control" placeholder="Įrašykite asmens kodą">
                                <small class="form-text text-muted">Prieš sukurdami patikrinkite duomenis.</small>
                            </div>
                            @csrf
                            <button type="submit" class="btn btn-success">Sukurti klientą</button>
                        </div>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection





 