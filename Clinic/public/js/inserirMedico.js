function initPage() {
    var obj= {};
    //vai buscar a speciality dos medicos
    $.get("/api/medic/esp", function(data){
        console.log(data.data);
        data.data.forEach(element => {
            console.log(element.id);
            $("#especialidades").append(
                "<option value=" + element.id + " > "+element.specialty+" </option>"
            );
            $("#especialidadesModal").append(
                "<option value=" + element.id + " > "+element.specialty+" </option>"
            );
        });
        
     })

     //Insere um Médico
    $("#inserirMedico").click(inserir);

    EditarMedico();
}

function inserir(){

    var _token = sendmedic._token.value;
        console.log(_token);

    var name = sendmedic.name.value;
    var email = sendmedic.email.value;
    var cell = sendmedic.cellphone.value;
    var pass = name + '123';
    var adse = sendmedic.adse.value;
    var esp = $("#especialidades option:selected").val();
    
    var erro = "";
    
    var dataToSend = {
        "name": name,
        "email" : email,
        "cellphone" : cell,
        "password" : pass,
        "adse" : adse,
        "specialty" : esp
    };


    $.ajax({
        url: "/api/medic",
        type: "POST",
        data : dataToSend, 
        async: true,
        success: function(data, statuTxt, xhr) {
        
          if(data.success == false){
          for(var x in data.menssage){
              erro += data.menssage[x] + "\n";
          }
              alert( erro);
          }else{
              if($('#trEmpty')) {

                $('#trEmpty').remove();
              }

                $('#tbdoymedic').append(
                    "<tr>" 
                    + "<td class='size'>"+ data.data.id +"</td>"
                    + "<td>"+ data.data.user.name +"</td>"
                    + "<td>"+ data.data.user.email +"</td>"
                    + "<td>"+ data.data.user.cellphone +"</td>"
                    + "<td class='size'>"+ data.data.rating+"</td>"
                    + "<td class='size'>"+ data.data.adse +"</td>"
                    + "<td>"+ data.data.specialty.specialty +"</td>" 
                    + "<td class='size' >"+ "<form action='/admin/medics/"+ data.data.id +"' method='POST'>"+ "<input type='hidden' name='_token' value="+ _token +">" + "<button type='submit'>Editar</button>" +"</form>" +"</td>" 
                    + "<td class='size' >"+ "<form action='/admin/medics/"+ data.data.id +"' method='POST'>"+ "<input type='hidden' name='_token' value="+ _token +">" + "<button type='submit'>Eliminar</button>" +"</form>" +"</td>" 
                    +"</tr>"
                )
              
            
          }

        }
    });
}

function EditarMedico(){

    $(".edit").click(function(){
        $("#error").empty();
        var id = this.id;
        console.log(id);


        var modal = document.getElementById("modalEditar");
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

       

        var name = $("#name"+id).val();
        var email = $("#email"+id).val();
        var cell = $("#cellphone"+id).val();
        var adse = $("#adse"+id).val();
        var esp = $("#esp"+id).val();
        

        $("#names").val(name);
        $("#emails").val(email);
        $("#cellphones").val(cell);
        $("#adses").val(adse);
        $('#especialidadesModal option[value=2]').attr('selected','selected');
        
      
        

        console.log(name, email, cell, adse , esp);
    });

    

}

$(document).ready(initPage);
