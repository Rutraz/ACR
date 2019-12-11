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

    var name = sendmedic.name.value;
    var email = sendmedic.email.value;
    var cell = sendmedic.cellphone.value;
    var pass = sendmedic.password.value;
    var adse = sendmedic.adse.value;
    var esp = $("#especialidades option:selected").val();
    console.log(esp);
   
    var erro = "";
    
    var dataToSend = {
        "name": name,
        "email" : email,
        "cellphone" : cell,
        "password" : pass,
        "adse" : adse,
        "specialty" : esp
    };
    console.log(dataToSend);

    $.ajax({
        url: "/api/medic",
        type: "POST",
        data : dataToSend, 
        async: true,
        success: function(data, statuTxt, xhr) {
            console.log(data);
          if(data.success == false){
          for(var x in data.menssage){
              erro += data.menssage[x] + "\n";
          }
              alert( erro);
          }else{
              alert("inserido com sucesso");
          }

        }
    });
}

$(document).ready(initPage);
