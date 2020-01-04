var eventData = [];
var workableData = [];
function initPage() {
    gapi.load("client", printHoliday);

    $.get(
        "/api/appointment/medic/" + $("#medicID").val() + "/calendar",
        function(data) {
            console.log(data);
            if (data.success) {
                for (var el in data.appointments) {
                    var date = new Date(data.appointments[el].date);
                    var dateEnd = moment(date)
                        .add(1, "hours")
                        .format();

                    var obj = {
                        groupId: "full",
                        id: data.appointments[el].id,
                        start: date.toISOString(),
                        end: dateEnd,
                        color: data.appointments[el].state.color, // an option!
                        textColor: "black" // an option!
                    };
                    eventData.push(obj);
                }
            }
        }
    );
}

function calendar() {
    var Calendar = FullCalendar.Calendar;

    var calendarEl = document.getElementById("calendar");

    var calendar = new Calendar(calendarEl, {
        plugins: ["interaction", "dayGrid", "timeGrid", "list"],
        header: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek"
        },
        validRange: {
            start: new Date().toISOString()
        },
        weekends: false,
        defaultTimedEventDuration: "01:00:00",
        forceEventDuration: true,
        locale: "pt-br",
        height: 600,
        allDaySlot: false,
        slotEventOverlap: true,
        slotDuration: "01:00:00",
        nowIndicator: true,
        minTime: "09:00:00",
        maxTime: "17:00:00",
        eventDurationEditable: false,
        eventLimit: true,
        selectable: true,
        editable: false,

        dateClick: function(event) {
            var bool = false;
            var start = moment(event.dateStr).format("YYYY-MM-DD HH:mm:ss");

            var verification = moment(event.dateStr).format("HH:mm:ss");

            var date = new Date(start);

            console.log("Tempo da data" + date.getTime());
            var now = new Date();
            console.log("Tempo de agora" + now.getTime());

            var parse = parseInt(verification);

            if (parse != 0 && date.getTime() > now.getTime()) {
                if (confirm("Quer comfimar as analises para " + start + "!")) {
                    console.log(start);
                    sendData(start);
                }
            } else {
                console.log("adeus");
            }
        },

        eventClick: function(event) {
            alert("Não é possivel marcar a consulta nesta hora");
        },

        events: eventData
    });
    calendar.render();
}

function printHoliday() {
    var calendarId = "1i29600sqpel6cuovbc3g6qhqc@group.calendar.google.com";

    var apiKey = "AIzaSyCKT1TdtuayzpzjoKQnuh1nJU7NH95dIwk";

    var calendarIdHoliday = "en.portuguese#holiday@group.v.calendar.google.com";

    var userTimeZone = "Europe/Portugal";

    gapi.client
        .init({
            apiKey: apiKey,

            discoveryDocs: [
                "https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"
            ]
        })
        .then(function() {
            return gapi.client.calendar.events.list({
                calendarId: calendarIdHoliday,
                timeZone: userTimeZone,
                singleEvents: true,
                timeMin: new Date().toISOString(), //traz apenas o eventos apartir de hoje
                maxResults: 20,
                orderBy: "startTime"
            });
        })
        .then(
            function(response) {
                if (response.result.items) {
                    console.log("Response from google");
                    console.log(response.result.items);

                    for (var el in response.result.items) {
                        var obj = {
                            groupId: "completed",
                            title: response.result.items[el].summary,
                            id: response.result.items[el].id,
                            start: moment(response.result.items[el].start.date)
                                .add(8, "hours")
                                .format(),
                            end: moment(response.result.items[el].start.date)
                                .add(20, "hours")
                                .format(),
                            color: "green", // an option!
                            textColor: "black" // an option!
                        };
                        eventData.push(obj);
                    }
                    console.log("EventData");
                    console.log(eventData);
                    gapi.load("client", printCalendar);
                }
            },
            function(reason) {
                console.log("Error: " + reason.result.error.message);
            }
        );
}

function printCalendar() {
    var calendarId = $("#calendarid").val();

    var apiKey = "AIzaSyCKT1TdtuayzpzjoKQnuh1nJU7NH95dIwk";

    var userTimeZone = "Europe/Portugal";

    gapi.client
        .init({
            apiKey: apiKey,

            discoveryDocs: [
                "https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"
            ]
        })
        .then(function() {
            return gapi.client.calendar.events.list({
                calendarId: calendarId,
                timeZone: userTimeZone,
                singleEvents: true,
                timeMin: new Date().toISOString(), //traz apenas o eventos apartir de hoje
                maxResults: 20,
                orderBy: "startTime"
            });
        })
        .then(
            function(response) {
                if (response.result.items) {
                    console.log("Response from google");
                    console.log(response.result.items);

                    for (var el in response.result.items) {
                        var obj = {
                            groupId: "completed",
                            title: response.result.items[el].summary,
                            id: response.result.items[el].id,
                            start: response.result.items[el].start.dateTime,
                            end: response.result.items[el].end.dateTime,
                            rendering: "background",
                            color: "blue" // an option!
                        };
                        eventData.push(obj);
                    }
                    console.log("EventData");
                    console.log(eventData);
                    calendar();
                }
            },
            function(reason) {
                console.log("Error: " + reason.result.error.message);
            }
        );
}

$(document).ready(initPage);
