<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('/css/admin.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="sidenav">
        <header>
            <a href="{{ url('/admin') }}">{{$user->name}}</a>
        </header>
        <a href="{{ url('/admin/clients') }}">
            <img src="{{asset('assets/Both/profile.png')}}" /> Clientes
        </a>

        <a href="{{ url('/admin/medics') }}">
            <img src="{{asset('assets/Both/appointment.png')}}" /> Medicos
        </a>

        <a href="{{ url('/admin/employees') }}">
            <img src="{{asset('assets/support-icon.png')}}" /> Funcionarios
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"> <img src="{{asset('assets/logout-icon.png')}}" /> Logout</button>
        </form>
    </nav>


    <main>
        @yield('content')
    </main>

</body>

</html>