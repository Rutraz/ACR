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
        $(".medicList>a").remove();
        start();
    }
    var dataToSend = "?esp=" + esp + "&medic=" + medic + "&order=" + order;
    $.ajax({
        url: "/client/appointment/search" + dataToSend,
        type: "GET",
        async: true,
        success: function(data, statuTxt, xhr) {
            $(".medicList>a").remove();
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
                "<option value='" + element.specialty + "' > </option>"
            );
        });
    }
}

function startFilling(dataToFill, adse) {
    console.log(dataToFill);

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
                $(".medicList").append(
                    "<a id='" +
                        element.id +
                        "' class='medic' href='/client/appointment/medic/" +
                        element.id +
                        "' >" +
                        "<h2>" +
                        element.rating +
                        "</h2>" +
                        "<h2>" +
                        resultSpe +
                        "</h2>" +
                        "<h2>" +
                        element.user.name +
                        "</h2>" +
                        "<h2>" +
                        x +
                        "</h2>" +
                        "</a>"
                );
            } else {
                if (element.adse == adse) {
                    $(".medicList").append(
                        "<a id='" +
                            element.id +
                            "' class='medic' href='/client/appointment/medic/" +
                            element.id +
                            "' >" +
                            "<h2>" +
                            element.rating +
                            "</h2>" +
                            "<h2>" +
                            resultSpe +
                            "</h2>" +
                            "<h2>" +
                            element.user.name +
                            "</h2>" +
                            "<h2>" +
                            x +
                            "</h2>" +
                            "</a>"
                    );
                }
            }
        });
    } else {
        $(".medicList").append(
            "<h1> Nao existe medicos com os atributos da sua pesquisa</h1>"
        );
    }
}

$(document).ready(initPageEmail);
