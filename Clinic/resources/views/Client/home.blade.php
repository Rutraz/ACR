@extends('layouts.client')

@section('content')
<div class="welcome">
<img id="stetho" src="{{asset('assets/Gest/healthcare-logo.png')}}"/>  
    <br>
    <h1>Bem vindo ao</h1>
    <h1 class= "title"> HealthCare </h1>
      
    <div class="text">
        <h3>{{$user->name}}, queremos o melhor para si, saúde e reabilitação, à sua disposição</h3>
        <h3>Somos uma empresa implantada no mercado da Saude há mais de 20 anos e garantimos uma grande qualidade na prestação de serviços pois os profissionais da clinica HealthCare regem-se
        por valores como <strong>qualificação</strong>, <strong>conhecimento</strong>, <strong>experiência</strong>, <strong>competência</strong>, <strong>simpatia e atenção</strong> disponibilizada a cada cliente </h3>
        <h3>Possuimos intalações proprias com aproximadamente 400m2, equipada com aparelhos modernos e tecnologicamente avançados</h3>

    </div>   
    <h1></h1>
</div>

</div>
@endsection
