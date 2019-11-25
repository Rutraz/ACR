@extends('layouts.client')

@section('content')
<div class="appointment">
    <br>
    <div class="medicList">
        @if ($medicos->isNotEmpty())
        @foreach($medicos as $medico)
        <button class="medic" type="button">
            <h2>{{$medico->rating}}</h2>
            <h2>{{$medico->specialty}}</h2>
            <h2>{{$medico->user->name}}</h2>
        </button>
        @endforeach

        @else
        <h1> Nao tem consultas marcadas ou realizadas </h1>
        @endif
    </div>

</div>
@endsection