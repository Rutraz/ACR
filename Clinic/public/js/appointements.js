function initPageEmail() {
    filterSelection("all");

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

    $("#especialidade").change(function() {
        if ($(this).val() === "" && $("#medico").val() === "") {
            filterSelection("all");
            filterMedics("all", dataToFill);
            filterEsp("all", dataToFillEsp);
        } else {
            if ($(this).val() === "") {
                filterSelection($("#medico").val());
            } else {
                filterSelection($(this).val());
                filterMedics($(this).val(), dataToFill);
            }
        }
    });

    $("#medico").change(function() {
        if ($(this).val() === "" && $("#especialidade").val() === "") {
            filterSelection("all");
            filterMedics("all", dataToFill);
            filterEsp("all", dataToFillEsp);
        } else {
            if ($(this).val() === "") {
                filterSelection($("#especialidade").val());
            } else {
                filterSelection($(this).val());
                filterEsp($(this).val(), dataToFillEsp);
            }
        }
    });
}

function filterSelection(c) {
    var x = $(".medic");
    if (c == "all") c = "";
    for (var i = 0; i < x.length; i++) {
        Remove(x[i], "show");
        if (x[i].className.indexOf(c) > -1) Add(x[i], "show");
    }
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
                "<option value='" + element.specialty + "' >"
            );
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

$(document).ready(initPageEmail);
