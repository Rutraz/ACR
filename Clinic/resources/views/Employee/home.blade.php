@extends('layouts.employee')

@section('content')

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="welcomePage">

    <div id="modalComent" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="changedContent">
                <h3> Inserir Pergunta e Resposta </h3>
                Pergunta: <input type="text" name="pergunta" id="pergunta"> <br>
                Resposta: <input type="text" name="resposta" id="resposta">
                <div id="error"></div>
                <button id="sendFAQ">Guardar </button>
                <br>

            </div>
        </div>
    </div>

    <div class="cred">
        <h2>Bem vindo: {{$user->name}}</h2>
        <h2>Email: {{$user->email}}</h2>
        <h2>Telefone: {{$user->cellphone}}</h2>
    </div>

    <h3>Perguntas Frequentes</h3>
    <table>
        <thead>
            <tr>
                <th> Pergunta </th>
                <th> Resposta </th>
                <th class='size'> Eliminar </th>
            </tr>
        </thead>

        <tbody>
            <tr id="inserir">
                <td colspan="2"><button id="inserirBtn">Inserir Pergunta e Resposta</button></td>
            </tr>
        </tbody>
    </table>

    <script>
        $.get("/api/faq", function(data) {
            fillTable(data.data);
    });
        function fillTable(data){
            for(var el in data){
                $('#inserir').before(" <tr id='line"+data[el].id+"'> <td>"+ data[el].question + " </td> <td> "+data[el].response+" </td> <td class='size'> <button class='eliminar' id="+ data[el].id +"> Elimniar </button> </td> </tr>");
            }
            erase();
            
       
        }
        

        $('#inserirBtn').click(function(){
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

            $('#sendFAQ').click(function(){
                var question = $("#pergunta").val();
                var resposta = $("#resposta").val();
                
                
                if(question != "" && resposta != ""){
                    var dataToSend = {
                        "question":question,
                        "response":resposta,
                    };
                    console.log(dataToSend);
                    $.ajax({
                        url: "/api/faq",
                        type: "POST",
                        data : dataToSend, 
                        async: true,
                        success: function(data, statuTxt, xhr) {
                            console.log(data);
                            if(data.success){
                                $('#inserir').before(" <tr id='line"+data.data.id+"'> <td>"+ data.data.question + " </td> <td> "+data.data.response+" </td> <td class='size'> <button class='eliminar' id="+ data.data.id +"> Elimniar </button> </td> </tr>");
                                modal.style.display = "none";
                                $("#pergunta").val("");
                                $("#resposta").val("");
                                erase();
                            }
                            else{
                                $("#error").empty();
                                $("#error").append("<span>" + data.message   + "</span> ");
                            }
                        }});
                    }
                else{
                    $("#error").empty();
                    $("#error").append("<span>Obrigatorio preencher todos os campos caso queria inserir uma pergunta e resposta  </span> ");
                
                }
            })
        });

        function erase(){
            $('.eliminar').click(function(){
            var id = this.id;
            $.ajax({
                url: "/api/faq/erase/"+id,
                type: "POST",
                async: true,
                success: function(data, statuTxt, xhr) {
                    console.log(data);
                    if(data.success){
                        $("#line"+id).remove();
                        alert(data.message);
                    }
                    else{
                        alert(data.message);
                    }
                }});
            });
            
        }
    </script>
</div>
@endsection