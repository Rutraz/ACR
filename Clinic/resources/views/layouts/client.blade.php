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
    <div id="client">
        <nav class="topnav">
            <div>
                <a href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <a  href="{{ url('/about') }}">
                    Sobre nos
                </a>

                <a href="{{ url('/help') }}">
                    FAQ
                </a>

                <a href="{{ url('/contact') }}">
                    Contactos
                </a>
            </div>

        </nav>
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>