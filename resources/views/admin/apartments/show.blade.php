@extends('layouts.app')

@section('title', 'Apartment')

@section('content')

    <div id="show" class="container pt-5">

        <!-- HEADER: -->
        <header>
            <div class="container p-0">
                <h1>{{ $apartment->name }}</h1>

                <div class="d-flex justify-content-between align-items-center">

                    {{-- back button --}}
                    <a class="btn btn-secondary fw-bold" href="{{ route('admin.apartments.index') }}"><i
                            class="fa-solid fa-circle-left"></i>
                        <span class="d-none ms-2 d-md-inline">Torna agli appartamenti</span>
                    </a>

                    <div class="d-flex gap-2">
                        {{-- sponsor button --}}
                        <a href="{{ route('admin.sponsorship', $apartment) }}" class=" fw-bold btn btn-success"
                            id="sponsor-button">
                            <i class="fa-regular fa-credit-card"></i>
                            <span class="d-none ms-2 d-md-inline">Sponsorizza</span>
                        </a>


                        {{-- edit button --}}
                        <a class="fw-bold text-decoration-none btn btn-warning "
                            href="{{ route('admin.apartments.edit', $apartment) }}">
                            <i class="fas fa-pencil"></i>
                            <span class="d-none ms-2 d-md-inline">Modifica</span>
                        </a>

                        {{-- delete modal --}}
                        <form data-bs-toggle="modal" data-bs-target="#modal" class="d-inline delete-form"
                            action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=" btn btn-danger ">
                                <span class=" fw-bold text-decoration-none" href="#">
                                    <i class="fas fa-trash"></i>
                                    <span class="d-none ms-2 d-md-inline">Elimina</span>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
        </header>

        <div class="row row-cols-1 row-cols-md-2">
            @if ($apartment->thumbnail)
                <div class="col">
                    <img src="{{ $apartment->getPathImage() }}" class="img-fluid mb-4" alt="{{ $apartment->name }}">
                </div>
            @endif
            <div class="col">

                <div class="mb-3">
                    <p class="mb-0"><strong>Promozioni attive:</strong></p>
                    @if ($apartment->sponsored)
                        Appartamento sponsorizzato fino al <span id="sponsorship-expiration"></span>.
                        <script>
                            const utcExpiration = '{{ $apartment->sponsorshipExpiration }} UTC';
                            const localizedExpiration = new Date(utcExpiration).toLocaleString();

                            document.getElementById('sponsorship-expiration').innerText = localizedExpiration;
                        </script>
                    @else
                        Nessuna
                    @endif
                </div>

                <p><strong>Descrizione dell'appartamento:</strong></p>
                <p>{{ $apartment->description }}</p>

                <p class="mb-0"><strong>Indirizzo dell'appartamento:</strong></p>
                <p>{{ $apartment->address }}</p>

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

                <p class="mt-3 mb-0 fw-bold">Statistiche delle visualizzazioni:</p>
                <div id="visits"></div>
            </div>
        </div>
    </div>

    @columnchart('Visits', 'visits')

@endsection

@section('scripts')
    @vite('resources/js/delete-confirmation.js')
    <script>
        document.getElementById('sponsor-button').addEventListener('click', () => {
            document.body.style.cursor = "wait";
        })
    </script>
@endsection
