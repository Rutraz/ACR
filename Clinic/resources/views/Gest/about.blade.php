@extends('layouts.app')

@section('content')
<div class="aboutContainer">
    <div class="header" style="background-image:url('{{ asset('assets/Gest/banner.jpg') }}')">
    </div>
    <div class="body" style="background-image:url('{{ asset('assets/Gest/test.jpg') }}')">
        <br>
        <h2>Sobre nós</h2>
        <p>A Equipa Médica da Healthcare Privada de Guimarães assume-se como pautada pela experiência e qualidade de
            serviço contudo diferenciada por centrar a totalidade da sua atenção em dar uma resposta global e integrada
            ao doente. As necessidades dos nossos doentes são o cerne da atenção de todos os nossos colaboradores.</p>
        <div class="sub-body">
            <h2>Missão</h2>
            <div class="m-b-md">
                <img src="{{asset('assets/Gest/healthcare.png')}}" />
                <p>Prestação de cuidados de saúde de excelência potenciadores de bem-estar, oferecendo assistência
                    médica especializada e integrada, em ambiente institucional, ambulatório, e domiciliário, promovendo
                    a prevenção e educação, integrando Medicinas Convencionais e Alternativas.
                    A Clínica pretende posicionar-se como a Unidade de Saúde reconhecida pela <b>CONFIANÇA.</b>
                </p>
                <p></p>
            </div>
            <h2>Visão</h2>
            <p>Prestação de cuidados de saúde de excelência potenciadores de bem-estar, oferecendo assistência médica
                especializada e integrada, em ambiente institucional, ambulatório, e domiciliário, promovendo a
                prevenção e educação, integrando Medicinas Convencionais e Alternativas.</p>
            <br>
        </div>
        <br><br>
    </div>

</div>
@endsection