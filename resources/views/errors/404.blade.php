@extends('layouts.app')


@section('content')
    <div>
        <h1 class="main-color text-center mt-5">Pagina non trovata</h1>
        <div class="d-flex justify-content-center">
            <a href="{{ route('dashboard') }}" class="btn btn-primary text-center d-inline-block">Torna indietro</a>
        </div>
    </div>
@endsection
