@extends('layouts.app')

@section('content')
<div class="loginCont">
    <h2>{{ __('Reset Password') }}</h2>

    <form method="POST" action="{{ route('password.email') }}" class="loginForm">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="logItem">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="loginput @error('email') invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autocomplete="email" autofocus>

            @error('email')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror   
        </div>

        <button type="submit" class="logButton">
            {{ __('Send Password Reset Link') }}
        </button>
                    
    </form>
</div>
@endsection
