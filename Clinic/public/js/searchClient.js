function initPageEmail() {
    var obj = {
        name: "",
        cc: "",
        tel: ""
    };

    var dataToFill = [];
    $.ajax({
        url: "/api/employee/client",
        type: "GET",
        async: true,
        success: function(data, statuTxt, xhr) {
            dataToFill = data.data;
            console.log(data.data);
            startFilling(dataToFill);

            filterClientName("all", dataToFill);
            filterCCName("all", dataToFill);
            filterTelName("all", dataToFill);
        }
    });

    $("#searchBtn").click(askSearch);

    $("#cliente").change(function() {
        if (
            $(this).val() === "" &&
            $("#cc").val() === "" &&
            $("#telemovel").val() === ""
        ) {
            filterClientName("all", dataToFill);
            filterCCName("all", dataToFill);
            filterTelName("all", dataToFill);
            obj.tel = "";
            obj.name = "";
            obj.cc = "";
        } else {
            obj.name = $(this).val();
            filterCCName(obj, dataToFill);
            filterTelName(obj, dataToFill);
        }
    });

    $("#cc").change(function() {
        if (
            $(this).val() === "" &&
            $("#cliente").val() === "" &&
            $("#telemovel").val() === ""
        ) {
            filterClientName("all", dataToFill);
            filterCCName("all", dataToFill);
            filterTelName("all", dataToFill);
            obj.tel = "";
            obj.name = "";
            obj.cc = "";
        } else {
            obj.cc = $(this).val();
            filterClientName(obj, dataToFill);
            filterTelName(obj, dataToFill);
        }
    });

    $("#telemovel").change(function() {
        if (
            $(this).val() === "" &&
            $("#cliente").val() === "" &&
            $("#cc").val() === ""
        ) {
            filterClientName("all", dataToFill);
            filterCCName("all", dataToFill);
            filterTelName("all", dataToFill);
            obj.tel = "";
            obj.name = "";
            obj.cc = "";
        } else {
            obj.tel = $(this).val();
            filterClientName(obj, dataToFill);
            filterCCName(obj, dataToFill);
        }
    });
}

function askSearch() {
    var cliente = $("#cliente").val();
    var cc = $("#cc").val();
    var tel = $("#telemovel").val();
    var order = $("#order").val();
    console.log("cliente: " + cliente);
    console.log("cc: " + cc);
    console.log("telemovel: " + tel);
    console.log("Order: " + order);

    if (!cliente && !cc && !tel && order == 1) {
        $("#tbody").empty();
        start();
    } else {
        var dataToSend =
            "?cli=" +
            cliente +
            "&cc=" +
            cc +
            "&cell=" +
            tel +
            "&order=" +
            order;
        $.ajax({
            url: "/client/search" + dataToSend,
            type: "GET",
            async: true,
            success: function(data, statuTxt, xhr) {
                console.log(data.data);
                $("#tbody").empty();
                startFilling(data.data);
            }
        });
    }
}

function start() {
    $.ajax({
        url: "/api/employee/client",
        type: "GET",
        async: true,
        success: function(data, statuTxt, xhr) {
            console.log(data.data);
            startFilling(data.data);
        }
    });
}

function filterClientName(c, dataToFill) {
    $("#clientes>option").remove();

    if (c == "all") {
        dataToFill.forEach(element => {
            $("#clientes").append(
                "<option value='" + element.user.name + "' >"
            );
        });
    } else {
        if (c.cc) {
            var resultAarray = jQuery.grep(dataToFill, function(n) {
                return n.CC === c.cc;
            });
        } else {
            var resultAarray = jQuery.grep(dataToFill, function(n) {
                return n.user.cellphone === c.tel;
            });
        }
        resultAarray.forEach(element => {
            $("#clientes").append(
                "<option value='" + element.user.name + "' >"
            );
        });
    }
}

