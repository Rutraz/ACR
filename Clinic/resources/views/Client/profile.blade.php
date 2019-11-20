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

        <h1>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, ea omnis esse dolorum quisquam numquam quae accusamus quia repellat odit! Sed beatae rerum quibusdam vitae minus voluptates dignissimos illum numquam!</h1>
        <h1>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus, repellat sunt facilis magnam quos, ab cupiditate aliquid quod odio exercitationem quibusdam minima nostrum vel nihil, accusamus recusandae fugit. Placeat, quisquam.</h1>
        <h1>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet pariatur quaerat accusamus praesentium sed, itaque alias quia magnam? Maxime quaerat possimus dolorem fugit nobis numquam repellat repudiandae tempora magnam illum.</h1>
    </div>

</div>
@endsection