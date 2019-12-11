@extends('layouts.admin')

@section('content')
<script src="{{asset('js/inserirMedico.js')}}" defer ></script>
<div class="admin">
    <form method="post" action="" id="sendmedic">
        <fieldset>
            <legend>Adicionar Médico</legend>
                Nome:<input type="text" name="name" > <br>
                Email: <input type="text" name="email"  > <br>
                Telefone: <input type="text" name="cellphone"  > <br>
                <input type="hidden" name="password" value='12345678'>
                Adse: <input type="radio" name="adse" id="adse" value="1"> Sim
                      <input type="radio" name="adse" value="0"> Não
                      <br>
                Especialidade: <select name="specialty" id="especialidades">
                                
                                </select>
                                <br>
        </fieldset>
    </form>
    <button id="inserirMedico"> Inserir </button>

    <br>
      
    <br>
    <div class="admin-table">
            @if ($medicos->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th class="size"> Id </th>
                        <th> Nome </th>
                        <th> Email </th>
                        <th> Telefone </th>
                        <th class="size"> Rating </th>
                        <th  class="size" > ADSE </th>
                        <th> Especialidade </th>
                        <th  class="size" > Editar </th>
                        <th  class="size" > Eliminar </th>

                    </tr>
                </thead>
                <tbody>

                    @foreach($medicos as $medico)
                    <tr>
                        <td class="size"> {{$medico->id}} </td>
                        <td> {{$medico->user->name}} </td>
                        <td > {{$medico->user->email}}</td>
                        <td>{{$medico->user->cellphone}}</td>
                        <td  class="size"> {{$medico->rating}} </td>
                        @if($medico->adse == 1)
                        <td  class="size" > Sim </td>
                        @else
                        <td  class="size" > Não </td>
                        @endif
                        <td>{{$medico->specialty->specialty}}</td>
                        <td  class="size" >
                            <form action="/admin/medics/{{$medico->id}}" method="POST">
                                @csrf
                                <button type="submit">Editar</button>
                            </form>
                        </td>
                        <td  class="size">
                            <form action="/admin/medics/{{$medico->id}}" method="POST">
                                @csrf
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h1> Tem tem clientes registados no website </h1>
            @endif

    </div>
</div>
       
 
@endsection