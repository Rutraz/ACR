@extends('layouts.client')

@section('content')
<script src="{{ asset('js/validation.js')}}" defer></script>
<div class="editProfile">
    <div class="container">
        <div class="perfil">
            <h2>Editar perfil</h2>
            <hr>
            <br>
            <form id="editprofile" method="post" action="/client/profile/edit">
                @csrf
                <input type="hidden" class="token" name="_token" value="{{csrf_token()}}">

                <label for="name">{{ __('Nome: ') }}</label>
                <input id="name" type="text" class="loginput @error('name') invalid @enderror" name="name"
                    value="{{ $user->name }}" placeholder="Introduza o seu nome" required autocomplete="name" autofocus>

                @error('name')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <br><br>

                <label for="cellphone">{{ __('Telemovel: ') }}</label>
                <input id="cellphone" type="text" class="loginput @error('cellphone') invalid @enderror"
                    name="cellphone" placeholder="Numero de Telemovel" value="{{ $user->cellphone  }}" maxlength="9"
                    required autofocus>

                @error('cellphone')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br><br>


                <label for="idade">{{ __('Idade: ') }}</label>
                <input id="idade" type="date" class="loginput @error('idade') invalid @enderror" name="idade"
                    value="{{ $client->idade }}" placeholder="Apenas informacional" autofocus>

                @error('idade')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br><br>

                <label for="CC">{{ __('CC: ') }}</label>
                <input id="CC" type="text" class="loginput @error('CC') invalid @enderror" name="CC"
                    placeholder="Cartao de cidadão" value="{{ $client->CC }}" required autofocus>

                @error('CC')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br><br>


                <label for="adse">{{ __('Adse: ') }}</label>
                <input id="adse" type="text" class="loginput @error('adse') invalid @enderror" name="adse"
                    value="{{ $client->adse }}" placeholder="ADSE se beneficiar " autofocus>

                @error('adse')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br><br>


                <label for="morada">{{ __('Morada: ') }}</label>
                <input id="morada" type="text" class="loginput @error('morada') invalid @enderror" name="morada"
                    value="{{ $client->morada }}" placeholder="Introduza a sua morada" required autofocus>

                @error('morada')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br><br>
                <button id="btnEditProfile" type="submit">Enviar</button>
            </form>
        </div>

        <div class="email">
            <h2>Editar email</h2>
            <hr>
            <br>
            <form id="editemail" method="post" action="/client/profile/edit/email">
                @csrf
                <input type="hidden" class="token" name="_token" value="{{csrf_token()}}">

                <label for="email">{{ __('E-Mail: ') }}</label>
                <input id="email" type="email" class="loginput @error('email') invalid @enderror" name="email"
                    placeholder="Introduza o seu email" value="{{ $user->email }}" required autocomplete="email">

                @error('email')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <br><br>

                <label for="password">{{ __('Password: ') }}</label>
                <input id="password" type="password" class="loginput @error('password') invalid @enderror"
                    name="password" placeholder="Introduza a sua password" required autocomplete="new-password"
                    minlength="8">

                @error('password')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br><br>
                <button id="btnEditEmail" type="submit">Enviar</button>
            </form>
        </div>
    </div>

    <div class="container2">
        <div class="password">
            <h2>Editar password</h2>
            <hr>
            <form id="editpassword" method="post" action="/client/profile/edit/password">
                @csrf
                <input type="hidden" class="token" name="_token" value="{{csrf_token()}}">

                <label for="old_password">{{ __('Password') }}</label>
                <input id="old_password" type="password" class="loginput @error('password') invalid @enderror"
                    name="old_password" placeholder="Introduza a sua password" required autocomplete="new-password"
                    minlength="8">

                @error('old_password')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <br><br>

                <label for="new_password">{{ __('Nova password') }}</label>
                <input id="new_password" type="password" class="loginput @error('new_password') invalid @enderror"
                    name="new_password" placeholder="Introduza a sua nova password" required autocomplete="new-password"
                    minlength="8">

                @error('new_password')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <br><br>

                <label for="comfirm">{{ __('Confirme a password') }}</label>
                <input id="comfirm" type="password" class="loginput @error('comfirm') invalid @enderror" name="comfirm"
                    placeholder="Confirma a sua nova password" required autocomplete="new-password" minlength="8">

                @error('comfirm')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br><br>
                <button id="btnEditPassword" type="submit">Enviar</button>
            </form>
        </div>

        <div class="eliminar">
            <h2>Eliminar conta</h2>
            <hr>
            <form id="editpassword" method="post" action="/client/profile/erase">
                @csrf
                <input type="hidden" class="token" name="_token" value="{{csrf_token()}}">

                <label for="passwordErase">{{ __('Password') }}</label>
                <input id="passwordErase" type="password" class="loginput @error('passwordErase') invalid @enderror"
                    name="passwordErase" placeholder="Introduza a sua password" required minlength="8">

                @error('passwordErase')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <br><br>

                <label for="passwordComfirm">{{ __('Confirme a password') }}</label>
                <input id="passwordComfirm" type="password" class="loginput @error('passwordComfirm') invalid @enderror"
                    name="passwordComfirm" placeholder="Confirma a sua nova password" required minlength="8">

                @error('passwordComfirm')
                <span class="feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br><br>
                <button id="btnDeleteProfile" type="submit">Enviar</button>
            </form>
        </div>
    </div>

</div>
@endsection