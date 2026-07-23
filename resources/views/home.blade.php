@extends('adminlte::page')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nurse Valeria') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                      <h4>{{ __('Bienvenido a tu panel de control') }}</h4>
                    
                </div>
                <img src="{{ asset('img/logotipo.jpg') }}" class="form-header-image"><br>
            </div>
        </div>
    </div>
</div>
@endsection
