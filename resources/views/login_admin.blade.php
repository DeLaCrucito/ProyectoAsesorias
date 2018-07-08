@extends('templates.static')
@section('body')
    <style>
        .padre {
            display: flex;
            justify-content: center;
        }
        .input-field input:focus + label,i{
            color: white !important;
        }
        /* label underline focus color */
        .row .input-field input:focus {
            border-bottom: 1px solid white !important;
            box-shadow: 0 1px 0 0 white !important
        }
        .boton{
            margin-top: 10px;
            width: 100%;
            max-width: 240px;
            border-radius: 100px;
            z-index: 0;
            letter-spacing: .5px;
            font-weight: 500;
        }

    </style>
    <div class="row">
        <br>
        <br>
        <br>
        <div class="row padre">
            <div class="row col s12 m6">
                <div class="row col s12 m12" style="display: inline-block">
                    <h4 class="center white-text">Portal de Asesorías</h4>
                    <section><p><br></p></section>
                    <form class=" white-text" method="post" action="{{ route('adminsignin') }}" id="Formulario" name="Formulario">
                        {{ csrf_field() }}
                        <h5 class="white-text center-align">Administrador</h5>
                        <div class="row ">
                            @if(session()->has('message'))
                                <div class="red darken-1 white-text col s12 m12 center-align" style="border-radius: 25px">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix" style="focus: white">account_circle</i>
                                    <input placeholder="" type="email"  name="email" id="email" />
                                    <label for="email">Correo</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">lock</i>
                                    <input placeholder="" type="password" name="password" id="password" required
                                           pattern="[A-Za-z0-9_-]{1,16}"/>

                                    <label for="password">Contraseña</label>
                                </div>
                                <br>
                            </div>
                            <div class="row center">
                                <button type="submit" name="btn_login"  class=" black-text light-blue accent-1 btn boton"> Iniciar Sesión</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection