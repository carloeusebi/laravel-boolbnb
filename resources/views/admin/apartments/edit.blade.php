@extends('layouts.app')

@section('title', "Modifica $apartment->name")

@section('content')
  {{-- back button --}}
  <a href="{{ url()->previous() }}" class="btn btn-secondary my-4">Torna indietro</a>

  {{-- form --}}
  @include('includes.form')
@endsection
