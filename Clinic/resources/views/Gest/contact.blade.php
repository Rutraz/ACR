@extends('layouts.app')

@section('content')
<script src="{{ asset('js/sendEmail.js')}}" defer></script>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<div class="contactContainer">
    <div class="header" style="background-image:url('{{ asset('assets/Gest/contact.jpg') }}')"> </div>
    <div class="body">
    <h2>Contactos</h2>
    
        <div class="midleLinks">
            <div class="item">
                <h3>Envie-nos um e-mail.</h3>
                <form id="myForm" method =""  action="">
                    <input id="input"  type="text" size="45" placeholder="Nome" name="name" id="name" >         
                    <input type="email" size="45" placeholder="Email" name="email" id="email" >
                    <textarea rows="4" cols="43" placeholder="Messagem..." name="message" id="message"> </textarea>
                </form>
               <button class="button1" id="addEventBtn" type="button" >Enviar</button>   
            </div>
            
            <div class="item">
               <div class="container1">
                    <div class="item1"> <img src="{{asset('assets/Gest/gps-icon.png')}}"  alt="" >  
                    <p> Rua da tua prima  </p>     </div>
                    <div class="item1"> <img src="{{asset('assets/Gest/cellphone-icon.png')}}"  alt="" >  
                    <p> 291 478 342  </p>     </div>
                    <div class="item1"> <img src="{{asset('assets/Gest/email-icon.png')}}"  alt="" >  
                    <p id="p" > acrclinicemail@gmail.com  </p>     </div>
               </div>
               <hr>
               <div class="container2" >
               <div class="item2"> <img src="{{asset('assets/Gest/facebook-icon.png')}}" alt="" >
               <div class="item2" > <img src="{{asset('assets/Gest/twitter-logo.png')}}"  alt="" > 
               <div class="item2" > <img src="{{asset('assets/Gest/instagram-logo.png')}}"  alt="" >         
            </div>

        </div>
           <br><br>
        </div> 
        
    </div>
    
</div>
@endsection