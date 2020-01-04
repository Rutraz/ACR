@extends('layouts.client')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ asset('js/utils.js')}}" defer></script>
<script src="{{ asset('js/oneMore.js') }}" defer></script>

<div class="welcome">
    <img id="stetho" class="rotate-vert-center" src="{{asset('assets/Gest/healthcare-logo.png')}}" />
    <br>
    <span>Bem vindo ao</span>
    <h1 class="title text-focus-in"> HealthCare </h1>

    <div class="text">
        <h3>{{$user->name}}, queremos o melhor para si, saúde e reabilitação, à sua disposição</h3>
        <h3>Somos uma empresa implantada no mercado da Saude há mais de 20 anos e garantimos uma grande qualidade na
            prestação de serviços pois os profissionais da clinica HealthCare regem-se
            por valores como <strong>qualificação</strong>, <strong>conhecimento</strong>, <strong>experiência</strong>,
            <strong>competência</strong>, <strong>simpatia e atenção</strong> disponibilizada a cada cliente </h3>
        <h3>Possuimos intalações proprias com aproximadamente 400m2, equipada com aparelhos modernos e tecnologicamente
            avançados</h3>

        <div id="appointments"></div>
        <hr>
        <div id="temperature2"></div>
    </div>

    <div id="modalComent" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1> Consultas e Analises marcadas </h1>
            <div class="changedContent">
                <div id="fillStuff"></div>
                <div id="fillStuff2"></div>
            </div>
            <div id="error"></div>
        </div>
    </div>
</div>

</div>
@endsection