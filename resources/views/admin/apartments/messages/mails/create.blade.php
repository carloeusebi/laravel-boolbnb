@extends('layouts.app')


@section('content')
    <form class="row g-3 mt-5" method="POST" action="{{ route('admin.apartments.messages.mails.reply') }}">
        <p class="mb-4 text-end" novalidate>
            * I campi sono obbligatori
        </p>
        <div class="col-md-6">
            <label for="admin-name" class="form-label">Nome*</label>
            <input type="text" class="form-control" id="admin-name" name="admin-name">
        </div>
        <div class="col-md-6">
            <label for="admin-email" class="form-label">Email*</label>
            <input type="email" class="form-control" id="admin-email" name="admin-email">
        </div>
        <div class="col-12">
            <label for="message" class="form-label">Messaggio*</label>
            <textarea name="message" id="message" cols="30" rows="10" class="form-control" name="message"></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Invia Mail</button>
        </div>
    </form>
@endsection
