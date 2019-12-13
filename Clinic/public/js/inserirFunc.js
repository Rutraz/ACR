function initPage() {
    
    $("#inserirFunc").click(inserir);
}

function inserir(){

    var _token = sendemployee._token.value;
        console.log(_token);

    var name = sendemployee.name.value;
    var email = sendemployee.email.value;
    var cell = sendemployee.cellphone.value;
    var pass = name+ "123";
   
   
    var erro = "";
    
    var dataToSend = {
        "name": name,
        "email" : email,
        "cellphone" : cell,
        "password" : pass,
    };


    $.ajax({
        url: "/api/employee/create",
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
            if($('#trEmpty')) {

                $('#trEmpty').remove();
              }

            $('#tbdoyemployee').append(
                "<tr>" 
                + "<td class='size'>"+ data.data.id +"</td>"
                + "<td>"+ data.data.user.name +"</td>"
                + "<td>"+ data.data.user.email +"</td>"
                + "<td>"+ data.data.user.cellphone +"</td>"
                + "<td class='size' >"+ "<form action='/admin/employee/"+ data.data.id +"' method='POST'>"+ "<input type='hidden' name='_token' value="+ _token +">" + "<button type='submit'>Editar</button>" +"</form>" +"</td>" 
                + "<td class='size' >"+ "<form action='/admin/employee/"+ data.data.id +"' method='POST'>"+ "<input type='hidden' name='_token' value="+ _token +">" + "<button type='submit'>Eliminar</button>" +"</form>" +"</td>" 
                +"</tr>"
            )
          }

        }
    });
}

$(document).ready(initPage);
