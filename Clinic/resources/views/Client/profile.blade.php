@extends('layouts.client')

@section('content')
<div class="container">

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <h1> Cliente</h1>

        <h2>{{$user->name}}</h2>
        <h2>{{$user->email}}</h2>
        <h2>{{$client->user_id}}</h2>
        <h2>{{$client->CC}}</h2>
        <h2>{{$client->adse}}</h2>
        <h2>{{$client->morada}}</h2>
        <h2>{{$client->idade}}</h2>    
        <hr>
        <h1>Consultas</h1>
        @if ($appointments->isNotEmpty())
            @foreach($appointments as $appointment) 
                <h1>{{$appointment->date}}</h1>
                    <ul>
                <li>{{$appointment->state}}</li> 
                <li>{{$appointment->comments}}</li> 
                <li>{{$appointment->medic->user->name}}</li>                   
                    </ul>
            @endforeach
        @else
            <h1> Nao tem consultas marcadas ou realizadas </h1>
        @endif
        <hr>
        <h1>Analises</h1>
        @if ($analysis->isNotEmpty())
            @foreach($analysis as $analyse) 
                    <h1>{{$analyse->date}}</h1> 
                    <h2>{{$analyse->state}}</h2> 
                @endforeach
        @else
            <h1> Nao tem analises marcadas ou realizadas </h1>
        @endif
</div>

</div>
@endsection