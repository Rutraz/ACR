@extends('layouts.app')

@section('content')
<div class="loginCont">
    <h2>{{ __('Register') }}</h2>

        <form method="POST" action="{{ route('register') }}" class="loginForm">
            @csrf
      
            <div class="logItem">
                <label for="name" >{{ __('Name') }}</label>
                <input id="name" type="text" class="loginput @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter your name" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                           
            </div>

            <div class="logItem">
                <label for="email">{{ __('E-Mail Address') }}</label>                        
                <input id="email" type="email" class="loginput @error('email') is-invalid @enderror" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                            
             </div>

            <div class="logItem">
                <label for="password" >{{ __('Password') }}</label>                 
                <input id="password" type="password" class="loginput @error('password') is-invalid @enderror" name="password" placeholder="Enter your password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                           
             </div>

             <div class="logItem">
                <label for="password-confirm" >{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="loginput" name="password_confirmation" placeholder="Enter again your password" required autocomplete="new-password">
            </div>
           
            <button type="submit" class="logButton">
                {{ __('Register') }}
            </button>
    </form>
</div>
@endsection
