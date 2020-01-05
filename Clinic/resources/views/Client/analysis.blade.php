@extends('layouts.client')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>
<script src="https://apis.google.com/js/api.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>



<link href='{{asset('fullcalender/packages/core/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/daygrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/timegrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/list/main.css')}}' rel='stylesheet' />

<link href='{{asset('fullcalender/css/style.css')}}' rel='stylesheet' />

<meta name="csrf-token" content="{{ csrf_token() }}">

<div style="">

    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">

    <div style="text-align:center">
        <div id='calendar' class="appointMedic"></div>

        <div style='clear:both'></div>

    </div>

    <script src='{{asset('fullcalender/packages/core/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/interaction/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/daygrid/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/timegrid/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/list/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/core/locales-all.js')}}'></script>



    <script src='{{asset('fullcalender/js/calendar.js')}}'></script>

    <script>
        function sendData(start) {
            var obj = {
                _token: $("#token").val(),
                date: start
            };
            console.log(obj);

            $.ajax({
                url: "/client/analysis/create",
                type: "POST",
                data: obj,
                async: true,
                success: function(data, statuTxt, xhr) {
                    console.log(data);

                    if (data.success) {
                        var date = new Date(data.message.date);
                        var dateEnd = moment(date)
                            .add(30, "m")
                            .format();
                        console.log(date.toISOString());
                        console.log(dateEnd);

                        var obj = {
                            groupId: "full",
                            id: data.message.id,
                            start: date.toISOString(),
                            end: dateEnd,
                            color: "yellow", // an option!
                            textColor: "black" // an option!
                        };

                        console.log(calendar);
                        eventData.push(obj);

                        $("#calendar").empty();
                        calendar();
                        alert("Foi marcado com sucesso");
                    }
                }
            });
        }
    </script>

</div>
<style>
    .fc-right button {
        margin-right: 0.5em;
    }
</style>
@endsection