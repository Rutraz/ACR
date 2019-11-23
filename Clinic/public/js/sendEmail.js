function initPageEmail() {
    $("#addEventBtn").click(sendEmail);
}

function sendEmail() {
    var not_empty = [];

    var name = myForm.name.value;
    var name1 = myForm.name;

    var email = myForm.email.value;
    var email1 = myForm.email;

    var message1 = myForm.message.value;
    var message2 = myForm.message;

    array = [];
    array2 = [];

    array.push(name, email, message1);
    array2.push(name1, email1, message2);

    removeMessages();

    for (var i = 0; i < array.length; i++) {
        not_empty.push(validateEmpty(array[i], array2[i]));
    }

    if (not_empty.reduce(and)) {
        Email.send({
            SecureToken: "cf2178dd-b41b-4198-ac5f-f9acb5cd2fbb",
            To: "acrclinicemail@gmail.com",
            From: "rutra_avs@hotmail.com",
            Subject: "Enviado por " + name,
            Body: " " + email + "\n" + message1
        }).then(message => alert(message));

        document.getElementById("myForm").reset();
    }
}

function validateEmpty(content, element) {
    if (content == "") {
        $(element).css("background", "#ffcccc");
        $(element).attr("placeholder", "Por favor insira um valor");
        return false;
    } else {
        return true;
    }
}

function and(a, b) {
    return a && b;
}

function removeMessages() {
    $("#myForm")
        .children()
        .css("background-color", "#FFFFFF");
    $("#myForm")
        .children()
        .filter("p")
        .remove();
}

$(document).ready(initPageEmail);
