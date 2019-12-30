@extends('layouts.client')

@section('content')
<div class="clientMedic">
    <script src="{{asset('js/test.js')}}" defer ></script>
    <div class="header" style="background-image:url('{{ asset('assets/Gest/test.jpg') }}')">
        <div> <!-- Coluna -->
            <img id="img_medic_profile" src="\assets\Both\meidc.png" alt=""> <!-- LINHA -->
        </div>
        <div > <!-- Coluna -->
            <div class="item">
                <h1> <span> Medico: </span>  {{$getMedic->user->name}} </h1> <!-- LINHA -->
            </div>
            <div class="item">
                <h1> <span> Especialidade: </span>{{$getMedic->specialty->specialty}} </h1> <!-- LINHA -->
            </div>
        </div>
        <div> <!-- Coluna -->
            <div class="item1">
                <h1> <span> Rating: </span>{{$getMedic->rating}} </h1> <!-- LINHA -->
            </div>
            <div class="item1">
                <h1>  <span> Adse:</span>
                    @if($getMedic->adse == 1)
                    Sim
                    @else
                    Não
                    @endif
                </h1> <!-- LINHA -->
            </div>
        </div>
    </div>
    
    <div class ="calendar">
        <h1>Janeiro</h1>
        <table id="test">
            <tr>
                <th></th>
                <th>Segunda</th>
                <th>Terça</th>
                <th>Quarta</th>
                <th>Quinta</th>
                <th>Sexta</th>
                <th>Sabado</th>
                <th>Domingo</th>
            </tr>
            <tr>
                <td>8am</td>
            </tr>
            <tr>
                <td>9am</td>
            </tr>
            <tr>
                <td>10am</td>
            </tr>
            <tr>
                <td>11am</td>
            </tr>
           
        </table>
        

    </div>

    <div class ="comments">

    </div>
   
    
</div>
@endsection