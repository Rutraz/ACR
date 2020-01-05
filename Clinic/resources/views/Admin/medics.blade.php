@extends('layouts.admin')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{asset('js/inserirMedico.js')}}" defer></script>
<div class="admin">
    <form method="post" action="" id="sendmedic">
        <h3>Adicionar Médico</h3>
        <fieldset class="container">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="item">
                <label for="name">{{ __('Nome: ') }}</label>
                <input type="text" name="name" required>

                <div class="ajust-left">
                    <label for="name">{{ __('Email: ') }}</label>
                    <input type="email" name="email" required>
                </div>

                <div class="ajust-left">
                    <label for="name">{{ __(' Telefone: ') }}</label>
                    <input type="text" name="cellphone" required> <br>
                </div>
            </div>
            <br>
            <div class="item">
                <label for="name">{{ __('Adse: ') }}</label>
                <input type="radio" name="adses" value="1"> Sim
                <input type="radio" name="adses" value="0"> Não

                <div class="ajust-left1">
                    <label for="name">{{ __(' Especialidade: ') }}</label>
                    <select name="specialty" id="especialidades" value="" required> </select>
                </div>
                <div class="ajust-left">
                    <label for="calendarId">{{ __(' ID do calendário: ') }}</label>
                    <input type="text" name="calendarId" required> <br>
                </div>
            </div>


        </fieldset>
    </form>

    <div class="test">
        <button id="inserirMedico"> Inserir </button>
    </div>


    <br>

    <!--****************************MODAL**************************-->
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="changedContent">
                <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                <h1> Editar Médico </h1>
                <br>
                <div class="container">
                    <div class="item">
                        <label for="names">{{ __('Nome: ') }}</label>
                        <input type="text" id="names">
                        <label for="emails">{{ __('Email: ') }}</label>
                        <input type="text" id="emails">
                        <label for="cellphones">{{ __('Telefone: ') }}</label>
                        <input type="text" id="cellphones">
                    </div>
                    <br>
                    <div class="item">
                        <label for="name">{{ __('Adse: ') }}</label>
                        <input type="radio" name="adses" id="adses" value="1"> Sim
                        <input type="radio" name="adses" id="adses2" value="0"> Não
                        <label for="specialty">{{ __(' Especialidade: ') }}</label>
                        <select name="specialty" id="especialidadesModal"> </select>
                    </div>
                </div>
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
                    <th> Nome </th>
                    <th> Email </th>
                    <th> Telefone </th>
                    <th class="size"> Rating </th>
                    <th class="size"> ADSE </th>
                    <th> Especialidade </th>
                    <th class="size"> Editar </th>
                    <th class="size"> Eliminar </th>

                </tr>
            </thead>
            <tbody id="tbdoymedic">
                @if ($medicos->isNotEmpty())
                @foreach($medicos as $medico)
                <tr>
                    <td class="size"> {{$medico->id}} </td>
                    <td id="nameTd{{$medico->id}}">{{$medico->user->name}}</td>
                    <td id="emailTd{{$medico->id}}">{{$medico->user->email}}</td>
                    <td id="cellTd{{$medico->id}}">{{$medico->user->cellphone}}</td>
                    <td class="size">{{$medico->rating}}</td>
                    @if($medico->adse == 1)
                    <td id="adse1Td{{$medico->id}}" class="size">Sim</td>
                    @else
                    <td id="adse1Td{{$medico->id}}" class="size">Não</td>
                    @endif
                    <td id="espTd{{$medico->id}}">{{$medico->specialty->specialty}}</td>
                    <td class="size">
                        <input type="hidden" id="name{{$medico->id}}" value="{{$medico->user->name}}">
                        <input type="hidden" id="email{{$medico->id}}" value="{{$medico->user->email}}">
                        <input type="hidden" id="cellphone{{$medico->id}}" value="{{$medico->user->cellphone}}">
                        <input type="hidden" id="adse{{$medico->id}}" value="{{$medico->adse}}">
                        <input type="hidden" id="esp{{$medico->id}}" value="{{$medico->specialty->specialty}}">

                        <button id="{{$medico->id}}" class="edit" type="submit">Editar</button>
                    </td>
                    <td class="size">
                        <form action="/admin/medics/{{$medico->id}}" method="POST">
                            @csrf
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr id="trEmpty">
                    <td>Não têm Medicos no Website</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>


@endsection