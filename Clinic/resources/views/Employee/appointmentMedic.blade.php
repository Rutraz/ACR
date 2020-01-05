@extends('layouts.employee')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>
<script src="https://apis.google.com/js/api.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>



<link href='{{asset('fullcalender/packages/core/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/daygrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/timegrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('fullcalender/packages/list/main.css')}}' rel='stylesheet' />
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="appointmentMedic">
    <input type="hidden" id="medicID" value="{{$getMedic->user->id}}">
    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
    <input type="hidden" name="calendarid" id="calendarid" value="{{$getMedic->calendarid}}">

    <div class="header">
        <h3> <span> Medico:</span> {{$getMedic->user->name}} </h3> <!-- LINHA -->

        <h3> <span> Especialidade:</span> {{$getMedic->specialty->specialty}} </h3> <!-- LINHA -->

        <h3> <span> Adse:</span>
            @if($getMedic->adse == 1)
            Sim
            @else
            Não
            @endif
        </h3> <!-- LINHA -->

        <label for="cc">Cc do cliente: </label><input type="text" name="cc" id="cc" required>
        <label for="email">Email do cliente: </label><input type="email" name="email" id="email" required>

    </div>

    <div style="width:90%; text-align:center; margin-left:auto; margin-right:auto;">
        <div id='calendar'></div>

        <div style='clear:both'></div>

    </div>


    <script src='{{asset('fullcalender/packages/core/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/interaction/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/daygrid/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/timegrid/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/list/main.js')}}'></script>
    <script src='{{asset('fullcalender/packages/core/locales-all.js')}}'></script>

    <script src='{{asset('fullcalender/js/appointCalendar.js')}}'></script>

    <script>
        function sendData(start) {

            var cc = $("#cc").val();
            var email = $("#email").val();
            $("#cc").css("border-color", "#3490dc");
            $("#email").css("border-color", "#3490dc");
            console.log(cc);
            console.log(email);
            

            if(cc && email){
                
                    var obj = {
                        _token: $("#token").val(),
                        id: $("#medicID").val(),
                        cc :cc,
                        email: email,
                        date: start
                    };
                console.log(obj);

                    $.ajax({
                        url: "/employee/appointment/medic/" + obj.id,
                        type: "POST",
                        data: obj,
                        async: true,
                        success: function(data, statuTxt, xhr) {
                            console.log(data);

                            if (data.success) {
                                var date = new Date(data.message.date);
                                var dateEnd = moment(date)
                                .add(1, "hours")
                                    .format();
                                console.log(date.toISOString());
                                console.log(dateEnd);

                                var obj = {
                                    groupId: "full",
                                    id: data.message.id,
                                    start: date.toISOString(),
                                    end: dateEnd,
                                    color: data.message.state.color, // an option!
                                    textColor: "black" // an option!
                                };

                                eventData.push(obj);

                                $("#calendar").empty();
                                calendar();
                                alert("Marcou a consulta com sucesso");
                            }
                            else{
                                var text = "";
                                if(data.message){

                                    if(data.message.cc){
                                        text += "Cartao de cidadao invalido \n"
                                    }
                                    if(data.message.email){
                                        text += "Email invalido"
                                    }
                                }else{
                                    text += data.messageNot
                                }
                                
                                alert(text);
                            }
                        }
                    });
                
            }else{
                $("#cc").css("border-color", "#ff1a1a");
                $("#email").css("border-color", "#ff1a1a");     
            }
}
    </script>
</div>
@endsection