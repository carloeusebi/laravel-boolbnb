@extends('layout.app')

@section('content')
  {{-- back button --}}
  <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary">Torna alla lista</a>

  {{-- form --}}
  @include('includes.form')
@endsection
