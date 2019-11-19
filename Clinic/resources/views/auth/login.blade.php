@extends('layouts.app')

@section('content')
<div class="loginCont">

    <h2>{{ __('Login') }}</h2>

    <form method="POST" action="{{ route('login') }}" class="loginForm">
        @csrf

            <div class="logItem">
                <label for="email">{{ __('E-Mail Address') }}</label>
                
                <input class="loginput @error('email') invalid @enderror" id="email" placeholder="Enter your email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                
                @error('email')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="logItem">
            <label for="password" >{{ __('Password') }}</label>
           
            <input class="loginput @error('password') invalid @enderror" placeholder="Enter your password" id="password" name="password" type="password" required autocomplete="current-password">

            @error('password')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>

            <div class="logItem">
            <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label  for="remember">
                {{ __('Remember Me') }}
            </label>
            </div>  
            
            <button type="submit" class="logButton">
                {{ __('Login') }}
            </button>
            <br>
           
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                <br> <br>
            @endif

    </form>

</div>
@endsection
