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
                    <th scope col class="text-center">Risposta inviata</th>
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
                        <td class="text-center">
                            @if ($message->replied_at)
                                <i class="fa-regular fa-circle-check fa-xl text-success"></i>
                            @else
                                <i class="fa-regular fa-circle-xmark fa-xl text-danger"></i>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-end h-100">

                                <!--reply-->
                                <a href="{{ route('admin.apartments.messages.mails.create', $message) }}"
                                    class="text-white fw-bold text-decoration-none btn btn-sm btn-primary">
                                    <i class="fa-solid fa-reply"></i></a>

                                <!--show-->
                                <a class="text-white fw-bold text-decoration-none btn btn-sm btn-primary position-relative ms-2"
                                    href="{{ route('admin.apartments.messages.show', $message) }}">
                                    <i class="fas fa-eye"></i>
                                    @if (!$message->read_at)
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"></span>
                                    @endif
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
        <a class="btn btn-sm btn-secondary btn-sm" href="{{ route('admin.apartments.index') }}"><i
                class="me-2 fa-solid fa-circle-left"></i>Torna agli appartamenti</a>
    @else
        <h2 class="text-center mt-4">Non ci sono messaggi</h2>
    @endif
@endsection
