@extends('administrador.base')
@section('elementos')
    <form class="col s12" method="post" action="{{ route('savecoordinador') }}">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Nuevo Coordinador</h4>
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
                    <div class="input-field col s12 m6 white-text">
                        <select id="facultad" name="facultad" onchange="realizaProceso(this.value)" required>
                            <option disabled selected="selected">Seleccione la facultad a la que pertenece
                            </option>
                            @foreach($facultads as $facultad)
                                <option value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                            @endforeach
                        </select>
                        <label class="white-text">Facultad</label>
                    </div>
                    <div id="cajalicen" class="input-field col s12 m6 white-text oculto">
                        <select id="licen" name="licen" required></select>
                        <label for="licen" class="white-text">Licenciatura</label>
                    </div>
                    <div class="input-field col s12 m6 oculto">
                        <input class="white-text" type="text" id="nombre" name="nombre" value="" placeholder="Introduzca el nombre">
                        <label class="white-text" for="nombre">Nombre</label>
                    </div>
                    <div class="input-field col s12 m6 oculto">
                        <input class="white-text" type="text" id="apellido" name="apellido" value="" placeholder="Introduzca los apellidos">
                        <label class="white-text"  for="apellido">Apellido</label>
                    </div>
                    <div class="input-field col s12 m12 oculto">
                        <input class="white-text"  type="email" id="email" name="email" value="" placeholder="Ingrese correo electrónico institucional">
                        <label class="white-text"  for="email">Correo Institucional</label>
                    </div>
                    <div class="input-field col s12 m6 oculto">
                        <input class="white-text"  type="password" id="password" name="password"  placeholder="Ingrese su contraseña">
                        <label class="white-text" for="pass">Contraseña (Debe contener mínimo 8 caracteres)</label>
                    </div>
                    <div class="input-field col s12 m6 oculto">
                        <input class="white-text"  type="password" id="password_confirmation " name="password_confirmation" placeholder="Vuelva a introducir su contraseña">
                        <label class="white-text"  for="email">Confirmar contraseña</label>
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
            <a name="cancel" id="cancel" href="{{ route('viewcoordinador') }}" class="white-text red darken-1 btn boton">Cancelar y volver</a>
        </div>
    </form>
    <script>
        function realizaProceso(val) {
            var selecte = document.getElementById('licen');
            $.ajax({
                type: 'post',
                url: '{{route('ajaxlicen')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    facultad: val
                },
                success: function (response) {
                    var cosas = response.html;
                    selecte.innerHTML = cosas;
                    $("#licen").trigger('contentChanged');
                    MostrarOcultos();
                }
            });
        }

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