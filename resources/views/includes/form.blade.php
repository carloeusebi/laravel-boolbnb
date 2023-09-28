<form>
  <div class="row">
    {{-- name --}}
    <div class="mb-3 col-sm-12 col-lg-6">
      <label for="name" class="form-label">Nome appartamento</label>
      <input type="text" class="form-control" name="name" id="name"
        placeholder="Inserire il titolo dell'inserzione">
    </div>

    {{-- address --}}
    <div class="mb-3 col-sm-12 col-lg-6">
      <label for="address" class="form-label">Indirizzo</label>
      <input type="text" class="form-control" name="address" id="address" placeholder="Inserisci qui l'indirizzo">
    </div>
  </div>

  <div class="row">
    {{-- rooms --}}
    <div class="mb-3 col-sm-12 col-lg-6">
      <label for="rooms" class="form-label">Numero stanze</label>
      <input type="number" min="1" max="100" step="1" class="form-control" name="rooms"
        id="rooms">
    </div>

    {{-- bedrooms --}}
    <div class="mb-3 col-sm-12 col-lg-6">
      <label for="bedrooms" class="form-label">Numero camere da letto</label>
      <input type="number" min="1" max="100" step="1" class="form-control" name="bedrooms"
        id="bedrooms">
    </div>
  </div>

  <div class="row">
    {{-- bathrooms --}}
    <div class="mb-3 col-sm-12 col-lg-6">
      <label for="bathrooms" class="form-label">Numero bagni</label>
      <input type="number" min="1" max="100" step="1" class="form-control" name="bathrooms"
        id="bathrooms">
    </div>

    {{-- square_meters --}}
    <div class="mb-3 col-sm-12 col-lg-6">
      <label for="square_meters" class="form-label">Metri quadri</label>
      <input type="number" min="1" max="999" step="0.5" class="form-control" name="square_meters"
        id="square_meters">
    </div>
  </div>

  <div class="row">
    {{-- description --}}
    <div class="mb-3 col-12">
      <label for="description" class="form-label">Descrizione</label>
      <textarea class="form-control" name="description" id="description" rows="3"></textarea>
    </div>
  </div>

</form>
