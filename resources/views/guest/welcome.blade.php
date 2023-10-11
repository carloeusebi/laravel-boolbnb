@extends('layouts.app')
@section('title', 'Home')
@section('content')
  <div class="home_container">

    <div class="jumbotron p-5 my-4 rounded-3">
      <div class="container py-5">

        <h1 class="display-5 fw-bold">
          Benveuto su BoolBnB
        </h1>

        <p class="col-md-8 fs-4">Su questo portale potrai caricare nuovi appartamenti, modificare quelli già
          esistenti e
          avere accesso ai messaggi scritti dai visitatori dei tuoi annunci</p>
        @if (!Auth::user())
          <a href="{{ url('/login') }}" class="btn btn-primary btn-lg" type="button">Accedi</a>
        @endif
      </div>
    </div>
  </div>
@endsection
