@extends('layouts.app')

@section('content')
<div class="sign">
    <div class="brand">
            Gymania
       
    </div>
    <div class="aside">
                <div class="header">{{ __('Confirm Password') }}</div>

                    <form class="form" method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="group ">
                            <label for="password" class="label">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="control my @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          
                        </div>

                        <div class="param my-1">
                                <button type="submit" class="btn btn--primary my">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>
                    </form>
                </div>

</div>
@endsection
