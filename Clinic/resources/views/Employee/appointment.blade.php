@extends('layouts.employee')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ asset('js/employeeApoint.js')}}" defer></script>
<div class="appointmentPage">
    <div id="top" class="same">
        <br>
        <div class="content">

            <h1 class="title">Consultas</h1>
            <div class="midleLinks">
                <div class="item">
                    <button class="marcar">Marcar Consulta</button>
                </div>
                <div class="item">
                    <button class="consultar">Consultar Consultas</button>
                </div>
            </div>
        </div>


    </div>
    <div id="middle" class="same">
        <div class="header">
            <h1>Marcar Consultas </h1>
            <div class="float">
                <button class="inicio">Inicio</button>
                <button class="consultar">Consultar Consultas</button>
            </div>
        </div>

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

        <table id="myID" class="table specialTabel ">
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

    <div id="bottom" class="same">

        <div id="modalComent" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="changedContent">
                    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                    <h2>Modificar o estado da consulta</h2>
                    <select name="stateChange" id="stateChange">
                        <option value="3">Aceite</option>
                        <option value="4">Concluido</option>
                        <option value="5">Cancelar</option>
                    </select>
                    <br> <br>
                    <div id="error"></div>
                    <button id="send">Enviar </button>

                </div>

            </div>
        </div>


        <div id="modalMore" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="Content">
                </div>
                <hr>
                <div class="Content2">
                </div>
            </div>
        </div>

        <div class="header">
            <h1>Consultar Consultas </h1>
            <div class="float">
                <button class="inicio">Inicio</button>
                <button class="marcar">Marcar Consultas</button>
            </div>
        </div>


        <table class="table special">
            <thead>
                <tr>
                    <th class="mediumSize"> Data </th>
                    <th> Cliente </th>
                    <th> Medico </th>
                    <th> Especialidade </th>
                    <th class="mediumSize"> Estado </th>
                    <th class="mediumSize">Modificar Estado</th>
                    <th class="mediumSize">Saber Mais</th>
                </tr>
            </thead>

            <tbody id="tbody">
                @for ($i = 0; $i < sizeof($appointments); $i++) <tr>
                    <td class="mediumSize">{{$appointments[$i]->date}}</td>
                    <td>{{$appointments[$i]->client->user->name}}</td>
                    <td>{{$appointments[$i]->medic->user->name}}</td>
                    <td>{{$appointments[$i]->medic->specialty->specialty}}</td>
                    <td id="td{{$appointments[$i]->id}}" class="mediumSize"
                        style="background-color:{{$appointments[$i]->state->color}}">
                        {{$appointments[$i]->state->state}}</td>
                    @if($appointments[$i]->state->id==4)
                    <td class="mediumSize">Não é possivel modificar</td>

                    @else
                    <td id="btn{{$appointments[$i]->id}}" class="mediumSize"><button class="openModal"
                            id="{{$appointments[$i]->id}}">Modificar</button></td>
                    @endif

                    <td class="mediumSize"><button class='clickable2' id="{{$appointments[$i]->id}}tr">Saber
                            Mais</button></td>
                    </tr>
                    @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection