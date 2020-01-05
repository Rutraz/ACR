var eventData = [];

function initPage() {
    eventData = [];
    gapi.load("client", printHoliday);
    console.log($("#medicID").val());

    $.get(
        "/api/appointment/medic/" + $("#medicID").val() + "/calendar",
        function(data) {
            /*  console.log(data); */
            if (data.success) {
                for (var el in data.appointments) {
                    var date = new Date(data.appointments[el].date);
                    var dateEnd = moment(date)
                        .add(1, "hours")
                        .format();

                    var obj = {
                        id: data.appointments[el].id,
                        start: date.toISOString(),
                        title: data.appointments[el].client.user.name,
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

        eventClick: function(event) {
            console.log(event.event.id);

            openEventModal(event.event.title, event.event.id);
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
                    /* console.log("Response from google");
                      console.log(response.result.items); */

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
//VAI BUSCAR O HORARIO
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
                    /* console.log("Response from google");
                    console.log(response.result.items); */

                    for (var el in response.result.items) {
                        var obj = {
                            groupId: "completed",
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
