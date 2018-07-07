@extends('administrador.base')
@section('elementos')
    <form class="col s12" method="post" action="{{ route('saveasesor') }}">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Nuevo Asesor</h4>
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
                <div class="row">
                    <div class="input-field col s12 m6 ">
                        <input class="white-text" type="text" id="nombre" name="nombre" value="" placeholder="Introduzca el nombre">
                        <label class="white-text" for="nombre">Nombre</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text" type="text" id="apellido" name="apellido" value="" placeholder="Introduzca los apellidos">
                        <label class="white-text"  for="apellido">Apellido</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text"  type="text" id="nivel_estudio" name="nivel_estudio" value="" placeholder="Introduzca el nivel de estudio">
                        <label class="white-text"  for="nivel_estudio">Nivel de Estudio</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text"  type="text" id="especialidad" name="especialidad" value="" placeholder="Introduzca la Especialidad">
                        <label class="white-text"  for="especialidad">Especialidad</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text"  type="text" id="lugar" name="lugar" value=""
                               placeholder="Ingrese el sitio en donde se llevarán a cabo las asesorías">
                        <label class="white-text"  for="correo">Lugar de asesorías</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text"  type="email" id="correo" name="correo" value="" placeholder="Ingrese un correo electrónico institucional">
                        <label class="white-text"  for="correo">Correo Institucional</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text"  type="password" id="password" name="password"  placeholder="Ingrese su contraseña">
                        <label class="white-text" for="pass">Contraseña (Debe contener mínimo 8 caracteres)</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text"  type="password" id="password_confirmation " name="password_confirmation" placeholder="Vuelva a introducir su contraseña">
                        <label class="white-text"  for="email">Confirmar contraseña</label>
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
            <a name="cancel" id="cancel" href="{{ route('viewasesor') }}" class="white-text red darken-1 btn boton">Cancelar y volver</a>
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