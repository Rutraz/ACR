@extends('layouts.client')

@section('content')
<div class="profile">
    <section class="intro">
        <div class="client-info">
            <div class="profile-name">
                <h1>{{$user->name}}</h1>
                <p>Actualize as informações do seu perfil e as definições.</p>
                <hr>
            </div>
            <div class="profile-info">   
                <h2>Seu e-mail</h2>
                <h3>{{$user->email}}</h3>
                <hr>
                <h2>Seu Cartão de cidadão</h2>
                <h3>{{$client->CC}}</h3>
                <hr>
                <h2>Seu numero de ADSE</h2>          
                <h3>{{$client->adse}}</h3>
                <hr>
                <h2>Sua morada</h2>
                <h3>{{$client->morada}}</h3>
                <hr>
                <h2>Sua data de Nascimento</h2>
                <h3>{{$client->idade}}</h3>  
                <hr>

                <form  action="/client/profile/edit">            
                    <button  type="submit" >Editar Informação</button>
                </form>
            </div>
        </div>
    </section>

    <section>
        <div class="client-appointmments">
            <div class="appointmments-name"> 
                <h1>Consultas</h1>
                <p>Actualize as informações do seu perfil e as definições.</p>
                <hr>
            </div>
            <br>
            @if ($appointments->isNotEmpty())
        @foreach($appointments as $appointment) 
            <h1>{{$appointment->date}}</h1>
                <ul>
            <li>{{$appointment->state}}</li> 
            <li>{{$appointment->comments}}</li> 
            <li>{{$appointment->medic->user->name}}</li>                   
                </ul>
        @endforeach
    @else
        <h1> Nao tem consultas marcadas ou realizadas </h1>
    @endif
    



        </div>
                
    </section>
    <section>
    <h1>Analises</h1>
    @if ($analysis->isNotEmpty())
        @foreach($analysis as $analyse) 
                <h1>{{$analyse->date}}</h1> 
                <h2>{{$analyse->state}}</h2> 
            @endforeach
    @else
        <h1> Nao tem analises marcadas ou realizadas </h1>
    @endif
    </section>
</div>
@endsection