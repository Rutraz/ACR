@extends('layouts.employee')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>
<script src="https://apis.google.com/js/api.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>



<link href='{{asset('fullcalender/packages/core/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/daygrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/timegrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/list/main.css')}}' rel='stylesheet' />

<link href='{{asset('fullcalender/css/style.css')}}' rel='stylesheet' />

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<div class="appointmentPage">

    <div id="top" class="same">
        <br>
        <div class="content">

            <h1 class="title">ANALISES</h1>
            <div class="midleLinks">
                <div class="item">
                    <button class="marcar">Marcar Analise</button> </div>
                <div class="item">
                    <button class="consultar">Consultar Analises</button>
                </div>
            </div>
        </div>
    </div>

    <div id="middle" class="same specialClass">
        <div class="header ">
            <h2>Marcar Analises </h2>
            <fieldset>
                Cc do cliente: <input type="text" name="cc" id="cc" required>
                Email do cliente: <input type="email" name="email" id="email" required>
            </fieldset>
            <div class="float">
                <button class="inicio">Inicio</button>
                <button class="consultar">Consultar Analises</button>
            </div>
        </div>


        <div style="text-align:center">
            <div id='calendar'></div>
            <div style='clear:both'></div>

        </div>

    </div>
    <div id="bottom" class="same">
        <div id="modalComent" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="changedContent">
                    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                    <input type="hidden" id="analysisID">
                    <h2>Modificar estado</h2>
                    <select name="stateChange" id="stateChange">
                        <option value="3">Aceite</option>
                        <option value="4">Concluido</option>
                        <option value="5">Cancelar</option>
                    </select>
                    <br>
                    <br>
                    <div id="error"></div>
                    <button id="send">Enviar </button>

                </div>

            </div>
        </div>

        <div class="header">
            <h1>Consultar Analises </h1>
            <div class="float">
                <button class="inicio">Inicio</button>
                <button class="marcar">Marcar Analise</button>
            </div>
        </div>


        <table class="table">
            <thead>
                <tr>
                    <th class="mediumSize"> Data </th>
                    <th> Cliente </th>
                    <th class="size"> Estado </th>
                    <th class="size">Modificar Estado</th>
                </tr>
            </thead>

            <tbody id="tbody">
                @for ($i = 0; $i < sizeof($analysis); $i++) <tr>
                    <td class="mediumSize">{{$analysis[$i]->date}}</td>
                    <td>{{$analysis[$i]->client->user->name}}</td>
                    <td id="td{{$analysis[$i]->id}}" class="size"
                        style="background-color:{{$analysis[$i]->state->color}}">
                        {{$analysis[$i]->state->state}}</td>
                    @if($analysis[$i]->state->id==4)
                    <td class="size">Não é possivel modificar</td>

                    @else
                    <td id="btn{{$analysis[$i]->id}}" class="size"><button class="openModal"
                            id="{{$analysis[$i]->id}}">Modificar</button></td>
                    @endif
                    </tr>
                    @endfor
            </tbody>
        </table>

    </div>


    <script>
        $(".marcar").click(function() {
            $('html, body').animate({
                scrollTop: $("#middle").offset().top
            }, 1000);
        });

        $(".consultar").click(function() {
            $('html, body').animate({
                scrollTop: $("#bottom").offset().top
            }, 1000);
        });
        $(".inicio").click(function() {
            $('html, body').animate({
                scrollTop: $("#top").offset().top
            }, 1000);
        });
        
        $(".openModal").click(function() {
            $("#analysisID").val("");
            var id = this.id;
            console.log(id);
            var modal = document.getElementById("modalComent");
            modal.style.display = "block";


            $("#analysisID").val(id);
            var span = document.getElementsByClassName("close")[0];
            
            span.onclick = function() {
                modal.style.display = "none";
                $("#send").remove();
                 $(".changedContent").append('<button id="send">Enviar </button>');
                 $("#analysisID").val("");
            };
            
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    $("#send").remove();
                    $(".changedContent").append('<button id="send">Enviar </button>');
                    $("#analysisID").val("");
                }
            };

          $("#send").click(function(){
              var content = $("#stateChange").val();
              var token = $('#token').val();
              var dataToSend = {
                  "id":id,
                 " _token":token,
                  "state_id":content,
              }
              console.log(dataToSend);
              if(content != ""){
                $.ajax({
                      url: "/employee/analysis/change",
                      type: "POST",
                      data : dataToSend, 
                      async: true,
                      success: function(data, statuTxt, xhr) {
                          console.log(data);
                          if(data.success){
                              modal.style.display = "none";
                              if(data.message.state.id == 4){
                                $("#td"+data.message.id).replaceWith("<td id='td"+data.message.id+"' class='size' style='background-color:"+data.message.state.color+"'> "+data.message.state.state+" </td>");
                                $("#btn"+id).replaceWith(" <td class='size'>Não é possivel modificar</td>");
                              }else{

                                  $("#td"+data.message.id).replaceWith("<td id='td"+data.message.id+"' class='size' style='background-color:"+data.message.state.color+"'>"+data.message.state.state+" </td>");
                                }
                          }
                          else{
                              $("#error").empty();
                              $("#error").append("<span>" + data.message   + "</span> ");
                          }
                          $("#send").remove();
                    $(".changedContent").append('<button id="send">Enviar </button>');
                
                      }});
                  }
              else{
                  $("#error").empty();
                  $("#error").append("<span>Tem que selecionar caso queria modificar o estado da analise </span> ");
              
              }
      });
  });
       
function sendData(start) {

    var cc = $("#cc").val();
    var email = $("#email").val();
    $("#cc").css("border-color", "#3490dc");
    $("#email").css("border-color", "#3490dc");
    console.log(cc);
    console.log(email);
    

    if(cc && email){
        
        var obj = {
            "_token": $("#token").val(),
            cc: cc,
            email: email,
            date: start
        };
        console.log(obj);

        $.ajax({
            url: "/employee/analysis/create",
            type: "POST",
            data: obj,
            async: true,
            success: function(data, statuTxt, xhr) {
                console.log(data);

                if (data.success) {
                    var date = new Date(data.message.date);
                    var dateEnd = moment(date)
                        .add(30, "m")
                        .format();
                    console.log(date.toISOString());
                    console.log(dateEnd);

                    var obj = {
                        groupId: "full",
                        id: data.message.id,
                        start: date.toISOString(),
                        end: dateEnd,
                        color: "#248f24", // an option!
                        textColor: "black" // an option!
                    };

                    console.log(calendar);
                    eventData.push(obj);

                    $("#calendar").empty();
                    calendar();
                }
                else{
                    var text = "";
                    if(data.message){

                        if(data.message.cc){
                            text += "Cartao de cidadao invalido \n"
                        }
                        if(data.message.email){
                            text += "Email invalido"
                        }
                    }else{
                        text += data.messageNot
                    }
                    
                    alert(text);
                }
            }
        });
    }
    else{
        $("#cc").css("border-color", "#ff1a1a");
        $("#email").css("border-color", "#ff1a1a");
    }

}

    
    </script>

    <script src='{{asset('fullcalender/packages/core/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/interaction/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/daygrid/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/timegrid/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/list/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/core/locales-all.js')}}'></script>

    <script src='{{asset('fullcalender/js/calendar.js')}}'></script>

</div>
@endsection