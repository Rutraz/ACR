function initPage() {
    $.get("/api/medic/esp", function(data){
        console.log(data.data);
        data.data.forEach(element => {
            console.log(element.id);
            $("#especialidades").append(
                "<option value=" + element.id + " > "+element.specialty+" </option>"
            );
        });
        
     })
    $("#inserirMedico").click(inserir);
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

$(document).ready(initPage);
