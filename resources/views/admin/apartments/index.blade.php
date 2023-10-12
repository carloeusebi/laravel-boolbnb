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

        @if ($apartments->count() > 0)
            <div class="d-flex justify-content-end align-items-center">
                <a class="text-center btn btn-sm btn-success fw-bold" href="{{ route('admin.apartments.create') }}">+ Aggiungi
                    nuovo</a>
            </div>

            <!-- TABLE: -->
            <table class="table mb-5 mt-3 table-striped ">
                <thead>
                    <tr>
                        <th></th>
                        <th scope="col">Nome</th>
                        <th class="d-none d-md-table-cell" scope="col">Descrizione</th>
                        <th scope="col">Indirizzo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apartments as $apartment)
                        <tr>
                            <td>
                                @if ($apartment->sponsored)
                                    $
                                @endif
                            </td>
                            <td>{{ $apartment->name }}</td>
                            <td class="d-none d-md-table-cell">{{ $apartment->getDescription() }}</td>
                            <td>{{ $apartment->address }}</td>

                            <td>
                                <div class="d-flex justify-content-end  h-100">

                                    <!--show-->
                                    <a class="text-white fw-bold text-decoration-none btn btn-sm btn-primary"
                                        href="{{ route('admin.apartments.show', $apartment) }}">
                                        {{-- <i class="fas fa-eye"></i> --}}
                                        Dettagli
                                    </a>

                                    <form action="{{ route('admin.apartments.messages', $apartment) }}" method="GET">
                                        @csrf
                                        <input type="text" name="id" value="{{ $apartment->id }}" class="d-none">
                                        <button
                                            class="ms-2 text-white fw-bold text-decoration-none btn btn-sm btn-primary"><i
                                                class="fas fa-envelope"></i>
                                        </button>
                                    </form>

                                    {{-- <a class="ms-2 text-white fw-bold text-decoration-none btn btn-sm btn-warning"
                                    href="{{ route('admin.apartments.edit', $apartment) }}">
                                    <i class="fas fa-pencil"></i>
                                </a>

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
 --}}
                                </div>
                            </td>
                    @endforeach
                    </tr>
                </tbody>
            </table>
        @else
            <h3 class="h5 text-center">Non hai caricato nessun appartamento,
                <a href="{{ route('admin.apartments.create') }}">Clicca qui</a>
                per caricare il tuo primo appartamento
            </h3>
        @endif

    </div>

@endsection

@section('scripts')
    @vite('resources/js/delete-confirmation.js')
@endsection
