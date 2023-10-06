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
            <span class="fw-bold me-1 text-secondary">Stanze:</span>
            <small>{{ $apartment->rooms }}</small>
          </div>

          <div class="card-text">
            <span class="fw-bold me-1 text-secondary">Stanze da letto:</span>
            <small>{{ $apartment->bedrooms }}</small>
          </div>

          <div class="card-text">
            <span class="fw-bold me-1 text-secondary">Bagni:</span>
            <small>{{ $apartment->bathrooms }}</small>
          </div>

          <div class="card-text">
            <span class="fw-bold me-1 text-secondary">Metri quadri:</span>
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
                <span class="fw-bold me-1 text-secondary">Stanze:</span>
                <small>{{ $apartment->rooms }}</small>
              </div>

              <div class="card-text">
                <span class="fw-bold me-1 text-secondary">Stanze da letto:</span>
                <small>{{ $apartment->bedrooms }}</small>
              </div>

              <div class="card-text">
                <span class="fw-bold me-1 text-secondary">Bagni:</span>
                <small>{{ $apartment->bathrooms }}</small>
              </div>

              <div class="card-text">
                <span class="fw-bold me-1 text-secondary">Metri quadri:</span>
                <small>{{ $apartment->square_meters }}</small>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="col-10 mt-3 mx-auto d-flex justify-content-center align-items-center gap-4">

      {{-- sponsorship modal --}}
      {{-- Button trigger modal --}}
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#sponsorshipModal">
        Sponsorizza
      </button>

      {{-- Modal --}}
      <div class="modal fade" id="sponsorshipModal" tabindex="-1" aria-labelledby="sponsorshipModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="sponsorshipModalLabel">Rendi più visibile il tuo annuncio!</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <form action="{{ route('admin.apartments.payment') }}" method="POST"> --}}
            @csrf
            <div class="modal-body">
              {{-- options --}}
              @foreach ($sponsorships as $sponsorship)
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="{{ $sponsorship->name }}"
                    id="{{ $sponsorship->name }}">
                  <label class="form-check-label" for="{{ $sponsorship->name }}">
                    {{ $sponsorship->name }} - € {{ $sponsorship->price }} - Durata:
                    <strong>{{ $sponsorship->hours }} ore</strong>
                  </label>
                </div>
              @endforeach

            </div>
            <div class="modal-footer">
              <a href="{{ route('admin.apartments.payment') }}" class="btn btn-primary">test</a>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Indietro</button>
              <button type="submit" class="btn btn-success">Vai al pagamento</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      {{-- edit button --}}
      <a class="me-3 fw-bold text-decoration-none btn btn-warning "
        href="{{ route('admin.apartments.edit', $apartment) }}">
        <i class="pe-2 fas fa-pencil"></i>Modifica
      </a>

      {{-- delete modal --}}
      <form data-bs-toggle="modal" data-bs-target="#modal" class="d-inline delete-form"
        action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class=" btn btn-danger ">
          <span class=" fw-bold text-decoration-none" href="#">
            <i class="pe-2 fas fa-trash"></i>Elimina
          </span>
        </button>
      </form>

    </div>

  </div>

@endsection

@section('scripts')
  @vite('resources/js/delete-confirmation.js')
@endsection
