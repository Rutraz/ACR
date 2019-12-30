@extends('layouts.employee')

@section('content')
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="singleMedicPage">

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
            <button id="goBottom">Ver historial</button> <br><br>
            <button id="goTop">Marcar Consulta</button>
        </div>
    </div>

    <div class="heighClassMaster">

        <div id="init" class="heighClass">

            <span>CALENDARIO PARA MODIFICAR</span>
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
    </script>
</div>
@endsection