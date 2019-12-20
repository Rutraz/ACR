function initPage() {
    var obj = [];
    //vai buscar a speciality dos medicos
    $.get("/api/medic/esp", function(data) {
        console.log(data.data);
        data.data.forEach(element => {
            $("#especialidades").append(
                "<option value=" +
                    element.id +
                    " > " +
                    element.specialty +
                    " </option>"
            );
            $("#especialidadesModal").append(
                "<option value=" +
                    element.id +
                    " > " +
                    element.specialty +
                    " </option>"
            );
            obj.push({ value: element.id, name: element.specialty });
        });
        EditarMedico(obj);
    });

    //Insere um Médico
    $("#inserirMedico").click(inserir);
}

function inserir() {
    var _token = sendmedic._token.value;
    console.log(_token);

    var name = sendmedic.name.value;
    var email = sendmedic.email.value;
    var cell = sendmedic.cellphone.value;
    var pass = name + "123";
    var adse = sendmedic.adses.value;
    var esp = $("#especialidades option:selected").val();

    var erro = "";

    var dataToSend = {
        name: name,
        email: email,
        cellphone: cell,
        password: pass,
        adse: adse,
        specialty: esp
    };

    $.ajax({
        url: "/api/medic",
        type: "POST",
        data: dataToSend,
        async: true,
        success: function(data, statuTxt, xhr) {
            if (data.success == false) {
                for (var x in data.menssage) {
                    erro += data.menssage[x] + "\n";
                }
                alert(erro);
            } else {
                if ($("#trEmpty")) {
                    $("#trEmpty").remove();
                }

                $("#tbdoymedic").append(
                    "<tr>" +
                        "<td class='size'>" +
                        data.data.id +
                        "</td>" +
                        "<td>" +
                        data.data.user.name +
                        "</td>" +
                        "<td>" +
                        data.data.user.email +
                        "</td>" +
                        "<td>" +
                        data.data.user.cellphone +
                        "</td>" +
                        "<td class='size'>" +
                        data.data.rating +
                        "</td>" +
                        "<td class='size'>" +
                        data.data.adse +
                        "</td>" +
                        "<td>" +
                        data.data.specialty.specialty +
                        "</td>" +
                        "<td class='size' >" +
                        "<form action='/admin/medics/" +
                        data.data.id +
                        "' method='POST'>" +
                        "<input type='hidden' name='_token' value=" +
                        _token +
                        ">" +
                        "<button type='submit'>Editar</button>" +
                        "</form>" +
                        "</td>" +
                        "<td class='size' >" +
                        "<form action='/admin/medics/" +
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
            }
        }
    });
}

function EditarMedico(obj) {
    $(".edit").click(function() {
        $("#error").empty();
        var id = this.id;
        console.log(id);

        var modal = document.getElementById("modalEditar");
        modal.style.display = "block";

        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            modal.style.display = "none";
            $("#names").val("");
            $("#emails").val("");
            $("#cellphones").val("");
            $("#especialidadesModal option:selected").removeAttr("selected");
            $("#modalEditar input:radio").removeAttr("checked");
            $("#sendEditar").remove();
            $(".changedContent").append(
                '<button id="sendEditar">Enviar </button>'
            );
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                $("#names").val("");
                $("#emails").val("");
                $("#cellphones").val("");
                $("#especialidadesModal option:selected").removeAttr(
                    "selected"
                );
                $("#modalEditar input:radio").removeAttr("checked");
                $("#sendEditar").remove();
                $(".changedContent").append(
                    '<button id="sendEditar">Enviar </button>'
                );
            }
        };

        var name = $("#name" + id).val();
        var email = $("#email" + id).val();
        var cell = $("#cellphone" + id).val();
        var adse = $("#adse" + id).val();
        var esp = $("#esp" + id).val();

        $("#names").val(name);
        $("#emails").val(email);
        $("#cellphones").val(cell);
        if (adse == 1) {
            $("#adses").attr("checked", "checked");
        } else {
            $("#adses2").attr("checked", "checked");
        }
        for (let key in obj) {
            if (obj[key].name == esp) {
                $(
                    "#especialidadesModal option[value=" + obj[key].value + "]"
                ).attr("selected", "selected");
            }
        }

        $("#sendEditar").click(function() {
            var content_name = $("#names").val();
            var content_email = $("#emails").val();
            var content_phone = $("#cellphones").val();
            if ($("#adses").is(":checked")) {
                var content_adse = $("#adses").val();
            }
            if ($("#adses2").is(":checked")) {
                var content_adse = $("#adses2").val();
            }
            var content_esp = $("#especialidadesModal option:selected").val();
            var _token = $("#token").val();

            //SE O CONTENT NAO FOR VAZIO
            if (
                content_name != "" &&
                content_email != "" &&
                content_phone != "" &&
                content_adse != null
            ) {
                var data = {
                    id: id,
                    name: content_name,
                    email: content_email,
                    cellphone: content_phone,
                    adse: content_adse,
                    specialty_id: content_esp,
                    " _token": _token
                };
                console.log(data);
                $("#sendEditar").remove();
                $(".changedContent").append(
                    '<button id="sendEditar">Enviar </button>'
                );
                $.ajax({
                    url: "/admin/medics/edit",
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

                            console.log(data.data.adse);
                            if (data.data.adse == 1) {
                                $("#adse1Td" + id).replaceWith(
                                    "<td class='size'  id='adse1Td" +
                                        data.data.id +
                                        "'> Sim </td>"
                                );
                            } else {
                                $("#adse1Td" + id).replaceWith(
                                    "<td class='size'  id='adse1Td" +
                                        data.data.id +
                                        "'> Não </td>"
                                );
                            }

                            $("#adse" + id).val(data.data.adse);

                            $("#espTd" + id).replaceWith(
                                "<td  id='espTd" +
                                    data.data.id +
                                    "'>" +
                                    data.data.specialty.specialty +
                                    "</td>"
                            );
                            $("#esp" + id).val(data.data.specialty.specialty);

                            modal.style.display = "none";
                            $("#names").val("");
                            $("#emails").val("");
                            $("#cellphones").val("");
                            $(
                                "#especialidadesModal option:selected"
                            ).removeAttr("selected");
                            $("#modalEditar input:radio").removeAttr("checked");
                        } else {
                            $("#error").empty();
                            for (var x in data.menssage) {
                                $("#error").append(
                                    "<span>" + data.menssage[x][0] + "</span> "
                                );
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
