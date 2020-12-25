@extends('layouts.app')

@section('content')
<div class="sign">
    <div class="brand">
            Gymania
       
    </div>
            <div class="aside">
                <div class="header">{{ __('Reset Password') }}</div>

                <div class="form">
                    @if (session('status'))
                        <div class="group alert alert--success my-1" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form  method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="group ">
                            <label for="email" class="col-md-4 col-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="control my-1 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="error" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                        </div>

                        <div class="group  ">
                          
                                <button type="submit" class="btn btn--primary my">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                      
                        </div>
                    </form>
                </div>
            </div>
        
</div>
@endsection
