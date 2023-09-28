@extends('layouts.app');

@section('title', 'Cestino appartamenti')

@section('content')
  <table class="table my-4">
    <thead>
      <tr>
        <th scope="col">Titolo</th>
        <th scope="col">Descrizione</th>
        <th scope="col">Indirizzo</th>
        <th colspan="2"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($apartments as $apartment)
        <tr>
          <td>{{ $apartment->name }}</td>
          <td>{{ $apartment->getDescription() }}</td>
          <td>{{ $apartment->address }}</td>
          <td class="d-flex gap-2">
            <a class="btn btn-primary" href="{{ route('admin.apartments.show', $apartment) }}">Vedi</a>
            <form action="{{ route('admin.apartments.restore', $apartment->id) }}" method="POST" class="mb-0">
              @method('put')
              @csrf
              <button type="submit" class="btn btn-success">Rispristina</button>
            </form>
            <form action="{{ route('admin.apartments.drop', $apartment->id) }}" method="Post" class="mb-0">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-danger">Elimina</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="d-flex gap-2 my-5">
    <form action="{{ route('admin.apartments.restoreAll') }}" method="POST">
      @method('put')
      @csrf
      <button type="submit" class="btn btn-success">Rispristina tutto</button>
    </form>
    <form action="{{ route('admin.apartments.dropAll') }}" method="Post">
      @method('delete')
      @csrf
      <button type="submit" class="btn btn-danger">Elimina tutto</button>
    </form>
  </div>
@endsection
