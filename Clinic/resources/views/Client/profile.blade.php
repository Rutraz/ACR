@extends('layouts.client')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="{{ asset('js/jquery.fullpage.js')}}"></script>

<div class="profile">

    <div id="modalComent" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="changedContent">
                <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                <h1> Comentar consulta </h1>
                <textarea id="commentary" rows='8' style='width:80%; margin-top:0.5em'></textarea>
                <div id="error"></div>
                <button id="sendComment">Enviar </button>
                <br>

            </div>
        </div>
    </div>

    <div id="modalRating" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="changedContent">
                <h1> Rating </h1>
                <input type="number" id="rating" min="1" max="5">
                <div id="error2"></div>
                <button id="sendRating">Enviar </button>
                <br>

            </div>
        </div>
    </div>

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

        <section id="test">


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
                                @if($appointment->comments == "" && $appointment->state->id == 4)
                                <td> <button class="change comment" id="{{$appointment->id}}">Comentar consulta</button>
                                </td>
                                @else
                                <td>{{$appointment->comments}}</td>
                                @endif
                                @if($appointment->rating == 0 && $appointment->state->id == 4 )
                                <td> <button class="change rate" id="{{$appointment->id}}">Avaliação</button> </td>
                                @else
                                <td>{{$appointment->rating}}</td>
                                @endif
                                <td style="background-color:{{$appointment->state->color}}">
                                    {{$appointment->state->state}}</td>
                                @endforeach
                                @else
                            <tr>
                                <td> tem consultas marcadas ou realizadas </td>
                            </tr>
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
                <br>
                <div class="anaylsis-table">
                    <table class="table-container">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($analysis->isNotEmpty())
                            @foreach($analysis as $analyse)
                            <tr>
                                <td>{{$analyse->date}}</td>
                                <td style="background-color:{{$analyse->state->color}}">{{$analyse->state->state}}</td>
                            </tr>
                            @endforeach

                            @else
                            <tr>
                                <td> Nao tem analises marcadas ou realizadas</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script>
        $('#fullpage').fullpage();
 
        $(".comment").click(function() {
       
         var id = this.id;
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
                var content = $("#commentary").val();
                var _token = $("#token").val();
                var dataToSend = {
                    "id":id,
                   " _token":_token,
                    "comment":content,
                }
                console.log(dataToSend);
                if(content != ""){
                  $.ajax({
                        url: "/client/appointment/comment",
                        type: "POST",
                        data : dataToSend, 
                        async: true,
                        success: function(data, statuTxt, xhr) {
                            console.log(data);
                            if(data.success){
                                $(".comment#"+id+"").replaceWith(data.message);;
                                modal.style.display = "none";
                                $("#commentary").val("") ;
                            }
                            else{
                                $("#error").empty();
                                $("#error").append("<span>" + data.message   + "</span> ");
                            }
                        }});
                    }
                else{
                    $("#error").empty();
                    $("#error").append("<span>Tem que preencher caso queria deixar um comentário </span> ");
                
                }
        });
    });

    $(".rate").click(function() {
       
       var id = this.id;
       console.log(id);
          var modal = document.getElementById("modalRating");
          modal.style.display = "block";
                  
          var span = document.getElementsByClassName("close")[1];
          
          span.onclick = function() {
              modal.style.display = "none";
          };
          
          window.onclick = function(event) {
              if (event.target == modal) {
                  modal.style.display = "none";
              }
          };

          $("#sendRating").click(function(){
              var content = $("#rating").val();
              var _token = $("#token").val();
              var dataToSend = {
                  "id":id,
                 " _token":_token,
                  "rating":content,
              }
              console.log(dataToSend);
              if(content != ""){
                $.ajax({
                      url: "/client/appointment/rate",
                      type: "POST",
                      data : dataToSend, 
                      async: true,
                      success: function(data, statuTxt, xhr) {
                          console.log(data);
                          if(data.success){
                              $(".rate#"+id+"").replaceWith(data.message);
                              modal.style.display = "none";
                              $("#rating").val("");
                          }
                          else{
                              $("#error2").empty();
                              $("#error2").append("<span>" + data.message   + "</span> ");
                          }
                      }});
                  }
              else{
                  $("#error2").empty();
                  $("#error2").append("<span>Tem que preencher caso queria dar uma avaliação </span> ");
              
              }
        });
    });


    </script>
</div>
@endsection