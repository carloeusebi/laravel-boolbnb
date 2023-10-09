@extends('layouts.app')

@section('title', 'Messaggi')

@section('content')
    @if ($messages->count())
        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col">Nome ospite</th>
                    <th scope="col">Messaggio</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="text-center">Appartamento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->getMessage() }}</td>
                        <td>{{ $message->email }}</td>
                        <td class="text-center">{{ $message->apartment->name }} - {{ $message->apartment->address }}</td>
                        <td>
                            <div class="d-flex justify-content-end h-100">

                                <!--show-->
                                <a class="text-white fw-bold text-decoration-none btn btn-sm btn-primary"
                                    href="{{ route('admin.apartments.messages.show', $message) }}">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!--delete-->
                                {{-- <form data-bs-toggle="modal" data-bs-target="#modal" class="delete-form"
                                    action="{{ route('admin.apartments.messages.destroy', $message) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ms-2 btn btn-sm btn-danger">
                                        <a class="text-white fw-bold text-decoration-none" href="#">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </button>
                                </form> --}}

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h2 class="text-center mt-4">Non ci sono messaggi</h2>
    @endif
@endsection
