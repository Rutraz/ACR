@extends('layouts.admin')

@section('content')
        
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <script src="{{asset('js/inserirFunc.js')}}" defer ></script>
   
  <div class="admin">
        <form method="post" action="" id="sendemployee">
            <h3>Adicionar Funcionário</h3>
            <fieldset>
               <div class = "container">

                    <div class = "item">
                        <label for="name" >{{ __('Nome: ') }}</label>
                        <input type="text" name="name" > 
                        <div class="ajust-left">
                            <label for="name" >{{ __('Email: ') }}</label>
                            <input type="text" name="email"  > 
                        </div>
                        <div class="ajust-left">
                            <label for="name" >{{ __('Telefone: ') }}</label>
                            <input type="text" name="cellphone"  >
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
        <div class="admin-table">
      
                <table>
                    <thead>
                        <tr>
                            <th class="size" > Id </th>
                            <th> Nome </th>
                            <th> Email </th>
                            <th> Telefone </th>
                            <th class="size" > Editar </th>
                            <th class="size" > Eliminar </th>
                        </tr>
                    </thead>
                
                    <tbody id="tbdoyemployee">
                    @if ($allemplos->isNotEmpty())
                        @foreach($allemplos as $emplo)
                        <tr>
                            <td class="size" > {{$emplo->id}} </td>
                            <td> {{$emplo->user->name}} </td>
                            <td> {{$emplo->user->email}}</td>
                            <td>{{$emplo->user->cellphone}}</td>
                            <td class="size" >
                                <form action="/admin/employee/{{$emplo->id}}" method="POST">
                                    @csrf
                                    <button type="submit">Editar</button>
                                </form>
                            </td>
                            <td class="size" >
                                <form action="/admin/employee/{{$emplo->id}}" method="POST">
                                    @csrf
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach              
                    @else            
                     <tr id="trEmpty" > <td> Tem tem funcionários registados no website </td></tr>       
                    @endif
                    </tbody>
                </table>
        </div>
    </div>

        

            

@endsection