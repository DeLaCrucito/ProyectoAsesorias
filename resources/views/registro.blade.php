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
                                <input class="white-text" id="Nombre" type="text"  name="Nombre" placeholder="Ingresa tus nombres"
                                        required>
                                <label class="white-text" for="Nombre">Nombre</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input class="white-text" id="Apellido" type="text" placeholder="Ingresa tus apellidos" name="Apellido"
                                       required>
                                <label class="white-text" for="Apellido">Apellido</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <select class="white-text" id="facultad" name="facultad," onchange="mostrarlicenciatura
                                (this.value)">
                                    <option value="" disabled selected>Seleccione su facultad</option>
                                    @foreach($facultads as $facultad)
                                        <option value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                                    @endforeach
                                </select>
                                <label class="white-text">Facultad</label>
                            </div>
                            <div id="cajalicen" class="input-field col s12 m6 white-text">
                                <select  class="white-text" id="licen" name="licen" onchange="mostrarsemestre(this.value)" required>
                                    <option value="" disabled selected>Seleccione una licenciatura</option>
                                </select>
                                <label for="licen" class="white-text">Licenciatura</label>
                            </div>
                            <div id="oculto4" class="input-field col s12 m6 white-text">
                                <select class="white-text" id="semestre" name="semestre"  required>
                                    <option disabled selected="selected">Seleccione un semestre</option>
                                </select>
                                <label for="semestre" class="white-text">Semestre</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input class="white-text" id="Matricula" type="number" placeholder="Introduce tu matricula"
                                       name="Matricula" min="11111" required>
                                <label class="white-text" for="Matricula">Matricula</label>
                            </div>
                            <div class="input-field col s12">
                                <input class="white-text" id="correo" type="email" placeholder="Introduce tu correo institucional"
                                       name="correo" required>
                                <label class="white-text" for="Matricula">Correo institucional</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input class="white-text"  type="password" id="password" name="password"  placeholder="Ingrese su contraseña">
                                <label class="white-text" for="pass">Contraseña</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input class="white-text"  type="password" id="password_confirmation " name="password_confirmation" placeholder="Vuelva a introducir su contraseña">
                                <label class="white-text"  for="email">Confirmar contraseña</label>
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