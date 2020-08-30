@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-3 bg-secondary text-white">{{ __('Prietaisų skydelis') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Sėkmingai prisijungėte!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
