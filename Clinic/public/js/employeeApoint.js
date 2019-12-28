function initPageEmail() {
    var dataToFill = [];
    var dataToFillEsp = [];

    $(".marcar").click(function() {
        $("html, body").animate(
            {
                scrollTop: $("#middle").offset().top
            },
            1000
        );
    });

    $(".consultar").click(function() {
        $("html, body").animate(
            {
                scrollTop: $("#bottom").offset().top
            },
            1000
        );
    });
    $(".inicio").click(function() {
        $("html, body").animate(
            {
                scrollTop: $("#top").offset().top
            },
            1000
        );
    });

    $.get("/api/medic/orderer", function(data) {
        dataToFill = data.data;
        startFilling(dataToFill, "");
        filterMedics("all", dataToFill);
    });

    $.get("/api/medic/esp", function(data) {
        dataToFillEsp = data.data;
        filterEsp("all", dataToFillEsp);
    });

    $("#searchBtn").click(askSearch);

    $("#especialidade").change(function() {
        if ($(this).val() === "" && $("#medico").val() === "") {
            filterMedics("all", dataToFill);
            filterEsp("all", dataToFillEsp);
        } else {
            filterMedics($(this).val(), dataToFill);
        }
    });

    $("#medico").change(function() {
        if ($(this).val() === "" && $("#especialidade").val() === "") {
            filterMedics("all", dataToFill);
            filterEsp("all", dataToFillEsp);
        } else {
            filterEsp($(this).val(), dataToFillEsp);
        }
    });

    $(".openModal").click(buttonsOpenModal);
    $(".clickable2").click(openModal2);
}

function askSearch() {
    var adse = $("#adse option:selected").val();
    var esp = $("#especialidade").val();
    var medic = $("#medico").val();
    var order = $("#order").val();
    console.log("ADSE: " + adse);
    console.log("ESP: " + esp);
    console.log("Medic: " + medic);
    console.log("Order: " + order);

    if (!esp && !medic && !adse) {
        $("#tbody").empty();
        start();
    }
    var dataToSend = "?esp=" + esp + "&medic=" + medic + "&order=" + order;
    $.ajax({
        url: "/medic/search" + dataToSend,
        type: "GET",
        async: true,
        success: function(data, statuTxt, xhr) {
            $("#tbody").empty();
            startFilling(data.data, adse);
        }
    });
}

function start() {
    $.ajax({
        url: "/api/medic/orderer",
        type: "GET",
        async: true,
        success: function(data, statuTxt, xhr) {
            startFilling(data.data, "");
            filterMedics("all", data.data);
        }
    });

    $.ajax({
        url: "/api/medic/esp",
        type: "GET",
        async: true,
        success: function(data, statuTxt, xhr) {
            filterEsp("all", data.data);
        }
    });
}

function filterMedics(c, dataToFill) {
    $("#medicos>option").remove();

    if (c == "all") {
        dataToFill.forEach(element => {
            $("#medicos").append("<option value='" + element.user.name + "' >");
        });
    } else {
        var resultAarray = jQuery.grep(dataToFill, function(n) {
            return n.specialty.specialty === c;
        });
        resultAarray.forEach(element => {
            $("#medicos").append("<option value='" + element.user.name + "' >");
        });
    }
}

function filterEsp(c, dataToFill) {
    $("#especialidades>option").remove();
    if (c == "all") {
        dataToFill.forEach(element => {
            $("#especialidades").append(
                "<option value= '" + element.specialty + "' > </option>"
            );
        });
    }
}

function startFilling(dataToFill, adse) {
    console.log("DATA TO FILL " + dataToFill.length);

    if (dataToFill.length != 0 && dataToFill) {
        dataToFill.forEach(element => {
            var resultSpe = element.specialty.specialty
                ? element.specialty.specialty
                : element.specialty;
            var x = "";
            if (element.adse == 1) {
                x = "Sim";
            } else {
                x = "Não";
            }
            if (adse == "") {
                $("#tbody").append(
                    " <tr  class='clickable' data-href='/employee/appointment/medic/" +
                        element.id +
                        "' > <td class='size'>" +
                        element.rating +
                        "</td> <td>" +
                        element.user.name +
                        " </td> <td>" +
                        resultSpe +
                        "</td> <td class='size'>" +
                        x +
                        "</td> </tr>"
                );
            } else {
                if (element.adse == adse) {
                    $("#tbody").append(
                        " <tr  class='clickable' data-href='/employee/appointment/medic/" +
                            element.id +
                            "' > <td class='size'>" +
                            element.rating +
                            "</td> <td>" +
                            element.user.name +
                            " </td> <td>" +
                            resultSpe +
                            "</td> <td class='size'>" +
                            x +
                            "</td> </tr>"
                    );
                }
            }
        });
    } else {
        $("#tbody").append(
            "<tr> <td>Nao existe medicos com os filtros da sua pesquisa </td></tr>"
        );
    }

    $("#tbody .clickable").click(function() {
        var thisdata = $(this).attr("data-href");
        console.log(thisdata);

        window.location.href = thisdata;
    });
}

