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
                <option value="">Ambos</option>
                <option value="1">Sim</option>
                <option value="0">Não</option>
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
                    <option value="3">Nome A-Z</option>
                    <option value="4">Nome Z-A</option>
                </optgroup>
            </select>
        </div>


        <button id="searchBtn" class="buttonItem" type=button>&#9773;</button>


    </div>

    <table id="myID">
        <thead>
            <tr>
                <th class="size"> Rating </th>
                <th> Médico </th>
                <th> Especialidade </th>
                <th class="size"> ADSE </th>
            </tr>
        </thead>

        <tbody id="tbody">

        </tbody>
    </table>

</div>
@endsection