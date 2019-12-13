@extends('layouts.client')

@section('content')
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="{{ asset('js/jquery.fullpage.js')}}"></script>

<div class="profile">
    <div id="fullpage">
        <section>
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

                    <form action="/client/profile/edit">
                        <button type="submit">Editar Informação</button>
                    </form>
                </div>
            </div>
        </section>

        <section>
            <div class="client-appointmments">
                <div class="appointmments-name">
                    <h1>Consultas</h1>
                    <p>Consulte as suas Consultas.</p>
                    <hr>
                </div>
                <br>
                <div class="appointmments-table">
                    <table id="myID" class="table-container">
                        <thead>
                            <tr>
                                <th> Data </th>
                                <th> Especialização </th>
                                <th> Médico </th>
                                <th> Comentário </th>
                                <th> Rating </th>
                                <th> Estado </th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($appointments->isNotEmpty())
                            @foreach($appointments as $appointment)
                            <tr>
                                <td>{{$appointment->date}}</td>
                                <td>{{$appointment->medic->specialty->specialty}}</td>
                                <td>{{$appointment->medic->user->name}}</td>
                                @if($appointment->comments == "" && $appointment->rating == 0 &&
                                $appointment->state->state == 4)
                                <td> <button id="comment">Comentar consulta</button> </td>
                                <td> <button id="rate">Avaliação</button> </td>
                                @else
                                <td>{{$appointment->comments}}</td>
                                <td>{{$appointment->rating}}</td>
                                @endif
                                <td style="background-color:{{$appointment->state->color}}">
                                    {{$appointment->state->state}}</td>

                            </tr>
                            <tr>
                                <td>teste</td>
                                <td>teste</td> 
                                <td>teste</td> 
                                <td>teste</td> 
                                <td>teste</td> 
                                <td>teste</td>  

                            </tr>
                            <tr>
                                <td>teste</td>
                                <td>teste</td> 
                                <td>teste</td> 
                                <td>teste</td> 
                                <td>teste</td> 
                                <td>teste</td>  

                            </tr>
                            <tr>
                                <td>teste</td>
                                <td>teste</td> 
                                <td>teste</td> 
                                <td>teste</td> 
                                <td>teste</td> 
                                <td>teste</td>  

                            </tr>
                            <tr>
                                <td>teste</td>
                                <td>teste</td> 
                                <td>teste</td> 
                                <td>teste</td> 
                                <td>teste</td> 
                                <td>teste</td>  

                            </tr>
                            
                       
                          
                          
                            @endforeach

                            @else
                            <h1> Nao tem consultas marcadas ou realizadas </h1>
                            @endif


                        </tbody>
                    </table>
                </div>
            </div>

            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>Some text in the Modal..</p>
                </div>

            </div>
        </section>
        <section>
            <div class="client-analysis">
                <div class="anaylsis-name">
                    <h1>Analises</h1>
                    <p>Consulte as suas Analises</p>
                    <hr>
                </div>
                <br>
                <div class="anaylsis-table">
                    @if ($analysis->isNotEmpty())
                    <table class="table-container">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($analysis as $analyse)
                            <tr>
                                <td>{{$analyse->date}}</td>
                                <td style="background-color:{{$analyse->state->color}}">{{$analyse->state->state}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @else
                    <h1> Nao tem analises marcadas ou realizadas </h1>
                    @endif
                </div>
            </div>
        </section>
    </div>

    <script>
        $('#fullpage').fullpage();
    </script>


</div>
@endsection