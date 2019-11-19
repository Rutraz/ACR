<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Cliente</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('/css/client.css') }}" rel="stylesheet">
</head>
<body>
        <nav class="sidenav">
                 <header>
                    <a href="{{ url('/client') }}">{{$user->name}}</a>
                 </header>
                <a href="{{ url('/client/profile') }}">
                    <img src="{{asset('assets/profile.png')}}"/> Perfil
                </a>

                <a  href="{{ url('/about') }}">
                <img src="{{asset('assets/appointment.png')}}"/> Consultas
                </a>

                <a href="{{ url('/help') }}">
                <img src="{{asset('assets/profile.png')}}"/> Analises
                </a>

                <a href="{{ url('/contact') }}">
                <img src="{{asset('assets/profile.png')}}"/> Suporte
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">  <img src="{{asset('assets/profile.png')}}"/> Logout</button>
                </form>
        </nav>


        <main>
            @yield('content')
        </main>

</body>
</html>