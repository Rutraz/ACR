function initPage() {
    getTemperature();
}

function handleNewTemp(data) {
    console.log(data);

    $("#temperature2").append(
        "<h3> Localização: " +
            data.location.name +
            " / " +
            data.location.region +
            "</h3>",
        "<h3> Cobertura de nuvens: " + data.current.cloudcover + " % </h3>",
        "<h3> Temperatura atual: " + data.current.temperature + "ºC </h3>",
        "<img src='" + data.current.weather_icons + "' />"
    );
}

function getTemperature() {
    $.ajax({
        url:
            "http://api.weatherstack.com/current?access_key=209988c0669e56228fa7bed46687965d&query=Funchal",

        type: "GET",
        async: true,
        crossDomain: true,
        dataType: "jsonp",
        jsonpCallback: "handleNewTemp"
    });
}

$(document).ready(initPage);
