@extends('layouts.client')

@section('content')
<div class="container">

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <h1> Cliente</h1>
        <h1>BEM VINDO  {{$user->name}}</h1>
       
       
  
</div>

</div>
@endsection
