@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/home.css">
<main class="form-signin w-100 m-auto">
  <form method="POST" action="{{ route('login') }}">
  @csrf
    <h1 class="h3 mb-3 fw-normal">{{ __('Login') }}</h1>

    <div class="form-floating">
      <input type="email" id="floatingInput" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
      <label for="floatingPassword">Password</label>
    </div>
    <div class="text-center">
    <button class="w-100 btn btn-lg btn-primary " type="submit">Login</button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
</div>
  </form>
</main>
@endsection