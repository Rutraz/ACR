function initPageEmail() {
    // $("#btnEditProfile").click(sendProfile);
    //$("#btnEditEmail").click(sendEmail);
    //$("#btnEditPassword").click(sendPassword);
}
function sendPassword() {
    var not_empty = [];
    var valid = [];

    valores = [];
    elementos = [];

    valores.push(
        editpassword.old_password.value,
        editpassword.new_password.value,
        editpassword.comfirm.value
    );
    elementos.push(
        editpassword.old_password,
        editpassword.new_password,
        editpassword.comfirm
    );

    removeMessages("#editpassword");
    valid.push(
        validString(editpassword.old_password.value, editpassword.old_password)
    );
    valid.push(
        validString(editpassword.new_password.value, editpassword.new_password)
    );
    valid.push(validString(editpassword.comfirm.value, editpassword.comfirm));
    valid.push(
        validateEqual(
            editpassword.new_password.value,
            editpassword.new_password,
            editpassword.comfirm.value,
            editpassword.comfirm
        )
    );
    console.log(valid);

    for (var i = 0; i < valores.length; i++) {
        not_empty.push(validateEmpty(valores[i], elementos[i]));
    }

    if (valid.reduce(and) && not_empty.reduce(and)) {
        postPassword(
            editpassword.old_password.value,
            editpassword.new_password.value,
            editpassword.comfirm.value
        );
    }
}

function postPassword(old, newp, comfirms) {
    var content = {
        _token: $(".token").val(),
        old_password: old,
        new_password: newp,
        comfirm: comfirms
    };

    $.post("/client/profile/edit/password", content, function() {
        window.location = "/client/profile";
    });
}

function sendProfile() {
    var not_empty = [];
    var valid = [];

    valores = [];
    elementos = [];

    valores.push(
        editprofile.name.value,
        editprofile.cellphone.value,
        editprofile.CC.value,
        editprofile.morada.value
    );
    elementos.push(
        editprofile.name,
        editprofile.cellphone,
        editprofile.CC,
        editprofile.morada
    );

    removeMessages("#editprofile");
    valid.push(validString(editprofile.name.value, editprofile.name));
    valid.push(
        validateTelemovel(editprofile.cellphone.value, editprofile.cellphone)
    );
    valid.push(validateCC(editprofile.CC.value, editprofile.CC));
    valid.push(validString(editprofile.morada.value, editprofile.morada));

    for (var i = 0; i < valores.length; i++) {
        not_empty.push(validateEmpty(valores[i], elementos[i]));
    }

    if (valid.reduce(and) && not_empty.reduce(and)) {
        console.log("entrou");
        postProfile(
            editprofile.name.value,
            editprofile.cellphone.value,
            editprofile.idade.value,
            editprofile.CC.value,
            editprofile.adse.value,
            editprofile.morada.value
        );
    }
}

function validateEmpty(content, element) {
    if (content == "") {
        $(element).css("background", "#ffcccc");
        $(element).attr("placeholder", "Campo abrigatório");
        return false;
    } else {
        return true;
    }
}

function validateEqual(content, element, content2, element2) {
    if (content !== content2) {
        $(element).css("background", "#ffcccc");
        $(element).after('<p style="color:red"> Passwords nao iguais </p>');
        $(element2).css("background", "#ffcccc");
        $(element2).after('<p style="color:red"> Passwords nao iguais </p>');
        return false;
    } else {
        return true;
    }
}

function validateEmail(content, element) {
    if (!content.match(/^[a-zA-Z0-9]*@[a-z]*\.(com|pt|org)$/)) {
        $(element).css("background-color", "#ebdf5e");
        $(element).after(
            '<p style="color:#c2b100"> Formatação de email incorrecta </p>'
        );
        return false;
    } else {
        return true;
    }
}

function validateTelemovel(content, element) {
    if (!content.match(/[0-9]{9}/)) {
        $(element).css("background-color", "#ebdf5e");
        $(element).after(
            '<p style="color:#c2b100"> Formatação de telemovel incorrecta </p>'
        );
        return false;
    } else {
        return true;
    }
}

function validateCC(content, element) {
    if (!content.match(/[0-9]{1,9}/)) {
        $(element).css("background-color", "#ebdf5e");
        $(element).after(
            '<p style="color:#c2b100"> Formatação de cartão de cidadão incorrecta </p>'
        );
        return false;
    } else {
        return true;
    }
}

function validString(content, element) {
    if (!content.match(/^[a-zA-Z0-9]+/)) {
        $(element).css("background-color", "#ebdf5e");
        $(element).after(
            '<p style="color:red;margin:0px"> Formatação de campo incorrecta </p>'
        );
        return false;
    } else {
        return true;
    }
}

function and(a, b) {
    return a && b;
}

function removeMessages(string) {
    $(string)
        .children()
        .css("background-color", "#FFFFFF");
    $(string)
        .children()
        .filter("p")
        .remove();
}

function postProfile(name, cellphone, idade, CC, adse, morada) {
    var content = {
        _token: $(".token").val(),
        name: name,
        cellphone: cellphone,
        idade: idade,
        CC: CC,
        adse: adse,
        morada: morada
    };

    $.post("/client/profile/edit", content, function() {
        window.location = "/client/profile";
    });
}

$(document).ready(initPageEmail);
