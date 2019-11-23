@extends('layouts.app')

@section('content')
<div class="loginCont">
    <h2>{{ __('Reset Password') }}</h2>

    <form method="POST" action="{{ route('password.update') }}" class="loginForm">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="logItem">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="loginput @error('email') invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required placeholder="Enter your email" autocomplete="email" autofocus>

            @error('email')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="logItem">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="loginput @error('password') invalid @enderror" name="password" required autocomplete="new-password" minlength="8">

            @error('password')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror                  
        </div>

        <div class="logItem">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="loginput" name="password_confirmation" required autocomplete="new-password">                    
        </div>

        <button type="submit" class="logButton">
            {{ __('Reset Password') }}
        </button>
                          
    </form>
</div>
@endsection
