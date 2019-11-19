@extends('layouts.app')

@section('content')
<div class="contactContainer">
    <div class="header" style="background-image:url('{{ asset('assets/contact.jpg') }}')"> </div>
    <div class="body">
    <h2>Contactos</h2>
    
        <div class="midleLinks">
            <div class="item">
                <h3>Envie um Email.</h3>
                <form method ="post" action="sendEmail.php">
                <input  type="text" size="40" placeholder=" Nome" name="name" id="name" >
                <br>
                <br>
                <input type="email" size="40" placeholder=" Email" name="email" id="email" >
                <br>
                <br>
                <textarea rows="4" cols="39" placeholder=" Messagem" name="message" id="message"> </textarea>
                <br> <br>
             <!--   <input class="button button1"  type="button" value="Enviar"> -->
              <!-- <button class="button button1" type="button" >Enviar</button>   -->
               
                </form>
            </div>
            <div class="item">
               <div class="container1">
                    <div class="item1"> <img src="{{asset('assets/gps-icon.png')}}"  alt="" >  
                    <p> Rua da tua prima  </p>     </div>
                    <div class="item1"> <img src="{{asset('assets/cellphone-icon.png')}}"  alt="" >  
                    <p> 291 478 342  </p>     </div>
                    <div class="item1"> <img src="{{asset('assets/email-icon.png')}}"  alt="" >  
                    <p id="p" > Tuaprima@hotmail.com  </p>     </div>
               </div>
               <hr>
               <div class="container2" >
               <div class="item2"> <img src="{{asset('assets/facebook-icon.png')}}" alt="" >
               <div class="item2" > <img src="{{asset('assets/twitter-logo.png')}}"  alt="" > 
               <div class="item2" > <img src="{{asset('assets/instagram-logo.png')}}"  alt="" >  
               <div class="item2" > <img src="{{asset('assets/linkin-icon.png')}}"  alt="" >            
            </div>

        </div>
           <br><br>
        </div> 
        
    </div>
    
</div>
@endsection