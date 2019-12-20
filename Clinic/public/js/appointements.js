function initPageEmail() {
    var dataToFill = [];
    var dataToFillEsp = [];

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
                    " <tr  class='clickable' data-href='/client/appointment/medic/" +
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
                        " <tr  class='clickable' data-href='/client/appointment/medic/" +
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

$(document).ready(initPageEmail);
