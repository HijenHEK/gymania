@extends('layouts.app')

@section('content')
<div class="sign">
    <div class="aside">
        <div class="header">{{ __('Login') }}</div>
        <form class="form" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="group">
                    <label for="username" class="label">{{ __('Username') }}</label>

                    <input id="username" type="text" class="control my @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="group">
                    <label for="password" class="label">{{ __('Password') }}</label>

                    <input id="password" type="password" class="control my @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="group">
                    <div class="check">
                        <input class="check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
            </div>

            <div class="param">
                    <button type="submit" class="btn btn--primary my">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                                <a  href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                    @endif
            </div>
        </form>
    </div>
</div>
@endsection