function buttonsOpenModal() {
    $("#error").empty();
    var id = this.id;
    console.log(id);
    var modal = document.getElementById("modalComent");
    modal.style.display = "block";

    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        modal.style.display = "none";
        $("#send").remove();
        $(".changedContent").append('<button id="send">Enviar </button>');
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            $("#send").remove();
            $(".changedContent").append('<button id="send">Enviar </button>');
        }
    };

    $("#send").click(function() {
        var content = $("#stateChange").val();
        var token = $("#token").val();
        var dataToSend = {
            id: id,
            " _token": token,
            state_id: content
        };
        console.log(dataToSend);
        if (content != "") {
            $.ajax({
                url: "/employee/appointment/change",
                type: "POST",
                data: dataToSend,
                async: true,
                success: function(data, statuTxt, xhr) {
                    console.log(data);
                    if (data.success) {
                        modal.style.display = "none";
                        if (data.message.id == 4) {
                            $("#td" + id).replaceWith(
                                "<td id='td" +
                                    id +
                                    "' class='mediumSize' style='background-color:" +
                                    data.message.color +
                                    "'> " +
                                    data.message.state +
                                    " </td>"
                            );
                            $("#btn" + id).replaceWith(
                                " <td class='mediumSize'>Não é possivel modificar</td>"
                            );
                        } else {
                            $("#td" + id).replaceWith(
                                "<td id='td" +
                                    id +
                                    "' class='mediumSize' style='background-color:" +
                                    data.message.color +
                                    "'>" +
                                    data.message.state +
                                    " </td>"
                            );
                        }
                    } else {
                        $("#error").empty();
                        $("#error").append(
                            "<span>" + data.message + "</span> "
                        );
                    }
                    $("#send").remove();
                    $(".changedContent").append(
                        '<button id="send">Enviar </button>'
                    );
                }
            });
        } else {
            $("#error").empty();
            $("#error").append(
                "<span>Tem que preencher caso queira modificar o estado da consulta </span> "
            );
        }
    });
}

function openModal2() {
    $(".Content").empty();
    $(".Content2").empty();
    var id = parseInt(this.id);
    console.log(id);
    $.ajax({
        url: "/employee/appointment/" + id,
        type: "GET",
        async: true,
        success: function(data, statuTxt, xhr) {
            var modal = document.getElementById("modalMore");
            modal.style.display = "block";

            var span = document.getElementsByClassName("close")[1];

            span.onclick = function() {
                modal.style.display = "none";
                $(".Content").empty();
                $(".Content2").empty();
            };

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    $(".Content").empty();
                    $(".Content2").empty();
                }
            };
            $(".Content").append(
                "<span class='element'>Data :</span> <span class='data'>" +
                    data.message.date +
                    " </span> <br>" +
                    "<span class='element'>Estado da consulta :</span> <span class='data'>" +
                    data.message.state +
                    " </span> <br>" +
                    "<span class='element'>Cliente :</span> <span class='data'>" +
                    data.message.client.name +
                    " </span> <br>" +
                    "<span class='element'>Email do Cliente :</span> <span class='data'>" +
                    data.message.client.email +
                    " </span> <br>" +
                    "<span class='element'>Comentário :</span> <span class='data'>" +
                    data.message.comments +
                    " </span> <br>" +
                    "<span class='element'>Avaliação :</span> <span class='data'>" +
                    data.message.rating +
                    " </span> <br>"
            );
            $(".Content2").append(
                "<span class='element'>Medico :</span> <span class='data'>" +
                    data.message.medic.name +
                    " </span> <br>" +
                    "<span class='element'>Especialidade :</span> <span class='data'>" +
                    data.message.medic.specialty +
                    " </span> <br>" +
                    "<span class='element'>Rating do Medico :</span> <span class='data'>" +
                    data.message.medic.rating +
                    " </span> <br>"
            );
        }
    });
}

$(document).ready(initPageEmail);
