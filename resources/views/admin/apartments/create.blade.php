@extends('layouts.app')

@section('title', 'Crea nuovo appartamento')

@section('content')
  {{-- back button --}}
  <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary my-4">Torna alla lista</a>

  {{-- form --}}
  @include('includes.form')
@endsection

@section('scripts')
  @vite('resources/js/axios.js')
  @vite('resources/js/thumb-preview.js')
  @vite('resources/js/tomtom-api.js')

@endsection
