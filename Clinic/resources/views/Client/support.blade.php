@extends('layouts.client')

@section('content')
<div>
    
    <h1> Support page</h1>

    @if ($allemplos->isNotEmpty())
            @foreach($allemplos as $allemplo) 
                <h1>{{$allemplo->id}} {{$allemplo->user->name}}</h1>
                    <ul>
                <li><a href="mailto:{{$allemplo->user->email}}">{{$allemplo->user->email}}</a></li> 
                <li>{{$allemplo->user->cellphone}}</li>                   
                    </ul>
            @endforeach
    @else
        <h1> Tem tem funcionários registados no website </h1>
    @endif

    <h1></h1>

</div>
@endsection
