@extends('layouts.employee')

@section('content')
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

    <div id="middle" class="same">
        <div class="header">
            <h1>Marcar Analises </h1>
            <div class="float">
                <button class="inicio">Inicio</button>
                <button class="consultar">Consultar Analises</button>
            </div>
        </div>
    </div>
    <div id="bottom" class="same">
        <div id="modalComent" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="changedContent">
                    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">

                    <select name="stateChange" id="stateChange">
                        <option value="3">Aceite</option>
                        <option value="4">Concluido</option>
                        <option value="5">Cancelar</option>
                    </select>
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


        <table>
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
       
            var id = this.id;
            console.log(id);
            var modal = document.getElementById("modalComent");
            modal.style.display = "block";
                    
            var span = document.getElementsByClassName("close")[0];
            
            span.onclick = function() {
                modal.style.display = "none";
                $("#send").remove();
                 $(".changedContent").append('<button id="send">Enviar </button>');
            };
            
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    $("#send").remove();
                    $(".changedContent").append('<button id="send">Enviar </button>');
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
       
    
    </script>
</div>
@endsection