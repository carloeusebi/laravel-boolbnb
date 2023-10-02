@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Registrazione</div>

          <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <div class="mb-4 row">

                {{-- First name --}}
                <div class="col-md-6">
                  <label for="first_name" class="form-label text-md-right">{{ __('Name') }}</label>
                  <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                    name="first_name" value="{{ old('first_name') }}" required autocomplete="fisrt_name" autofocus>
                  @error('first_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                {{-- Last name --}}
                <div class="col-md-6">
                  <label for="last_name" class="form-label text-md-right">Cognome</label>
                  <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                    name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" autofocus>
                  @error('last_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-4 row">

                {{-- Email --}}
                <div class="col-md-6">
                  <label for="email" class="form-label text-md-right">Email *</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                {{-- Birthday --}}
                <div class="col-md-6">
                  <label for="birthday" class="form-label text-md-right">Data di nascita</label>
                  <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror"
                    name="birthday" value="{{ old('birthday') }}" autocomplete="birthday">
                  @error('birthday')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-4 row">

                {{-- Password --}}
                <div class="col-md-6">
                  <label for="password" class="form-label text-md-right">{{ __('Password') }} *</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                {{-- Password confirm --}}
                <div class="col-md-6">
                  <label for="password-confirm" class="form-label text-md-right">{{ __('Confirm Password') }} *</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
                </div>
              </div>

              {{-- Register button --}}
              <div class="text-end">
                <button type="submit" class="btn btn-primary">
                  {{ __('Register') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
