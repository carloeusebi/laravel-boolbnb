@extends('layouts.app')


@section('content')
    <form class="row g-3 mt-5" method="POST" action="{{ route('admin.apartments.messages.mails.reply', $message) }}">
        @csrf
        <p class="mb-4 text-end" novalidate>
            * I campi sono obbligatori
        </p>
        <div class="col-md-6">
            <label for="subject" class="form-label">Oggetto*</label>
            <input type="text" class="form-control" id="subject" name="subject">
        </div>
        <div class="col-md-6">
            <label for="admin_email" class="form-label">Email*</label>
            <input type="email" class="form-control" id="admin_email" name="admin_email"
                value="{{ Auth::user()->email }}">
        </div>
        <div class="col-md-6 d-none">
            <input type="email" class="form-control" id="user_email" name="user_email" value="{{ $message->email }}">
            <input type="text" class="form-control" id="user_message_id" name="user_message_id"
                value="{{ $message->id }}">

        </div>

        <div class="col-12">
            <label for="content" class="form-label">Messaggio*</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Invia Mail</button>
        </div>
    </form>
@endsection
