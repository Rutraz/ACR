@extends('layouts.client')

@section('content')
<script src="{{ asset('js/appointements.js')}}" defer></script>
<div class="appointment">
    <div></div>
    <div class="topnav">

        <div class="item">
            <label for="medico">Especialidade </label>
            <input id="especialidade" list="especialidades" placeholder="Especialidade" name="especialidade">
            <datalist id="especialidades">
                @if ($medicos->isNotEmpty())
                @foreach($medicos as $medico)
                <option value="{{$medico->specialty}}">
                    @endforeach
                    @endif
            </datalist>
        </div>

        <div class="item">
            <label for="medico">Medico </label>
            <input id="medico" list="medicos" name="medico" placeholder="Medico">
            <datalist id="medicos">
                @if ($medicos->isNotEmpty())
                @foreach($medicos as $medico)
                <option class="medicOption" value="{{$medico->user->name}}">
                    @endforeach
                    @endif
            </datalist>
        </div>

        <div class="item" style="width: 35%">
            <label for="search">Procurar </label>
            <div class="flexitem">
                <form id="search" action="" method="">
                    <input type="text" placeholder="Search.." name="search">
                </form>
                <button type="button">Procurar</button>
            </div>
        </div>
    </div>
    <div class="medicList">
        @if ($medicos->isNotEmpty())
        @foreach($medicos as $medico)
        <button class="medic {{$medico->specialty}} {{$medico->user->name}}" type="button">
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