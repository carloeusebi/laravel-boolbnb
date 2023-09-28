@extends('layouts.app')

@section('title', 'Apartment')

@section('content')

    <div id="show" class="container pt-5">

        <!-- HEADER: -->
        <header>
            <h2 class="text-secondary">{{ $apartment->name }}</h2>

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



    </div>

@endsection

@section('scripts')
    @vite('')
@endsection
