function initPageEmail() {
    var dataToFill = [];
    var dataToFillEsp = [];
    $.get("/api/medic/orderer", function(data) {
        dataToFill = data.data;
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
    console.log(adse);
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
    console.log(dataToFill);
    if (c == "all") {
        dataToFill.forEach(element => {
            $("#especialidades").append(
                "<option value='" + element.specialty + "' >"
            );
        });
    }
}
/*

function filterSelection(c) {
    var x = $(".medic");
    if (c == "all") c = "";
    for (var i = 0; i < x.length; i++) {
        Remove(x[i], "show");
        if (x[i].className.indexOf(c) > -1) Add(x[i], "show");
    }
}

function Add(element, name) {
    var arr1 = element.className.split(" ");
    var arr2 = name.split(" ");
    for (var i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) {
            element.className += " " + arr2[i];
        }
    }
}

function Remove(element, name) {
    var arr1 = element.className.split(" ");
    var arr2 = name.split(" ");
    for (var i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
            arr1.splice(arr1.indexOf(arr2[i]), 1);
        }
    }
    element.className = arr1.join(" ");
}
*/
$(document).ready(initPageEmail);
