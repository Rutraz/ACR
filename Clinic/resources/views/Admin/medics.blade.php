@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <h1> Médicos</h1>

        <a href="/admin/medics/create"> Adicionar médico </a>

        <h3> Lista de médicos </h3>
        @if ($medicos->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th> Id </th>
                    <th> Nome </th>
                    <th> Email </th>
                    <th> Telefone </th>
                    <th> Rating </th>
                    <th> ADSE </th>
                    <th> Especialidade </th>
                    <th> Eliminar </th>

                </tr>
            </thead>
            <tbody>

                @foreach($medicos as $medico)
                <tr>
                    <td> {{$medico->id}} </td>
                    <td> {{$medico->user->name}} </td>
                    <td> {{$medico->user->email}}</td>
                    <td>{{$medico->user->cellphone}}</td>
                    <td> {{$medico->rating}} </td>
                    @if($medico->adse == 1)
                    <td> Sim </td>
                    @else
                    <td> Não </td>
                    @endif
                    <td>{{$medico->specialty->specialty}}</td>
                    <td>
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