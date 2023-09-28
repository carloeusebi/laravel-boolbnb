@if ($apartment->exists)
  {{-- edit --}}
  <form method="POST" action="{{ route('admin.apartments.update', $apartment) }}" class="mt-4"
    enctype="multipart/form-data">
    {{-- metod --}}
    @method('PUT')
  @else
    {{-- create --}}
    <form method="POST" action="{{ route('admin.apartments.store') }}" class="mt-4">
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
    @error('name')
      <div id="nameFeedback" class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  {{-- address --}}
  <div class="mb-3 col-sm-12 col-lg-6">
    <label for="address" class="form-label">Indirizzo *</label>
    <input type="text" class="form-control  @error('address') is-invalid @enderror" name="address" id="address"
      value="{{ old('address', $apartment->address) }}" placeholder="Inserisci qui l'indirizzo">

    {{-- error message --}}
    @error('address')
      <div id="addressFeedback" class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  {{-- rooms --}}
  <div class="mb-3 col-sm-12 col-lg-3">
    <label for="rooms" class="form-label">Numero stanze</label>
    <input type="number" min="1" max="100" step="1"
      class="form-control  @error('rooms') is-invalid @enderror" name="rooms" id="rooms"
      value="{{ old('rooms', $apartment->rooms) }}">

    {{-- error message --}}
    @error('rooms')
      <div id="roomsFeedback" class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  {{-- bedrooms --}}
  <div class="mb-3 col-sm-12 col-lg-3">
    <label for="bedrooms" class="form-label">Numero camere da letto</label>
    <input type="number" min="1" max="100" step="1"
      class="form-control  @error('bedrooms') is-invalid @enderror" name="bedrooms" id="bedrooms"
      value="{{ old('bedrooms', $apartment->bedrooms) }}">

    {{-- error message --}}
    @error('bedrooms')
      <div id="bedroomsFeedback" class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  {{-- bathrooms --}}
  <div class="mb-3 col-sm-12 col-lg-3">
    <label for="bathrooms" class="form-label">Numero bagni</label>
    <input type="number" min="1" max="100" step="1"
      class="form-control  @error('bathrooms') is-invalid @enderror" name="bathrooms" id="bathrooms"
      value="{{ old('bathrooms', $apartment->bathrooms) }}">

    {{-- error message --}}
    @error('bathrooms')
      <div id="bathroomsFeedback" class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  {{-- square_meters --}}
  <div class="mb-3 col-sm-12 col-lg-3">
    <label for="square_meters" class="form-label">Metri quadri</label>
    <input type="number" min="1" max="999" step="0.5"
      class="form-control  @error('square_meters') is-invalid @enderror" name="square_meters" id="square_meters"
      value="{{ old('square_meters', $apartment->square_meters) }}">

    {{-- error message --}}
    @error('square_meters')
      <div id="square_metersFeedback" class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  {{-- description --}}
  <div class="mb-3 col-12">
    <label for="description" class="form-label">Descrizione *</label>
    <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description"
      rows="5">{{ old('description', $apartment->description) }}</textarea>

    {{-- error message --}}
    @error('description')
      <div id="descriptionFeedback" class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  {{-- thumbnail --}}
  <div class="col-sm-12 col-lg-7">
    <div class="mb-3">
      <label for="thumbnail" class="form-label">Immagine</label>
      <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" id="thumbnail"
        name="thumbnail">
      {{-- error message --}}
      @error('thumbnail')
        <div id="thumbnailFeedback" class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
  </div>
  {{-- preview --}}
  <div class="col-sm-12 col-lg-2">
    <img
      src="{{ $apartment->thumbnail ? $apartment->getPathImage() : 'https://marcolanci.it/utils/placeholder.jpg' }}"
      class="img-fluid" id="thumb-preview" alt="preview">
  </div>
</div>

{{-- submit --}}
<div class="d-flex justify-content-end mt-4">
  <button class="btn btn-success">Salva</button>
</div>

</form>
