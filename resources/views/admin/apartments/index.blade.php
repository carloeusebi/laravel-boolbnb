@extends('layouts.app')

@section('title', 'Apartments')

@section('search-bar')
    @include('includes.search-bar')
@endsection

@section('content')

    <div class="container pb-4 mt-3">

        <!-- HEADER: -->
        <h1 class="text-center h4 mt-5">I miei appartamenti</h1>
        <hr>
        <div class="d-flex justify-content-end align-items-center">
            <a class="text-center btn btn-sm btn-success fw-bold" href="{{ route('admin.apartments.create') }}">+ Aggiungi
                nuovo</a>
        </div>

        <!-- TABLE: -->
        <table class="table mb-5 mt-3 table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Indirizzo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($apartments as $apartment)
                    <tr>
                        <th scope="row">{{ $apartment->id }}</th>
                        <td>{{ $apartment->name }}</td>
                        <td>{{ $apartment->getDescription() }}</td>
                        <td>{{ $apartment->address }}</td>

                        <td>
                            <div class="d-flex justify-content-end  h-100">

                                <!--show-->
                                <a class="text-white fw-bold text-decoration-none btn btn-sm btn-primary"
                                    href="{{ route('admin.apartments.show', $apartment) }}">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <form action="{{ route('admin.apartments.messages') }}" method="GET">
                                    @csrf
                                    <input type="text" name="id" value="{{ $apartment->id }}" class="d-none">
                                    <button class="ms-2 text-white fw-bold text-decoration-none btn btn-sm btn-primary"><i
                                            class="fas fa-envelope"></i>
                                    </button>
                                </form>

                                <!--edit-->
                                <a class="ms-2 text-white fw-bold text-decoration-none btn btn-sm btn-warning"
                                    href="{{ route('admin.apartments.edit', $apartment) }}">
                                    <i class="fas fa-pencil"></i>
                                </a>

                                <!--delete-->
                                <form data-bs-toggle="modal" data-bs-target="#modal" class="delete-form"
                                    action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ms-2 btn btn-sm btn-danger">
                                        <a class="text-white fw-bold text-decoration-none" href="#">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">
                            <h3>Non ci sono appartamenti :(</h3>
                        </td>
                    </tr>
                @endforelse
                </tr>
            </tbody>
        </table>

    </div>

@endsection

@section('scripts')
    @vite('resources/js/delete-confirmation.js')
@endsection
