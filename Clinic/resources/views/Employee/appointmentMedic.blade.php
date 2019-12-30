@extends('layouts.employee')

@section('content')
<div class="appointmentMedic">

    <div class="header">

        <!-- Coluna -->
        <img id="img_medic_profile" src="\assets\stethoscope.svg" alt=""> <!-- LINHA -->
        <!-- Coluna -->
        <div class="item">
            <h3> <span> Medico:</span> {{$getMedic->user->name}} </h3> <!-- LINHA -->

            <h3> <span> Especialidade:</span> {{$getMedic->specialty->specialty}} </h3> <!-- LINHA -->
        </div>
        <!-- Coluna -->
        <div class="item item1">
            <h3> <span> Rating:</span> {{$getMedic->rating}} </h3> <!-- LINHA -->

            <h3> <span> Adse:</span>
                @if($getMedic->adse == 1)
                Sim
                @else
                Não
                @endif
            </h3> <!-- LINHA -->
        </div>
    </div>
    <h1> Appointment Medic {{$getMedic->id}} Empoyee </h1>
    <h1>FAZER CALENDARIO</h1>
    <h1>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, ea omnis esse dolorum quisquam numquam
        quae accusamus quia repellat odit! Sed beatae rerum quibusdam vitae minus voluptates dignissimos illum numquam!
    </h1>
    <h1>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus, repellat sunt facilis magnam quos, ab
        cupiditate aliquid quod odio exercitationem quibusdam minima nostrum vel nihil, accusamus recusandae fugit.
        Placeat, quisquam.</h1>
    <h1>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet pariatur quaerat accusamus praesentium sed,
        itaque alias quia magnam? Maxime quaerat possimus dolorem fugit nobis numquam repellat repudiandae tempora
        magnam illum.</h1>

</div>
@endsection