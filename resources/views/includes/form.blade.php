@section('scripts')
  @vite('resources/js/thumb-preview.js')
  @vite('resources/js/form-validation.js')
@endsection

@if ($apartment->exists)
  {{-- edit --}}
  <form id="apartment-form" method="POST" action="{{ route('admin.apartments.update', $apartment) }}" class="mt-4"
    novalidate enctype="multipart/form-data">
    {{-- metod --}}
    @method('PUT')
  @else
    {{-- create --}}
    <form id="apartment-form" method="POST" action="{{ route('admin.apartments.store') }}" class="mt-4"
      enctype="multipart/form-data" novalidate>
@endif

{{-- token --}}
@csrf

<p class="mb-4 text-end">
  * I campi sono obbligatori
</p>

<div class="row">
  {{-- name --}}
  <div class="mb-3 col-sm-12 col-lg-6">
    <label for="name" class="form-label">Titolo inserzione *</label>
    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name"
      value="{{ old('name', $apartment->name) }}" placeholder="Inserire il titolo dell'inserzione">

    {{-- error message --}}
    <div id="nameFeedback" class="invalid-feedback">
      @error('name')
        {{ $message }}
      @enderror
    </div>
  </div>

  {{-- address --}}
  <div class="mb-3 col-sm-12 col-lg-6">
    <label for="address" class="form-label">Indirizzo *</label>
    <input type="text" class="form-control  @error('address') is-invalid @enderror" name="address" id="address"
      value="{{ old('address', $apartment->address) }}" placeholder="Inserisci qui l'indirizzo"
      list="suggested-addresses">

    {{-- error message --}}
    <div id="addressFeedback" class="invalid-feedback">
      @error('address')
        {{ $message }}
      @enderror
    </div>
  </div>
  <datalist id="suggested-addresses">
  </datalist>

  {{-- rooms --}}
  <div class="mb-3 col-sm-12 col-lg-3">
    <label for="rooms" class="form-label">Numero stanze *</label>
    <input type="number" min="1" max="100" step="1"
      class="form-control  @error('rooms') is-invalid @enderror" name="rooms" id="rooms"
      value="{{ old('rooms', $apartment->rooms) }}">

    {{-- error message --}}
    <div id="roomsFeedback" class="invalid-feedback">
      @error('rooms')
        {{ $message }}
      @enderror
    </div>
  </div>

  {{-- bedrooms --}}
  <div class="mb-3 col-sm-12 col-lg-3">
    <label for="bedrooms" class="form-label">Numero camere da letto *</label>
    <input type="number" min="1" max="100" step="1"
      class="form-control  @error('bedrooms') is-invalid @enderror" name="bedrooms" id="bedrooms"
      value="{{ old('bedrooms', $apartment->bedrooms) }}">

    {{-- error message --}}
    <div id="bedroomsFeedback" class="invalid-feedback">
      @error('bedrooms')
        {{ $message }}
      @enderror
    </div>
  </div>

  {{-- bathrooms --}}
  <div class="mb-3 col-sm-12 col-lg-3">
    <label for="bathrooms" class="form-label">Numero bagni *</label>
    <input type="number" min="1" max="100" step="1"
      class="form-control  @error('bathrooms') is-invalid @enderror" name="bathrooms" id="bathrooms"
      value="{{ old('bathrooms', $apartment->bathrooms) }}">

    {{-- error message --}}
    <div id="bathroomsFeedback" class="invalid-feedback">
      @error('bathrooms')
        {{ $message }}
      @enderror
    </div>
  </div>

  {{-- square_meters --}}
  <div class="mb-3 col-sm-12 col-lg-3">
    <label for="square_meters" class="form-label">Metri quadri *</label>
    <input type="number" min="1" max="999" step="0.5"
      class="form-control  @error('square_meters') is-invalid @enderror" name="square_meters" id="square_meters"
      value="{{ old('square_meters', $apartment->square_meters) }}">

    {{-- error message --}}
    <div id="square_metersFeedback" class="invalid-feedback">
      @error('square_meters')
        {{ $message }}
      @enderror
    </div>
  </div>

  {{-- description --}}
  <div class="mb-3 col-12">
    <label for="description" class="form-label">Descrizione *</label>
    <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description"
      rows="5">{{ old('description', $apartment->description) }}</textarea>

    {{-- error message --}}
    <div id="descriptionFeedback" class="invalid-feedback">
      @error('description')
        {{ $message }}
      @enderror
    </div>
  </div>

  {{-- services --}}
  <div class="my-3 col-12">
    @foreach ($services as $service)
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" @if (in_array($service->id, old('services', $apartment_service_ids ?? []))) checked @endif
          id="tech-{{ $service->id }}" value="{{ $service->id }}" name="services[]">
        <label class="form-check-label" for="tech-{{ $service->id }}"><i
            class="fa-solid fa-{{ $service->icon }} me-1"></i>
          {{ $service->name }}</label>
      </div>

      {{-- error message --}}
      <div id="serviceFeedback" class="invalid-feedback">
        @error('service')
          {{ $message }}
        @enderror
      </div>
    @endforeach
  </div>

  {{-- thumbnail --}}
  <div class="col-sm-12 col-lg-7">
    <div class="mb-3">
      <label for="thumbnail" class="form-label">Immagine</label>
      <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" id="thumbnail"
        name="thumbnail">
      {{-- error message --}}
      <div id="thumbnailFeedback" class="invalid-feedback">
        @error('thumbnail')
          {{ $message }}
        @enderror
      </div>
    </div>
  </div>
  {{-- preview --}}
  <div class="col-sm-12 col-lg-2">
    <img
      src="{{ $apartment->thumbnail ? $apartment->getPathImage() : 'https://marcolanci.it/utils/placeholder.jpg' }}"
      class="img-fluid" id="thumb-preview" alt="preview">
  </div>
</div>
<input type="hidden" id="lat" name="lat" value={{ old('lat', $apartment->lat) }} />
<input type="hidden" id="lon" name="lon" value={{ old('lon', $apartment->lon) }} />

{{-- submit --}}
<div class="d-flex justify-content-end mt-4">
  <button class="btn btn-success">Salva</button>
</div>

</form>
