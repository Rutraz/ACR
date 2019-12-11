@extends('layouts.admin')

@section('content')
    <div class="admin">
        
        <a href=/admin/employees/create> Adicionar funcionário </a> 
        <br>
        <div class="admin-table">
            @if ($allemplos->isNotEmpty())
                <table>
                    <thead>
                        <tr>
                            <th> Id </th>
                            <th> Nome </th>
                            <th> Email </th>
                            <th> Telefone </th>

                            <th> Eliminar </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($allemplos as $emplo)
                        <tr>
                            <td > {{$emplo->id}} </td>
                            <td> {{$emplo->user->name}} </td>
                            <td> {{$emplo->user->email}}</td>
                            <td>{{$emplo->user->cellphone}}</td>
                            <td>
                                <form action="/admin/employee/{{$emplo->id}}/erase" method="POST">
                                    @csrf
                                    <button type="submit">Eliminar</button>
                                </form>

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