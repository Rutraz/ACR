function initPage() {
    $("#inserirFunc").click(inserir);
    editEmployee();
}

function inserir() {
    var _token = sendemployee._token.value;
    console.log(_token);

    var name = sendemployee.name.value;
    var email = sendemployee.email.value;
    var cell = sendemployee.cellphone.value;
    var pass = name + "123";

    var erro = "";

    if (!name || !email || !cell) {
        alert("Todos os campos são obrigatórios!");
        return;
    }

    var dataToSend = {
        name: name,
        email: email,
        cellphone: cell,
        password: pass
    };

    $.ajax({
        url: "/api/employee/create",
        type: "POST",
        data: dataToSend,
        async: true,
        success: function(data, statuTxt, xhr) {
            console.log(data);
            if (data.success == false) {
                for (var x in data.menssage) {
                    erro += data.menssage[x] + "\n";
                }
                alert(erro);
            } else {
                if ($("#trEmpty")) {
                    $("#trEmpty").remove();
                }

                $("#tbdoyemployee").append(
                    "<tr>" +
                        "<td class='size'>" +
                        data.data.id +
                        "</td>" +
                        "<td id='nameTd" +
                        data.data.id +
                        "' >" +
                        data.data.user.name +
                        "</td>" +
                        "<td id='emailTd" +
                        data.data.id +
                        "'>" +
                        data.data.user.email +
                        "</td>" +
                        "<td id='cellTd" +
                        data.data.id +
                        "'>" +
                        data.data.user.cellphone +
                        "</td>" +
                        "<td class='size'>" +
                        "<input type='hidden' id='name" +
                        data.data.id +
                        "' value='" +
                        data.data.user.name +
                        "'>" +
                        "<input type='hidden' id='email" +
                        data.data.id +
                        "' value='" +
                        data.data.user.email +
                        "'>" +
                        "<input type='hidden' id='cellphone" +
                        data.data.id +
                        "' value='" +
                        data.data.user.cellphone +
                        "'>" +
                        "<button id='" +
                        data.data.id +
                        "' class='change edit' type='submit'>Editar</button>" +
                        "</td>" +
                        "<td class='size' >" +
                        "<form action='/admin/employee/" +
                        data.data.id +
                        "' method='POST'>" +
                        "<input type='hidden' name='_token' value=" +
                        _token +
                        ">" +
                        "<button type='submit'>Eliminar</button>" +
                        "</form>" +
                        "</td>" +
                        "</tr>"
                );
                editEmployee();
                sendemployee.name.value = "";
                sendemployee.email.value = "";
                sendemployee.cellphone.value = "";
            }
        }
    });
}

function editEmployee() {
    $(".edit").click(function() {
        $("#error").empty();
        var id = this.id;
        console.log(id);

        var modal = document.getElementById("modalEditar");
        modal.style.display = "block";

        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            modal.style.display = "none";

            $("#name").val("");
            $("#email").val("");
            $("#cellphone").val("");

            $("#sendEditar").remove();
            $(".changedContent").append(
                '<button id="sendEditar">Enviar </button>'
            );
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                $("#name").val("");
                $("#email").val("");
                $("#cellphone").val("");

                $("#sendEditar").remove();
                $(".changedContent").append(
                    '<button id="sendEditar">Enviar </button>'
                );
            }
        };

        var name = $("#name" + id).val();
        var email = $("#email" + id).val();
        var cell = $("#cellphone" + id).val();

        $("#names").val(name);
        $("#emails").val(email);
        $("#cellphones").val(cell);

        // console.log(name, email, cell);

        $("#sendEditar").click(function() {
            var content_name = $("#names").val();
            var content_email = $("#emails").val();
            var content_phone = $("#cellphones").val();
            var _token = $("#token").val();
            console.log(_token);
            var data = {
                id: id,
                name: content_name,
                email: content_email,
                cellphone: content_phone,
                " _token": _token
            };

            //SE O CONTENT NAO FOR VAZIO
            if (
                content_name != "" &&
                content_email != "" &&
                content_phone != ""
            ) {
                $("#sendEditar").remove();
                $(".changedContent").append(
                    '<button id="sendEditar">Enviar </button>'
                );
                $.ajax({
                    url: "/admin/employee/edit",
                    type: "POST",
                    data: data,
                    async: true,
                    success: function(data, statuTxt, xhr) {
                        console.log(data);

                        if (data.success) {
                            $("#nameTd" + id).replaceWith(
                                "<td  id='nameTd" +
                                    data.data.id +
                                    "'>" +
                                    data.data.user.name +
                                    "</td>"
                            );
                            $("#name" + id).val(data.data.user.name);
                            $("#emailTd" + id).replaceWith(
                                "<td  id='emailTd" +
                                    data.data.id +
                                    "'>" +
                                    data.data.user.email +
                                    "</td>"
                            );
                            $("#email" + id).val(data.data.user.email);
                            $("#cellTd" + id).replaceWith(
                                "<td  id='cellTd" +
                                    data.data.id +
                                    "'>" +
                                    data.data.user.cellphone +
                                    "</td>"
                            );
                            $("#cellphone" + id).val(data.data.user.cellphone);
                            console.log(data.data.user.name);
                            modal.style.display = "none";
                            $("#name").val("");
                            $("#email").val("");
                            $("#cellphone").val("");
                        } else {
                            $("#error").empty();
                            for (var x in data.menssage) {
                                $("#error").append(
                                    "<span>" + data.menssage[x][0] + "</span> "
                                );
                                console.log(data.menssage[x][0]);
                            }
                        }
                    }
                });
            } else {
                $("#error").empty();
                $("#error").append(
                    "<span>Tem que preencher todos os campos</span> "
                );
            }
        });
    });
}

$(document).ready(initPage);
