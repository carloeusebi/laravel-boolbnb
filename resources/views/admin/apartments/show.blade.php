@extends('layouts.app')

@section('title', 'Apartment')

@section('content')

  <div id="show" class="container pt-5">

    <!-- HEADER: -->
    <header>
      <div style="max-width: 560px" class="container d-flex justify-content-between align-items-center">
        <h2 class="text-secondary">{{ $apartment->name }}</h2>
        <a class="btn btn-sm btn-secondary fw-bold" href="{{ route('admin.apartments.index') }}"><i
            class="me-2 fa-solid fa-circle-left"></i>Torna agli appartamenti</a>
      </div>
      <hr>
    </header>

    <div class="container d-flex justify-content-center align-items-center">

      <!--CARD small screen-->
      <div class="card d-md-none" style="width: 18rem;">

        @if ($apartment->thumbnail)
          <img src="{{ $apartment->getPathImage() }}" class="img-fluid" alt="{{ $apartment->name }}">
        @endif

        <div class="card-body">
          <h5 class="card-title">{{ $apartment->slug }}</h5>
          <p class="card-text">{{ $apartment->description }}</p>
          <p class="card-text fw-bold">{{ $apartment->address }}</p>

          <div class="card-text">
            <span>Stanze:</span>
            <small>{{ $apartment->rooms }}</small>
          </div>

          <div class="card-text">
            <span>Stanze da letto:</span>
            <small>{{ $apartment->bedrooms }}</small>
          </div>

          <div class="card-text">
            <span>Bagni:</span>
            <small>{{ $apartment->bathrooms }}</small>
          </div>

          <div class="card-text">
            <span>Metri quadri:</span>
            <small>{{ $apartment->square_meters }}</small>
          </div>

        </div>
      </div>

      <!--CARD medium screen-->
      <div class="card mb-3 d-none d-md-block " style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            @if ($apartment->thumbnail)
              <img src="{{ $apartment->getPathImage() }}" class="img-fluid" alt="{{ $apartment->name }}">
            @endif
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">{{ $apartment->slug }}</h5>
              <p class="card-text">{{ $apartment->description }}</p>
              <p class="card-text fw-bold">{{ $apartment->address }}</p>

              <div class="card-text">
                <span>Stanze:</span>
                <small>{{ $apartment->rooms }}</small>
              </div>

              <div class="card-text">
                <span>Stanze da letto:</span>
                <small>{{ $apartment->bedrooms }}</small>
              </div>

              <div class="card-text">
                <span>Bagni:</span>
                <small>{{ $apartment->bathrooms }}</small>
              </div>

              <div class="card-text">
                <span>Metri quadri:</span>
                <small>{{ $apartment->square_meters }}</small>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="col-10 mt-3 mx-auto d-flex justify-content-center gap-4">

      <a class="me-3 mb-3 fw-bold text-decoration-none btn btn-sm btn-warning "
        href="{{ route('admin.apartments.edit', $apartment) }}">
        <i class="pe-2 fas fa-pencil"></i>Modifica
      </a>

      <form class="d-inline delete-form" action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class=" mb-3 btn-sm btn btn-danger ">
          <span class=" fw-bold text-decoration-none" href="#">
            <i class="pe-2 fas fa-trash"></i>Elimina
          </span>
        </button>
      </form>

    </div>

  </div>

@endsection

@section('scripts')
  @vite('')
@endsection
