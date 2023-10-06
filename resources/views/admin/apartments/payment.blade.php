@extends('layouts.app')

@section('title', 'Pagamento')

@section('content')
  pagina pagamento

  {{-- empty container for the Drop-I-in --}}
  <div id="dropin-container"></div>
@endsection

@section('scripts')
  @vite('resources/js/dropin-create.js')
@endsection
