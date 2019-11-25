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
                <div  class="appointmments-table">
                    
                        <div id="scrolltable">
                            <table>
                               
                                <tr >
                                
                                <div> <th> Data </th> </div>
                                <div> <th> Especialização </th> </div>
                                <div> <th> Médico </th> </div>
                                <div> <th> Observação </th> </div>
                                <div> <th> Estado</th> </div>
                
                                </tr>
                                    @if ($appointments->isNotEmpty())
                                        @foreach($appointments as $appointment) 
                                            <tr>
                                                <td>{{$appointment->date}}</td>
                                                <td>{{$appointment->medic->specialty}}</td>
                                                <td>{{$appointment->medic->user->name}}</td>
                                                <td>{{$appointment->comments}}</td>
                                                <td>{{$appointment->state}}</td>                        
                                            </tr>
                                                                    
                                        @endforeach
                                    @else
                                        <h1> Nao tem consultas marcadas ou realizadas </h1>
                                    @endif
                                    <tr><td>test</td><td>test</td><td>test</td><td>test</td><td>test</td></tr>  
                                    <tr><td>test</td><td>test</td><td>test</td><td>test</td><td>test</td></tr>  
                                    <tr><td>test</td><td>test</td><td>test</td><td>test</td><td>test</td></tr>  
                                    <tr><td>test</td><td>test</td><td>test</td><td>test</td><td>test</td></tr> 
                                    <tr><td>test</td><td>test</td><td>test</td><td>test</td><td>test</td></tr>  
                                    <tr><td>test</td><td>test</td><td>test</td><td>test</td><td>test</td></tr>  
                                     <tr><td>test</td><td>test</td><td>test</td><td>test</td><td>test</td></tr> 
                                     <tr><td>test</td><td>test</td><td>test</td><td>test</td><td>test</td></tr>  
                                     <tr><td>test</td><td>test</td><td>test</td><td>test</td><td>test</td></tr>  
                                     <tr><td>test</td><td>test</td><td>test</td><td>test</td><td>test</td></tr>  
                                     <tr><td>test</td><td>test</td><td>test</td><td>test</td><td>test</td></tr>   
                            </table>
                        </div>
                     
                </div>
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