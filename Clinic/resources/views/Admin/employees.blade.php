@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <h1> Funcionarios</h1>

        <a href=/admin/employees/create> Adicionar funcionário </a> <h3> Lista de funcionários </h3>

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
                        <td> {{$emplo->id}} </td>
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