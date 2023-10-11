@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="card mt-5 w-75">
            <div class="card-header">
                {{ $message->apartment->name }} - {{ $message->apartment->address }}
                @if ($message->replied_at)
                    <div class="badge text-bg-success ms-4">Risposta inviata</div>
                @endif
            </div>
            <div class="card-body">
                <p class="card-title fs-5">{{ $message->name }} - {{ $message->email }}</p>
                <p class="card-text mt-3">{{ $message->content }}</p>
                <a href="{{ route('admin.apartments.messages.mails.create', $message) }}"
                    class="btn btn-primary btn-sm">Rispondi</a>
                <a class="btn btn-sm btn-secondary btn-sm"
                    href="{{ route('admin.apartments.messages', $message->apartment) }}"><i
                        class="me-2 fa-solid fa-circle-left"></i>Torna ai messaggi</a>
            </div>
        </div>
    </div>
@endsection
