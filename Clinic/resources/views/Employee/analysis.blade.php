@extends('layouts.employee')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<div class="appointmentPage">
    <div id="top" class="same">
        <button class="marcar">Marcar Analise</button>
        <button class="consultar">Consultar Analises</button>
    </div>
    <div id="middle" class="same">
        <button class="inicio">Inicio</button>
        <button class="consultar">Consultar Analises</button>
    </div>
    <div id="bottom" class="same">
        <button class="inicio">Inicio</button>
        <button class="marcar">Marcar Analise</button>

        @for ($i = 0; $i < sizeof($analysis); $i++) {{$analysis[$i]->date}} @endfor <table>
            <thead>
                <tr>
                    <th class="size"> Rating </th>
                    <th> Médico </th>
                    <th> Especialidade </th>
                    <th class="size"> ADSE </th>
                </tr>
            </thead>

            <tbody id="tbody">

            </tbody>
            </table>

    </div>


    <script>
        $(".marcar").click(function() {
            $('html, body').animate({
                scrollTop: $("#middle").offset().top
            }, 1000);
        });

        $(".consultar").click(function() {
            $('html, body').animate({
                scrollTop: $("#bottom").offset().top
            }, 1000);
        });
        $(".inicio").click(function() {
            $('html, body').animate({
                scrollTop: $("#top").offset().top
            }, 1000);
        });
        
    
    </script>
</div>
@endsection