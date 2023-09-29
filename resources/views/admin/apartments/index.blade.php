@extends('layouts.app')

@section('title', 'Apartments')

@section('search-bar')
  @include('includes.search-bar')
@endsection

@section('content')

  <div class="container mt-3">

    <!-- HEADER: -->
    <h2 class="text-secondary">Apartments:</h2>
    <hr>
    <div class="d-flex {{ $search_value ? 'justify-content-between' : 'justify-content-end' }} align-items-center">
      @if ($search_value)
        <a class="btn btn-sm btn-secondary fw-bold" href="{{ route('admin.apartments.index') }}"><i
            class="me-2 fa-solid fa-circle-left"></i>Torna agli appartamenti</a>
      @endif
      <a class="text-center btn btn-sm btn-success fw-bold" href="{{ route('admin.apartments.create') }}">+ New
        apartment</a>
    </div>

    <!-- TABLE: -->
    <table class="table mb-5 mt-3 table-dark table-striped">
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
              <div class="d-flex justify-content-end h-100">

                <!--show-->
                <a class="text-white fw-bold text-decoration-none btn btn-sm btn-primary"
                  href="{{ route('admin.apartments.show', $apartment) }}">
                  <i class="fas fa-eye"></i>
                </a>

                <!--edit-->
                <a class="ms-2 text-white fw-bold text-decoration-none btn btn-sm btn-warning"
                  href="{{ route('admin.apartments.edit', $apartment) }}">
                  <i class="fas fa-pencil"></i>
                </a>

                <!--delete-->
                <form class="delete-form" action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST">
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

{{--
@section('scripts')
    @vite('')
@endsection
--}}
