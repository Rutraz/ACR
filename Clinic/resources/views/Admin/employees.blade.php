@extends('layouts.admin')

@section('content')
        
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <script src="{{asset('js/inserirFunc.js')}}" defer ></script>
   
  <div class="admin">
        <form method="post" action="" id="sendemployee">
            <fieldset>
                <legend>Adicionar Funcionário</legend>
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                    Nome:<input type="text" name="name" > <br>
                    Email: <input type="text" name="email"  > <br>
                    Telefone: <input type="text" name="cellphone"  > <br>
                   
            </fieldset>
        </form>
                        <button id="inserirFunc"> Inserir </button>
        <br>
        <div class="admin-table">
            @if ($allemplos->isNotEmpty())
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
                    </tbody>
                </table>
                @else
                <h1> Tem tem clientes registados no website </h1>
                @endif
        </div>
    </div>

        

            

@endsection