@extends('templates.static')
@section('body')
    <div class="row">
        <br>
        <br>
        <br>
        <div class="row padre">
            <div class="row col s12 m6">
                <div class="row col s12 m12" style="display: inline-block">
                    <form class=" white-text" method="post" id="Formulario" name="Formulario">
                        <h4 class="center-align">Nuevo usuario</h4>
                        <section><p><br></p></section>
                        <div class="row ">
                            <div class="input-field col s12 m6">
                                <input  id="Nombre" type="text"  name="Nombre" required>
                                <label for="Nombre">Nombre</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="Apellido" type="text"  name="Apellido" required>
                                <label for="Apellido">Apellido</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <select>
                                    <option value="" disabled selected>Seleccione su facultad</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                                <label class="white-text">Facultad</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <select>
                                    <option value="" selected disabled>Seleccione una licenciatura</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                                <label class="white-text">Licenciatura</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="semestre" type="number"  min="1" max="12" name="Semestre" required>
                                <label for="semestre">Semestre</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="Matricula" type="number"  name="Matricula" min="11111" required>
                                <label for="Matricula">Matricula</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="correo" type="email" name="correo" required>
                                <label for="Matricula">Correo institucional</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="passwords" type="password" name="passwords" required>
                                <label for="passwords">Contraseña</label>
                            </div>
                            <div class="row center">
                                <button type="submit" name="btn_login"  class=" black-text light-blue accent-1 btn boton">Registrarse</button>
                                <p></p>
                                <a style="color: #bbdefb" href="{{route('login')}}">¿Ya se encuentra registrado?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection