@extends('layouts.admin')

@section('content')

<div class="admin">
     
    <div class="admin-table">
  
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
            @if ($clients->isNotEmpty())
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
        @else
       <tr><td>  Não têm clientes registados no website </td></tr> 
        @endif
        </tbody>
        </table>

    </div>

</div>

       

       


@endsection