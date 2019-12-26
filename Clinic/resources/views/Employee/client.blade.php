@extends('layouts.employee')

@section('content')
<script src="{{ asset('js/searchClient.js')}}" defer></script>
<div class="medics">

    <div class="topnav">


        <div class="item2">
            <label for="medico">Nome </label>
            <input id="cliente" list="clientes" name="cliente" placeholder="Cliente">
            <datalist id="clientes">
            </datalist>
        </div>


        <div class="item2">
            <label for="medico">Cartao de Cidadão</label>
            <input id="cc" list="ccs" placeholder="cartao de cidadao" name="cc">
            <datalist id="ccs">
            </datalist>
        </div>
        <div class="item2">
            <label for="medico">Telemovel </label>
            <input id="telemovel" list="telemovels" name="telemovel" placeholder="Telemovel">
            <datalist id="telemovels">
            </datalist>
        </div>

        <div class="item2 special">
            <label for="order">Ordenar por</label>
            <select id="order" name="order">
                <optgroup label="Nome">
                    <option value="1">Nome A-Z</option>
                    <option value="2">Nome Z-A</option>
                </optgroup>
                <optgroup label="Cartao de Cidadao">
                    <option value="3">Cc &#8600;</option>
                    <option value="4">Cc &#8599;</option>
                </optgroup>
                <optgroup label="Data de Nascimento">
                    <option value="5">Data &#8600;</option>
                    <option value="6">Data &#8599;</option>
                </optgroup>
            </select>
        </div>


        <button id="searchBtn" class="buttonItem" type=button>&#9773;</button>


    </div>

    <div id="modalComent" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="changedContent">
            </div>
            <hr>
            <div class="changedContent2">
            </div>
        </div>
    </div>

    <table id="myID">
        <thead>
            <tr>
                <th> Nome </th>
                <th> Cartao de Cidadão </th>
                <th> Data de Nascimento </th>
                <th> ADSE </th>
            </tr>
        </thead>

        <tbody id="tbody">

        </tbody>
    </table>

</div>
@endsection