@extends('layouts.app')

@section('content')
<div class="loginCont">
    <h2>{{ __('Register') }}</h2>

        <form method="POST" action="{{ route('register') }}" class="loginForm">
            @csrf
      
            <div class="logItem">
                <label for="name" >{{ __('Nome') }}</label>
                <input id="name" type="text" class="loginput @error('name') invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Introduza o seu nome" required autocomplete="name" autofocus>

                @error('name')
                    <span class="feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                           
            </div>

            <div class="logItem">
                <label for="email">{{ __('E-Mail') }}</label>                        
                <input id="email" type="email" class="loginput @error('email') invalid @enderror" name="email" placeholder="Introduza o seu email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                            
             </div>

            <div class="logItem">
                <label for="password" >{{ __('Password') }}</label>                 
                <input id="password" type="password" class="loginput @error('password') invalid @enderror" name="password" placeholder="Introduza a sua password" required autocomplete="new-password" minlength="8">

                @error('password')
                    <span class="feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                           
             </div>

             <div class="logItem">
                <label for="password-confirm" >{{ __('Confirme a Password') }}</label>
                <input id="password-confirm" type="password" class="loginput" name="password_confirmation" placeholder="Comfirme a sua password" required autocomplete="new-password">
            </div>

            <div class="logItem">
                <label for="cellphone" >{{ __('Telemovel') }}</label>
                <input id="cellphone" type="text" class="loginput @error('cellphone') invalid @enderror" name="cellphone" placeholder="Numero de Telemovel" value="{{ old('cellphone') }}" maxlength="9" required autofocus>

                @error('cellphone')
                    <span class="feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                           
            </div>

            <div class="logItem">
                <label for="idade" >{{ __('Idade') }}</label>
                <input id="idade" type="date" class="loginput @error('idade') invalid @enderror" name="idade" value="{{ old('idade') }}"  placeholder="Apenas informacional" autofocus>

                @error('idade')
                    <span class="feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                           
            </div>

            <div class="logItem">
                <label for="CC" >{{ __('CC') }}</label>
                <input id="CC" type="text" class="loginput @error('CC') invalid @enderror" name="CC" placeholder="Cartao de cidadão" value="{{ old('CC') }}" required autofocus>

                @error('CC')
                    <span class="feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                           
            </div>
               
            <div class="logItem">
                <label for="adse" >{{ __('Adse') }}</label>
                <input id="adse" type="text" class="loginput @error('adse') invalid @enderror" name="adse" value="{{ old('adse') }}" placeholder="ADSE se beneficiar " autofocus>

                @error('adse')
                    <span class="feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                           
            </div>

            <div class="logItem">
                <label for="morada" >{{ __('morada') }}</label>
                <input id="morada" type="text" class="loginput @error('morada') invalid @enderror" name="morada" value="{{ old('morada') }}" placeholder="Introduza a sua morada" required autofocus>

                @error('morada')
                    <span class="feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                           
            </div>

            <button type="submit" class="logButton">
                {{ __('Register') }}
            </button>
    </form>
</div>
@endsection
