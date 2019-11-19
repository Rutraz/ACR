@extends('layouts.employee')

@section('content')
<div class="container">
 
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h1> Funcionario</h1>

        <h2>{{$user->name}}</h2>
        <h2>{{$user->email}}</h2>
        <h2>{{$user->cellphone}}</h2>

    </div>

</div>
@endsection
