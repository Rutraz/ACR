@extends('layouts.employee')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>

                    <h1> Funcionario</h1>

                    <h2>{{$user->name}}</h2>
                    <h2>{{$user->email}}</h2>
                    <h2>{{$user->cellphone}}</h2>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
