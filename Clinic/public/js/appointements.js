function initPageEmail() {
    filterSelection("all");

    var dataToFill = [];
    $.get("/api/medic/orderer", function(data) {
        dataToFill = data;
        console.log(dataToFill);
    });

    $("#especialidade").change(function() {
        if ($(this).val() === "" && $("#medico").val() === "") {
            filterSelection("all");
        } else {
            filterSelection($(this).val());
            filterMedics($(this).val(), dataToFill);
        }
    });

    /*
    filterSelection("all");
    //filterMedics("all");
    //  $("#addEventBtn").click(sendEmail);

    $("#especialidade").change(function() {
        if ($(this).val() === "" && $("#medico").val() === "") {
            filterSelection("all");
        } else {
            filterMedics($(this).val());
            //filterSelection($(this).val());
        }
    });

    $("#medico").change(function() {
        if ($(this).val() === "") {
            filterSelection("all");
        } else {
            filterSelection($(this).val());
        }
    });*/
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
    console.log(dataToFill);
    /*var array = [];
    for (var chave in dataToFill.data) {
        console.log(chave);
        if (dataToFill.data[chave].specialty == "Cona") {
            array.push(dataToFill.data[chave]);
        }
    }
    console.log(array);*/
    var resultAarray = jQuery.grep(dataToFill.data, function(n) {
        return n.specialty === c;
    });
    console.log(resultAarray);
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
