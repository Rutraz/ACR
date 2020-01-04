@extends('layouts.employee')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>
<script src="https://apis.google.com/js/api.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>



<link href='{{asset('fullcalender/packages/core/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/daygrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/timegrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/list/main.css')}}' rel='stylesheet' />
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="singleMedicPage">

    <div class="header">
        <input type="hidden" name="medicID" id="medicID" value="{{$getMedic->user->id}}">
        <input type="hidden" name="calendarid" id="calendarid" value="{{$getMedic->calendarid}}">
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
            <button id="goBottom">Historial</button> <br>
            <button id="goTop">Horário</button>
        </div>
    </div>

    <div class="heighClassMaster">

        <div id="modalEvent" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="changedContent">
                    <h1> Modificar estado da consulta </h1>
                    <div id="NameOfUser"></div>
                    <select name="stateChange" id="stateChange">
                        <option value="3">Aceite</option>
                        <option value="4">Concluido</option>
                        <option value="5">Cancelar</option>
                    </select>
                    <br> <br>
                    <div id="error"></div>
                    <button id="sendEvent">Enviar </button>
                    <br>
                </div>
            </div>
        </div>

        <!-- FALTA ACABAR O CALENDÀRIO PARA MUDAR O HORARIO -->
        <div id="init" style="width:90%; text-align:center; margin-left:auto; margin-right:auto;">
            <div id='calendar' class="sizeUpTr"></div>

            <div style='clear:both'></div>

        </div>
        <div id="end" class="comments heighClass">

            <div id="modalComent" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="changedContent">
                        <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                        <h1> Eliminar commentario </h1>

                        <div id="error"></div>
                        <button id="sendComment">Eliminar </button>
                        <br>

                    </div>
                </div>
            </div>

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

                        @if( ($item->comments === "Comentário eliminado"))
                        <td>{{$item->comments}}</td>
                        @elseif ($item->comments != "")
                        <td id="{{$item->id}}TD" class="clickable">{{$item->comments}}</td>
                        @else
                        <td>Não existe comentários sobre esta consulta</td>
                        @endif
                    </tr>
                    @endif
                    @endforeach
                    @endif

                    <tr>
                        <td> Histórico de apenas consultas finalizadas </td>
                    </tr>
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

        $('.clickable').click(function(){
          

            var id =  parseInt(this.id);
            console.log(id);

            var modal = document.getElementById("modalComent");
            modal.style.display = "block";
                    
            var span = document.getElementsByClassName("close")[0];
            
            span.onclick = function() {
                modal.style.display = "none";
            };
            
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };

            $("#sendComment").click(function(){
                var txt = false;
                if (confirm("Confirme")) {
                    txt = true;
                } else {
                    txt = false;
                }

                var _token = $("#token").val();
                var dataToSend = {
                    "id":id,
                   " _token":_token,     
                }
                console.log(dataToSend);
                if(txt){

               
                  $.ajax({
                        url: "/employee/medic/comment",
                        type: "POST",
                        data : dataToSend, 
                        async: true,
                        success: function(data, statuTxt, xhr) {
                            console.log(data);
                            if(data.success){
                                $("#"+id+"TD").replaceWith("<td>"+data.message+"</td>");;
                                modal.style.display = "none";
                               
                            }
                            else{
                                $("#error").empty();
                                $("#error").append("<span>" + data.message   + "</span> ");
                            }
                        }});
                    }
                    else{
                        id=null;
                        modal.style.display = "none";
                    }
            });
        });

       function openEventModal(name,id){
           var id = id;
            var modal = document.getElementById("modalEvent");
            var calendar = document.getElementById("calendar");
            $("#NameOfUser").empty();
            $("#NameOfUser").append("<h2>"+name+" </h2>");
            calendar.style.display = "none";
            modal.style.display = "block";
                    
            var span = document.getElementsByClassName("close")[0];
            
            span.onclick = function() {
                modal.style.display = "none";
                calendar.style.display = "block";
                $("#sendEvent").remove();
                $(".changedContent").append('<button id="sendEvent">Enviar </button>');
            };
            
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    calendar.style.display = "block";
                    $("#sendEvent").remove();
                    $(".changedContent").append('<button id="sendEvent">Enviar </button>');
                }
            };

            $("#sendEvent").click(function() {
                var content = $("#stateChange").val();
                var token = $("#token").val();
                var dataToSend = {
                    id: id,
                    " _token": token,
                    state_id: content
                };
                console.log(dataToSend);
                
                $.ajax({
                    url: "/employee/appointment/change",
                    type: "POST",
                    data: dataToSend,
                    async: true,
                    success: function(data, statuTxt, xhr) {
                        console.log(data);
                        if (data.success) {
                            modal.style.display = "none";
                            calendar.style.display = "block";
                            $("#calendar").empty();
                            initPage()         ;    
                        } else {
                            $("#error").empty();
                            $("#error").append(
                                "<span>" + data.message + "</span> "
                            );
                        }
                        $("#sendEvent").remove();
                        $(".changedContent").append(
                            '<button id="sendEvent">Enviar </button>'
                        );
                    }
                });
               
            });
        }

    </script>

    <script src='{{asset('fullcalender/packages/core/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/interaction/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/daygrid/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/timegrid/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/list/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/core/locales-all.js')}}'></script>

    <script src='{{asset('fullcalender/js/medicCalendar.js')}}'></script>
</div>
@endsection