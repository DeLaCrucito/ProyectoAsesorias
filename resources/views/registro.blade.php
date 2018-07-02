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
                        <h4 class="center-align">Nuevo usuario</h4>
                        {{ csrf_field() }}
                        <section><p><br></p></section>
                        <div class="row ">
                            @if ($errors->any())
                                <div class="red darken-1 white-text" style="border-radius: 25px">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="input-field col s12 m6">
                                <input class="white-text" id="nombre" type="text"  name="nombre" placeholder="Ingresa tus nombres"
                                        required value="{{ old('nombre') }}">
                                <label class="white-text" for="nombre">Nombre</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input class="white-text" id="apellido" type="text" placeholder="Ingresa tus apellidos"
                                       name="apellido" value="{{ old('apellido') }}" required>
                                <label class="white-text" for="apellido">Apellido</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <select class="white-text" id="facultad" name="facultad" onchange="mostrarlicenciatura
                                (this.value)" value="{{ old('facultad') }}">
                                    <option value="" disabled selected>Seleccione su facultad</option>
                                    @foreach($facultads as $facultad)
                                        <option value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                                    @endforeach
                                </select>
                                <label class="white-text">Facultad</label>
                            </div>
                            <div id="cajalicen" class="input-field col s12 m6 white-text">
                                <select  class="white-text" id="licen" name="licen" onchange="mostrarsemestre(this
                                .value)" required value="{{ old('licenciatura') }}">
                                    <option value="" disabled selected>Seleccione una licenciatura</option>
                                </select>
                                <label for="licen" class="white-text">Licenciatura</label>
                            </div>
                            <div id="oculto4" class="input-field col s12 m6 white-text">
                                <select class="white-text" id="semestre" name="semestre" value="{{ old('semestre') }}"
                                        required>
                                    <option disabled selected="selected">Seleccione un semestre</option>
                                </select>
                                <label for="semestre" class="white-text">Semestre</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input class="white-text" id="matri" type="number" placeholder="Introduce tu matricula"
                                       name="matri" min="11111" value="{{ old('matri') }}" required>
                                <label class="white-text" for="matri">Matricula</label>
                            </div>
                            <div class="input-field col s12">
                                <input class="white-text" id="email" type="email"
                                       placeholder="Introduce tu correo institucional" value="{{ old('email') }}"
                                       name="email"
                                       required>
                                <label class="white-text" for="email">Correo institucional</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input class="white-text"  type="password" id="password" name="password"  placeholder="Ingrese su contraseña">
                                <label class="white-text" for="password">Contraseña</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input class="white-text"  type="password" id="password_confirmation " name="password_confirmation" placeholder="Vuelva a introducir su contraseña">
                                <label class="white-text"  for="password_confirmation ">Confirmar contraseña</label>
                            </div>

                        </div>
                        <div class="row center">
                            <button type="submit" name="btn_login"  class=" black-text light-blue accent-1 btn boton">Registrarse</button>
                            <p></p>
                            <a style="color: #bbdefb" href="{{route('alumnologin')}}">¿Ya se encuentra registrado?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function mostrarlicenciatura(val) {
            var selecte = document.getElementById('licen');
            $.ajax({
                type: 'post',
                url: '{{route('registrolicenciaturas')}}',
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

        function mostrarsemestre(val) {
            var selecte = document.getElementById('semestre');
            $.ajax({
                type: 'post',
                url: '{{route('registrosemestres')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    licenciatura: val
                },
                success: function (response) {
                    var cosas = response.html;
                    selecte.innerHTML = cosas;
                    $("#semestre").trigger('contentChanged');
                }
            });
        }
    </script>
@endsection