@extends('layouts.app')

@section('title', 'Apartments')

@section('content')

    <div class="container">
        <!-- HEADER: -->
        <h2 class="text-secondary">Apartments:</h2>
        <hr>
        <div class="d-flex justify-content-end align-items-center">
            <a class="text-center btn btn-sm btn-success fw-bold" href="{{ route('admin.apartments.create') }}">+ New
                apartment</a>
        </div>

        <!-- TABLE: -->

    </div>

@endsection

@section('scripts')
    @vite('')
@endsection
