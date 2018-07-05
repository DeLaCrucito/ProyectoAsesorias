@extends('administrador.base')
@section('elementos')
    <form class="col s12" method="post" action="{{ route('updateaprovechamiento',$exploitation->id) }}">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Editar Nivel de Aprovechamiento</h4>
                    </blockquote>
                </div>
            </div>
            <div style="margin-top: 50px">
                @if ($errors->any())
                    <div class="red darken-1 white-text" style="border-radius: 25px">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="input-field col s12 m3 ">
                        <input class="white-text" type="text" id="min" name="min" value="{{ $exploitation->min }}" placeholder="Introduzca el valor mínimo">
                        <label class="white-text" for="min">Calificación Mínimo</label>
                    </div>
                    <div class="input-field col s12 m3 ">
                        <input class="white-text" type="text" id="max" name="max" value="{{ $exploitation->max }}" placeholder="Introduzca el valor máximo">
                        <label class="white-text" for="max">Calificación Máxima</label>
                    </div>
                    <div class="input-field col s12 m4 ">
                        <input class="white-text" type="text" id="nivel" name="nivel" value="{{ $exploitation->nivel }}" placeholder="Introduzca el nivel de aprovechamiento">
                        <label class="white-text" for="nivel">Nivel de Aprovechamiento</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row center-align">
            <div style="display: inline-flex">
                <input type="checkbox" onclick="Validacaja(this)" class="filled-in" id="validar"/>
                <label class="white-text" for="validar">Los datos son correctos</label>
            </div>
            <br>
            <button type="submit" name="guardar" id="guardar" class="disabled black-text light-blue accent-1 btn boton">Guardar</button>
            <br>
            <a name="cancel" id="cancel" href="{{ route('viewaprovechamiento') }}" class="white-text red darken-1 btn boton">Cancelar y volver</a>
        </div>
    </form>
    <script>
        function Validacaja(caja) {
            var finalizar = document.getElementById('guardar');
            finalizar.getAttribute('class');
            if (caja.checked === true) {
                finalizar.setAttribute('class', 'black-text light-blue accent-1 btn boton');
            } else if (caja.checked === false) {
                finalizar.setAttribute('class', 'disabled black-text light-blue accent-1 btn boton');
            }
        }
    </script>
@endsection