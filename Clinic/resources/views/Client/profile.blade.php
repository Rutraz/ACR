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

        <section style="background-image:url('{{ asset('assets/Gest/test.jpg') }}')">
            <div class="client-appointmments" >
                <div class="appointmments-name">
                    <h1>Consultas</h1>
                    <p>Consulte as suas Consultas.</p>
                    <hr>
                </div>
                <br>
                <div  class="appointmments-table">
                    <table id="myID"  class="table-container">
                        <thead>
                            <tr>
                                <th> Data </th>
                                <th> Especialização </th>
                                <th> Médico </th>
                                <th> Observação </th>
                                <th> Rating </th>
                                <th> State </th>
                            </tr>
                        </thead>
                        <tbody>


                            @if ($appointments->isNotEmpty())
                            @foreach($appointments as $appointment)
                            <tr>
                                <td>{{$appointment->date}}</td>
                                <td>{{$appointment->medic->specialty->specialty}}</td>
                                <td>{{$appointment->medic->user->name}}</td>
                                <td>{{$appointment->comments}}</td>
                                <td>{{$appointment->medic->rating}}</td>
                                @if ($appointment->state == 1)
                                <td>Aceite</td>
                                @elseif  ($appointment->state == 3)
                                <td>Negativo</td>
                                @elseif  ($appointment->state == 2)
                                <td>Morreu</td>
                                @else    ($appointment->state == 4)
                                @endif
                            </tr>

                            @endforeach
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            @else
                            <h1> Nao tem consultas marcadas ou realizadas </h1>
                            @endif


                        </tbody>
                    </table>
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
            </div>

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

    <script>
        $('#fullpage').fullpage();
    </script>


</div>
@endsection