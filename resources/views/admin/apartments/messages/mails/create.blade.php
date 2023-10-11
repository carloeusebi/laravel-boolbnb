@extends('layouts.app')

@section('scripts')
    @vite('resources/js/mail-reply-validation.js')
@endsection


@section('content')
    <form class="row g-3 mt-5" id="mail-form" method="POST"
        action="{{ route('admin.apartments.messages.mails.reply', $message) }}">
        @csrf
        <p class="mb-4 text-end" novalidate>
            * I campi sono obbligatori
        </p>
        <div class="col-md-6">
            <label for="subject" class="form-label @error('subject') is-invalid @enderror">Oggetto*</label>
            <input type="text" class="form-control" id="subject" name="subject">
            <div id="subject_feedback" class="invalid-feedback">
                @error('subject')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <label for="admin_email" class="form-label">Email*</label>
            <input type="email" class="form-control @error('admin_email') is-invalid @enderror" id="admin_email"
                name="admin_email" value="{{ Auth::user()->email }}">
            <div id="admin_email_feedback" class="invalid-feedback">
                @error('admin_email')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-md-6 d-none">
            <input type="email" class="form-control" id="user_email" name="user_email" value="{{ $message->email }}">
            <input type="text" class="form-control" id="user_message_id" name="user_message_id"
                value="{{ $message->id }}">
        </div>

        <div class="col-12">
            <label for="content" class="form-label">Messaggio*</label>
            <textarea name="content" id="content" cols="30" rows="10"
                class="form-control @error('content') is-invalid @enderror"></textarea>
            <div id="content_feedback" class="invalid-feedback">
                @error('content')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Invia Mail</button>
            <a class="btn btn-secondary ms-2" href="{{ route('admin.apartments.messages', $message->apartment) }}"><i
                    class="me-2 fa-solid fa-circle-left"></i>Torna ai messaggi</a>
        </div>
    </form>
@endsection
