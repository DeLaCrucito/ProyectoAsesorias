@extends('administrador.base')
@section('elementos')
    <form class="col s12" method="post" action="{{ route('savelicenciatura') }}">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Nueva Licenciatura</h4>
                    </blockquote>
                </div>
            </div>
            @if ($errors->any())
                <div class="red darken-1 white-text" style="border-radius: 25px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div style="margin-top: 50px">
                <div class="row">
                    <div class="input-field col s12 m5 white-text">
                        <select id="facultad" name="facultad" required>
                            <option disabled selected="selected">Seleccione una facultad</option>
                            @foreach($facultads as $facultad)
                                <option value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                            @endforeach
                        </select>
                        <label class="white-text">Facultad</label>
                    </div>
                    <div class="input-field col s12 m7">
                        <input class="white-text" type="text" placeholder="Ingrese el nombre de la licenciatura"
                               name="nombre" id="nombre"/>
                        <label class="white-text" for="nombre">Nombre de la licenciatura</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <input class="white-text" type="number" min="1" max="12" placeholder="¿Cuántos semestres tiene la carrera?"
                               name="semestres" id="semestres"/>
                        <label class="white-text" for="semestres">Semestres</label>
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
            <button type="submit" name="guardar" id="guardar" class="disabled black-text light-blue accent-1 btn boton">Guardar</button><br>
            <a name="cancel" id="cancel" href="{{ route('viewlicenciatura') }}" class="white-text red darken-1 btn boton">Cancelar y volver</a>
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