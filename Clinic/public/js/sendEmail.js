
function sendEmail() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var message1 = document.getElementById("message").value;
    
    Email.send({
        SecureToken : "cf2178dd-b41b-4198-ac5f-f9acb5cd2fbb",
        To : 'acrclinicemail@gmail.com',
        From : email,
        Subject : "Enviado por " + name,
        Body : message1
    }).then(
      message => alert(message)
    );

    document.getElementById("myForm").reset();
}

