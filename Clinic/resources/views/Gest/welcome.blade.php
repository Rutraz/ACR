<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Clinic</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
        
    </head>
    <body style="background-color:white">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                </div>
            @endif

            <div class="content">
                <div class="m-b-md">
                <img id="stetho" src="{{asset('assets/stethoscope.png')}}"/>
                    <h1 class= "title"> Welcome </h1>
                </div>

                <div class="midleLinks">
                    <div class="item">
                        <img src="{{asset('assets/about-us.png')}}"/>
                        <p></p>
                        <a href="{{ url('/about') }}"> Sobre nos </a> 
                    </div>
                    <div class="item">
                        <img src="{{asset('assets/help.png')}}"/>
                        <p></p>
                        <a href="{{ url('/help') }}"> FAQ </a> 
                    </div>
                    <div class="item">
                        <img src="{{asset('assets/phone-contact.png')}}"/>
                        <p></p>
                        <a href="{{ url('/contact') }}"> Contactos </a> 
                    </div>
               </div>
            </div>
        </div>
    </body>
</html>
