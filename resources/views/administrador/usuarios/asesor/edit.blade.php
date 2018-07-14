@extends('administrador.base')
@section('elementos')
    <style>

    </style>
    <form class="col s12" method="post" action="{{ route('updateasesor',$consultant->id) }}">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Editar Asesor</h4>
                    </blockquote>
                </div>
            </div>
            @if(session()->has('message'))
                <div class="green darken-4 white-text col s12 m12 center-align" style="border-radius: 25px">
                    <h5>{{ session()->get('message') }}</h5>
                </div><br>
            @endif
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
                    <div class="input-field col s12 m6 ">
                        <input class="white-text" type="text" id="nombre" name="nombre" value="{{ $consultant->nombre }}" placeholder="Introduzca el nombre">
                        <label class="white-text" for="nombre">Nombre</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text" type="text" id="apellido" name="apellido" value="{{ $consultant->apellido }}" placeholder="Introduzca los apellidos">
                        <label class="white-text"  for="apellido">Apellido</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text"  type="text" id="nivel_estudio" name="nivel_estudio" value="{{ $consultant->nivel_estudio }}" placeholder="Introduzca el nivel de estudio">
                        <label class="white-text"  for="nivel_estudio">Nivel de Estudio</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text"  type="text" id="especialidad" name="especialidad" value="{{ $consultant->especialidad }}" placeholder="Introduzca la especialidad">
                        <label class="white-text"  for="especialidad">Especialidad</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text"  type="text" id="lugar" name="lugar" value="{{ $consultant->lugar }}"
                               placeholder="Ingrese el sitio en donde se llevarán a cabo las asesorías">
                        <label class="white-text"  for="correo">Lugar de asesorías</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text"  type="email" id="correo" name="correo" value="{{ $consultant->correo }}" placeholder="Ingrese correo electrónico institucional">
                        <label class="white-text"  for="correo">Correo Institucional</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text"  type="password" id="password" name="password" value="" placeholder="Ingrese nueva contraseña">
                        <label class="white-text" for="pass">Contraseña (Debe contener mínimo 8 caracteres)</label>
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input class="white-text"  type="password" id="password_confirmation" value="" name="password_confirmation" placeholder="Vuelva a introducir la nueva contraseña">
                        <label class="white-text"  for="password">Confirmar contraseña</label>
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