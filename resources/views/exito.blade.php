@extends('templates.static')
@section('body')
    <div class="row">
        <br>
        <br>
        <br>
        <div class="row padre">
            <div class="row col s12 m6">
                <div class="row col s12 m12" style="display: inline-block">
                    <form class=" white-text" method="post" action="{{ route('newalumno') }}" id="Formulario" name="Formulario">
                        <h4 class="center-align">Registro completo</h4>
                        <section><p><br></p></section>
                        <div class="row center">
                            <a name="cancel" id="cancel" href="{{ route('alumnologinl') }}" class="white-text red darken-1 btn
                            boton">Iniciar Sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection