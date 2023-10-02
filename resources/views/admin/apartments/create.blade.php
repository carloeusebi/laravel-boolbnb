@extends('layouts.app')

@section('title', 'Crea nuovo appartamento')

@section('content')
  {{-- back button --}}
  <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary my-4">Torna alla lista</a>

  {{-- form --}}
  @include('includes.form')
@endsection