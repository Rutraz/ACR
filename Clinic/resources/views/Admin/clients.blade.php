@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <h1> Clientes</h1>

        <h3> Lista de clientes </h3>

        @if ($clients->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th> Id </th>
                    <th> Nome </th>
                    <th> Email </th>
                    <th> Telemovel </th>
                    <th> CC </th>
                    <th> Idade </th>
                    <th> Eliminar </th>
                </tr>
            </thead>
            <tbody>

                @foreach($clients as $client)
                <tr>
                    <td> {{$client->id}} </td>
                    <td> {{$client->user->name}} </td>
                    <td> {{$client->user->email}}</td>
                    <td>{{$client->user->cellphone}}</td>
                    <td>{{$client->CC}}</td>
                    <td>{{$client->idade}}</td>
                    <td>
                        <form action="/admin/client/{{$client->id}}" method="POST">
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