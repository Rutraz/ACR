@extends('layouts.client')

@section('content')
<script src="{{ asset('js/sendEmail.js')}}" defer></script>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<div class="support">
    <br>
    <h1> Pagina de suporte</h1>
    <div class="text">
        <h3>Pode contar com a nossa equipa de especialistas altamente qualificados em serviços de assistência ao
            cliente, que se orgulham pessoalmente de prestar um serviço de alto nível a todos os clientes.</h3>
        <h3>
            Por favor, note que somos capazes de responder muito mais rápido nas nossas horas normais de suporte entre
            8h e 17h, de segunda a sexta-feira, exceto feriados.</h3>
    </div>
    <div class="employee">
        @if ($allemplos->isNotEmpty())
        @foreach($allemplos as $allemplo)
        @if($allemplo->admin != 1)
        <div class="item">
            <h1>{{$allemplo->user->name}}</h1>
            <ul>
                <li>Email: <a href="mailto:{{$allemplo->user->email}}">{{$allemplo->user->email}}</a></li>
                <li>Telefone: {{$allemplo->user->cellphone}}</li>

            </ul>
        </div>
        @endif
        @endforeach
        @else
        <h1> Tem tem funcionários registados no website </h1>
        @endif
    </div>

    <div class="emailSend">

        <h2>Envie diretamente um email</h2>
        <form id="myForm" method="" action="">
            <input type="text" placeholder=" Nome" name="name" id="name" required>
            <br>
            <br>
            <input type="email" placeholder=" Email" name="email" id="email" required>
            <br>
            <br>
            <textarea rows="4" cols="39" placeholder=" Messagem" name="message" id="message" required></textarea>
            <br>
        </form>
        <button id="addEventBtn" type="button">Enviar</button>
        <br><br>
    </div>
    <br>

</div>
@endsection