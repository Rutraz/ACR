@extends('layouts.client')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

<script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>
<script src="https://apis.google.com/js/api.js"></script>



<link href='{{asset('fullcalender/packages/core/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/daygrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/timegrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/list/main.css')}}' rel='stylesheet' />

<link href='{{asset('fullcalender/css/style.css')}}' rel='stylesheet' />

<div class="clientMedic">
    <input type="hidden" id="medicID" value="{{$getMedic->user->id}}">
    <input type="hidden" name="calendarid" id="calendarid" value="{{$getMedic->calendarid}}">
    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">

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
            <div style="text-align:center">
                <div id='calendar' class="sizeUpTr"></div>

                <div style='clear:both'></div>

            </div>
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

        function sendData(start) {
            
                var obj = {
                    _token: $("#token").val(),
                    id: $("#medicID").val(),
                    date: start,
                };
                console.log(obj);

                $.ajax({
                    url: "/client/appointment/medic/" + obj.id,
                    type: "POST",
                    data: obj,
                    async: true,
                    success: function(data, statuTxt, xhr) {
                        console.log(data);

                        if (data.success) {
                            var date = new Date(data.message.date);
                            var dateEnd = moment(date)
                            .add(1, "hours")
                                .format();
                            console.log(date.toISOString());
                            console.log(dateEnd);

                            var obj = {
                                groupId: "full",
                                id: data.message.id,
                                start: date.toISOString(),
                                end: dateEnd,
                                color: data.message.state.color, // an option!
                                textColor: "black" // an option!
                            };
                            
                            eventData.push(obj);

                            $("#calendar").empty();
                            calendar();
                            alert("Marcou a consulta com sucesso");
                        }
                    }
                });
            
            
        }
    </script>

    <script src='{{asset('fullcalender/packages/core/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/interaction/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/daygrid/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/timegrid/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/list/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/core/locales-all.js')}}'></script>



    <script src='{{asset('fullcalender/js/appointCalendar.js')}}'></script>
</div>
@endsection