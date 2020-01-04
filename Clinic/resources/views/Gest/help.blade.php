@extends('layouts.app')

@section('content')
<script src="{{ asset('js/help.js') }}" defer></script>
<div class="helpPage">
    <div class="headerhelp" style="background-image:url('{{ asset('assets/Gest/helpbg.png') }}')">
        <p class="maintitle"> FAQ </p>
        <p class="abstract"> Têm alguma dúvida relativamente ao funcionamento do nosso serviço ou à nossa plataforma de
            apoio ?
            Aqui disponibilizamos as questões gerais mais frequentes por parte dos nossos utilizadores.
            Se não encontrar aqui o que procura não exite em <a href="{{ url('/contact') }}">contactar-nos</a>.</p>
    </div>

    <div class="helpContainer" style="background-image:url('{{ asset('assets/Gest/test.jpg') }}')">
        @foreach($faqs as $faq)
        <button type="button" class="question">{{$faq->question}}</button>
        <div class="answer">
            <p>{{$faq->response}}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection