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
            </datalist>
        </div>

        <div class="item">
            <label for="medico">Medico </label>
            <input id="medico" list="medicos" name="medico" placeholder="Medico">
            <datalist id="medicos">
            </datalist>
        </div>

        <div class="item special">
            <label for="adse">Adse </label>
            <select id="adse" name="adse">
                <option value="1">Ambos</option>
                <option value="2">Sim</option>
                <option value="3">Não</option>
            </select>
        </div>

        <div class="item special">
            <label for="order">Ordenar por</label>
            <select id="order" name="order">
                <optgroup label="Rating">
                    <option value="1">Rating &#8600;</option>
                    <option value="2">Rating &#8599;</option>
                </optgroup>
                <optgroup label="Nome">
                    <option value="1">Nome A-Z</option>
                    <option value="2">Nome Z-A</option>
                </optgroup>
            </select>
        </div>


        <button id="searchBtn" class="buttonItem" type=button>&#9773;</button>


    </div>
    <div class="medicList">
        @if ($medicos->isNotEmpty())
        @foreach($medicos as $medico)
        <button class="medic" type="button">
            <h2>{{$medico->rating}}</h2>
            <h2>{{$medico->specialty->specialty}}</h2>
            <h2>{{$medico->user->name}}</h2>
            @if ($medico->adse == 1)
            <h2>Sim</h2>
            @else
            <h2>Não</h2>
            @endif
        </button>
        @endforeach

        @else
        <h1> Nao existe medicos com os atributos da sua pesquisa</h1>
        @endif
    </div>

</div>
@endsection