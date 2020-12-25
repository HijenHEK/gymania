@extends('layouts.app')

@section('content')
<div class="sign">
    <div class="brand">
            Gymania
       
    </div>
    <div class="aside">
                <div class="header">{{ __('Reset Password') }}</div>

                    <form class="form" method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="group ">
                            <label for="email" class="label">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="control my @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="group ">
                            <label for="password" class="label">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="control my @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="group ">
                            <label for="password-confirm" class="label">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="control my" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="group">
                                <button type="submit" class="btn btn--primary">
                                    {{ __('Reset Password') }}
                                </button>
                        </div>
              
                </div>
            
</div>
@endsection