function filterCCName(c, dataToFill) {
    $("#ccs>option").remove();

    if (c == "all") {
        dataToFill.forEach(element => {
            $("#ccs").append("<option value='" + element.CC + "' >");
        });
    } else {
        if (c.name) {
            var resultAarray = jQuery.grep(dataToFill, function(n) {
                return n.user.name === c.name;
            });
        } else {
            var resultAarray = jQuery.grep(dataToFill, function(n) {
                return n.user.cellphone === c.tel;
            });
        }
        resultAarray.forEach(element => {
            $("#ccs").append("<option value='" + element.CC + "' >");
        });
    }
}

function filterTelName(c, dataToFill) {
    $("#telemovels>option").remove();

    if (c == "all") {
        dataToFill.forEach(element => {
            $("#telemovels").append(
                "<option value='" + element.user.cellphone + "' >"
            );
        });
    } else {
        if (c.name) {
            var resultAarray = jQuery.grep(dataToFill, function(n) {
                return n.user.name === c.name;
            });
        } else {
            var resultAarray = jQuery.grep(dataToFill, function(n) {
                return n.CC === c.cc;
            });
        }
        resultAarray.forEach(element => {
            $("#telemovels").append(
                "<option value='" + element.user.cellphone + "' >"
            );
        });
    }
}

function startFilling(dataToFill) {
    console.log("DATA TO FILL " + dataToFill.length);

    if (dataToFill.length != 0 && dataToFill) {
        dataToFill.forEach(element => {
            $("#tbody").append(
                " <tr  class='clickable' id=" +
                    element.user.id +
                    " > <td >" +
                    element.user.name +
                    "</td> <td>" +
                    element.CC +
                    " </td> <td>" +
                    element.idade +
                    "</td> <td >" +
                    element.adse +
                    "</td> </tr>"
            );
        });
    } else {
        $("#tbody").append(
            "<tr> <td>Nao existe medicos com os filtros da sua pesquisa </td></tr>"
        );
    }

    $("#tbody .clickable").click(function() {
        $(".changedContent").empty();
        $(".changedContent2").empty();
        $.ajax({
            url: "/api/client/user/" + this.id,
            type: "GET",
            async: true,
            success: function(data, statuTxt, xhr) {
                var modal = document.getElementById("modalComent");
                modal.style.display = "block";

                var span = document.getElementsByClassName("close")[0];

                span.onclick = function() {
                    modal.style.display = "none";
                    $(".changedContent").empty();
                    $(".changedContent2").empty();
                };

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                        $(".changedContent").empty();
                        $(".changedContent2").empty();
                    }
                };
                $(".changedContent").append(
                    "<span class='element'>Nome :</span> <span class='data'>" +
                        data.data.user.name +
                        " </span> <br>" +
                        "<span class='element'>Telemovel :</span> <span class='data'>" +
                        data.data.user.cellphone +
                        " </span> <br>" +
                        "<span class='element'>Cartão de cidadão :</span> <span class='data'>" +
                        data.data.CC +
                        " </span> <br>"
                );
                $(".changedContent2").append(
                    "<span class='element'>Email :</span> <span class='data'>" +
                        data.data.user.email +
                        " </span> <br>" +
                        "<span class='element'>Morada :</span> <span class='data'>" +
                        data.data.morada +
                        " </span> <br>" +
                        "<span class='element'>Data de nascimento :</span> <span class='data'>" +
                        data.data.idade +
                        " </span> <br>" +
                        "<span class='element'>ADSE :</span> <span class='data'>" +
                        data.data.adse +
                        " </span> <br>"
                );
                /*
                for (var el in data.data) {
                    if (el == "user") {
                        for (var els in data.data.user) {
                            if (els != "id") {
                                $(".changedContent").append(
                                    "<span class='element'> " +
                                        els +
                                        " :</span> <span class='data'>" +
                                        data.data.user[els] +
                                        " </span> <br>"
                                );
                            }
                        }
                    } else {
                        if (el != "id") {
                            $(".changedContent2").append(
                                "<span class='element'> " +
                                    el +
                                    " :</span> <span class='data'>" +
                                    data.data[el] +
                                    " </span>  <br>"
                            );
                        }
                    }
                }*/
            }
        });
    });
}

$(document).ready(initPageEmail);
