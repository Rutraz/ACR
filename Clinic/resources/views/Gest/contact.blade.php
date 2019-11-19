@extends('layouts.app')

@section('content')
<div class="contactContainer">
    <div class="header"> </div>
    <div class="body">
    <h2>Contactos</h2>
    
        <div class="midleLinks">
            <div class="item">
                <h3>Envie um Email.</h3>
                <form action="">
                <input type="text" size="40" placeholder=" Nome" name="Yourname" id="name" >
                <br>
                <br>
                <input type="email" size="40" placeholder=" Email" name="YourEmail" id="email" >
                <br>
                <br>
                <textarea rows="4" cols="39" placeholder=" Messagem"> </textarea>
                <br> <br>
                <button type="button" onclick="alert('Ricard é gay')">Enviar</button>
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
            </div>

        </div>
           <br><br>
        </div> 
    </div>
</div>
@endsection