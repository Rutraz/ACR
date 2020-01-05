var eventData = [];

function initPage() {
    gapi.load("client", printHoliday);

    $.get("/api/analysis", function(data) {
        /*  console.log(data); */
        if (data.success) {
            for (var el in data.message) {
                var date = new Date(data.message[el].date);
                var dateEnd = moment(date)
                    .add(30, "m")
                    .format();
                var obj = {
                    groupId: "full",
                    id: data.message[el].id,
                    start: date.toISOString(),
                    end: dateEnd,
                    color: data.message[el].state.color, // an option!
                    textColor: "black" // an option!
                };
                eventData.push(obj);
            }
        }
    });
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
        defaultTimedEventDuration: "00:30:00",
        forceEventDuration: true,
        locale: "pt-br",
        height: 700,
        allDaySlot: false,
        slotEventOverlap: true,
        slotDuration: "00:30:00",
        nowIndicator: true,
        minTime: "08:00:00",
        maxTime: "17:00:00",
        eventDurationEditable: false,
        eventLimit: true,
        selectable: true,
        editable: false,

        businessHours: {
            daysOfWeek: [1, 2, 3, 4, 5],
            startTime: "8:00",
            endTime: "12:00",
            groupId: "dayof"
        },

        dateClick: function(event) {
            var start = moment(event.dateStr).format("YYYY-MM-DD HH:mm:ss");

            var verification = moment(event.dateStr).format("HH:mm:ss");

            var comp = new Date();
            comp.setHours("12", "00", "00");

            var date = new Date(start);

            console.log("Tempo da data" + date.getTime());
            var now = new Date();
            console.log("Tempo de agora" + now.getTime());

            var parse = parseInt(verification);
            var compare = parseInt(moment(comp).format("HH:mm:ss"));

            if (
                parse < compare &&
                parse != 0 &&
                date.getTime() > now.getTime()
            ) {
                if (confirm("Quer comfimar as analises para " + start + "!")) {
                    console.log(start);
                    sendData(start);
                }
            } else {
                console.log("adeus");
            }
        },

        eventClick: function(event) {
            alert("Estas horas estão completas");
        },

        events: eventData
    });
    calendar.render();
}

function printHoliday() {
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
                    /* console.log("EventData");
                    console.log(eventData); */
                    gapi.load("client", printCalendar);
                }
            },
            function(reason) {
                console.log("Error: " + reason.result.error.message);
            }
        );
}

function printCalendar() {
    var calendarId = "acrclinicemail@gmail.com";

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
                            color: "red", // an option!
                            textColor: "black" // an option!
                        };
                        eventData.push(obj);
                    }
                    /*  console.log("EventData");
                    console.log(eventData); */
                    calendar();
                }
            },
            function(reason) {
                console.log("Error: " + reason.result.error.message);
            }
        );
}

$(document).ready(initPage);
