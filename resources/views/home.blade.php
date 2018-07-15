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
                <div class="row col s12 m12" id="caja1" style="display: inline-block">
                    <h4 class="white-text center thin">Bienvenido al Portal de Asesorias</h4>
                    <section><p><br></p></section>
                    <div class="center-align" id="botones">
                        <p class="white-text">Iniciar Sesión como</p>
                        <a name="cancel" id="alumno" href="{{ route('alumnologin') }}" class="white-text red darken-1
                        btn boton">Alumno</a><br>
                        <a name="cancel" id="asesor" href="{{ route('asesorlogin') }}" class="white-text red darken-1
                        btn boton">Asesor</a><br>
                        <a name="cancel" id="coordinador" href="{{ route('coordinadorlogin') }}" class="white-text red
                        darken-1 btn boton">Coordinador</a>
                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection