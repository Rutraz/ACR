@extends('layouts.admin')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{asset('js/inserirMedico.js')}}" defer ></script>
<div class="admin">
    <form method="post" action="" id="sendmedic">
        <h3>Adicionar Médico</h3>
        <fieldset class ="container">
        <input type="hidden" name="_token" value="{{csrf_token()}}"> 
            <div class ="item">
                <label for="name" >{{ __('Nome: ') }}</label>
                <input  type="text" name="name"> 
                
                <div class="ajust-left">
                    <label for="name" >{{ __('Email: ') }}</label>
                    <input    type="text" name="email"> 
               </div>
               
               <div class="ajust-left">
                <label for="name" >{{ __(' Telefone: ') }}</label>
                <input type="text" name="cellphone"  > <br>
               </div>
            </div>
                <br>
            <div class ="item" >
               
            
                <label for="name" >{{ __('Adse: ') }}</label>  
                <input type="radio" name="adses" id="adse" value="1"> Sim
                <input type="radio" name="adse" value="0"> Não
              
                <div class="ajust-left1">
                <label for="name" >{{ __(' Especialidade: ') }}</label>  
                    <select name="specialty" id="especialidades" value=""> </select>
                </div>   
            </div>   
              
                
                            </fieldset>
                        </form>
                   
                        <div class="test">
                        <button id="inserirMedico"> Inserir </button>
                        </div>
                        

    <br>
      
    <div class="admin-table">
        
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
                <tbody id="tbdoymedic">
                @if ($medicos->isNotEmpty())
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
                @else
                <tr id="trEmpty"  ><td>Não têm Medicos no Website</td></tr>
                @endif
                </tbody>
            </table>
    </div>
</div>
       
 
@endsection