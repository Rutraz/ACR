@extends('layouts.client')

@section('content')
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<div class="clientMedic">


    <div class="header">

        <!-- Coluna -->
        <img id="img_medic_profile" src="\assets\stethoscope.svg" alt=""> <!-- LINHA -->
        <!-- Coluna -->
        <div class="item">
            <h3> <span> Medico:</span> {{$getMedic->user->name}} </h3> <!-- LINHA -->

            <h3> <span> Especialidade:</span> {{$getMedic->specialty->specialty}} </h3> <!-- LINHA -->
        </div>
        <!-- Coluna -->
        <div class="item">
            <h3> <span> Rating:</span> {{$getMedic->rating}} </h3> <!-- LINHA -->

            <h3> <span> Adse:</span>
                @if($getMedic->adse == 1)
                Sim
                @else
                Não
                @endif
            </h3> <!-- LINHA -->
        </div>

        <div class="item item1">
            <button id="goBottom">Ver historial</button> <br>
            <button id="goTop">Marcar Consulta</button>
        </div>
    </div>

    <div class="heighClassMaster">

        <div id="init" class="heighClass">
            <br>
            <span>CALENDARIOs</span>
        </div>

        <div id="end" class="comments heighClass">

            <h2>Historial de consultas</h2>
            <table>
                <thead>
                    <tr>
                        <th> Data </th>
                        <th> Rating </th>
                        <th> Comentários </th>
                    </tr>
                </thead>

                <tbody id="tbody">
                    @if ($appointments->isNotEmpty())
                    @foreach ($appointments as $item)
                    @if($item->state->id ==4)
                    <tr>
                        <td>{{$item->date}}</td>
                        @if ($item->rating != 0)

                        <td>{{$item->rating}}</td>
                        @else
                        <td>Não existe avaliação sobre esta consulta</td>
                        @endif
                        @if ($item->comments != "")
                        <td>{{$item->comments}}</td>
                        @else
                        <td>Não existe comentários sobre esta consulta</td>
                        @endif
                    </tr>
                    @endif
                    @endforeach
                    @else
                    <tr>
                        <td colspan="3"> Não tem historial disponivel sobre consultas </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var bool = true;
        $("#goBottom").click(function() {
            if(bool){

                $('html, body .heighClassMaster').animate({
                    scrollTop: $("#end").offset().top
                }, 1000);
                bool = false;
            }
        });

        $("#goTop").click(function() {
            if(!bool){

                $('html, body .heighClassMaster').animate({
                    scrollTop: $("#init").offset().top
                }, 1000);

                bool = true;
            }
        });
    </script>

</div>
@endsection