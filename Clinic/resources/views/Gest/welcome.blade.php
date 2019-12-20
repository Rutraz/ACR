<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

</head>

<body style="background-color:white">
<div class="containerGuestWelcome"  style="background-image:url('{{ asset('assets/Gest/test.jpg') }}')"> 
    <div class="full-height">
        @if (Route::has('login'))
        <div class="links">
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
        </div>
        @endif

        <div class="content">
            <div class="m-b-md">
               
                <img id="image-logo"  class="stetho" src="{{asset('assets/Gest/healthcare-logo1.png')}}"  />
                   
                <img id="size" class="rotate-vert-center stetho"  src="{{asset('assets/Gest/healthcare-logo2.png')}}" />   
                    <h1 class="title text-focus-in"> HealthCare </h1>
                    
            </div>

            <div class="midleLinks">
                <div class="item">
                    <img src="{{asset('assets/Gest/about-us.png')}}" />
                    <p></p>
                    <a class="jello-horizontal" href="{{ url('/about') }}"> Sobre nos </a>
                </div>
                <div class="item">
                    <img src="{{asset('assets/Gest/help.png')}}" />
                    <p></p>
                    <a href="{{ url('/help') }}"> FAQ </a>
                </div>
                <div class="item">
                    <img src="{{asset('assets/Gest/phone-contact.png')}}" />
                    <p></p>
                    <a href="{{ url('/contact') }}"> Contactos </a>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        <p>Created by: <a href="mailto:2040416@student.uma.pt">Ricardo Jardim</a> , <a
                href="mailto:2018915@student.uma.pt">Vitor Velosa</a> , <a href="mailto:2095415@student.uma.pt">João
                Santos</a></p>
    </footer>
</div>
</body>

</html>