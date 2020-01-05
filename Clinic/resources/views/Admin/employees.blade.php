@extends('layouts.admin')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{asset('js/inserirFunc.js')}}" defer></script>
<div class="admin">
    <form method="post" action="" id="sendemployee">
        <h3>Adicionar Funcionário</h3>
        <fieldset>
            <div class="container">
                <div class="item">
                    <label for="name">{{ __('Nome: ') }}</label>
                    <input type="text" name="name" required>
                    <div class="ajust-left">
                        <label for="name">{{ __('Email: ') }}</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="ajust-left">
                        <label for="name">{{ __('Telefone: ') }}</label>
                        <input type="text" name="cellphone" required>
                    </div>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </fieldset>
    </form>
    <div class="test">
        <button id="inserirFunc"> Inserir </button>
    </div>
    <br>
    <br>

    <!--****************************MODAL**************************-->
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="changedContent">
                <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                <h1> Editar Funcionario </h1>
                <label for="name">{{ __('Nome: ') }}</label>
                <input type="text" id="names">
                <label for="name">{{ __('Email: ') }}</label>
                <input type="email" id="emails">
                <label for="name">{{ __('Telefone: ') }}</label>
                <input type="text" id="cellphones">
                <div id="error"></div>
                <button id="sendEditar">Enviar </button>

            </div>
        </div>
    </div>

    <div class="admin-table">
        <table>
            <thead>
                <tr>
                    <th class="size"> Id </th>
                    <th class="replace"> Nome </th>
                    <th> Email </th>
                    <th> Telefone </th>
                    <th class="size"> Editar </th>
                    <th class="size"> Eliminar </th>
                </tr>
            </thead>

            <tbody id="tbdoyemployee">
                @if ($allemplos->isNotEmpty())
                @foreach($allemplos as $emplo)
                <tr>
                    <td class="size"> {{$emplo->id}} </td>
                    <td id="nameTd{{$emplo->id}}"> {{$emplo->user->name}} </td>
                    <td id="emailTd{{$emplo->id}}"> {{$emplo->user->email}}</td>
                    <td id="cellTd{{$emplo->id}}">{{$emplo->user->cellphone}}</td>
                    <td class="size">
                        <input type="hidden" id="name{{$emplo->id}}" value="{{$emplo->user->name}}">
                        <input type="hidden" id="email{{$emplo->id}}" value="{{$emplo->user->email}}">
                        <input type="hidden" id="cellphone{{$emplo->id}}" value="{{$emplo->user->cellphone}}">

                        <button id="{{$emplo->id}}" class="change edit" type="submit">Editar</button>
                    </td>

                    <td class="size">
                        <form action="/admin/employee/{{$emplo->id}}" method="POST">
                            @csrf
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr id="trEmpty">
                    <td> Tem tem funcionários registados no website </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>





@endsection