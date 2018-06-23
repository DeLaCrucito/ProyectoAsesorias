@extends('templates.admin')
@section('main')
    <div class="section">
        <div class="row" style="background-color: transparent" id="SolicitudAdd">
            {{ csrf_field() }}
            <div class="col s12 m12">
                <div align="center">
                    <div class="row">
                        <div class="col s12 m12">
                            <div class="row center ">
                                <div class=" col s12 m9">
                                    <blockquote>
                                        <h4 class="left-align thin white-text">Bienvenido</h4>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="center-align" style="margin-top: 50px">
                                <div class="row col s12 m12">
                                    <div class="input-field col s12 m9">
                                        <input type="text" disabled name="Nombre" id="Nombre" value="Nombre Completo" class="white-text"/>
                                        <label class="white-text" for="Nombre">Nombre</label>
                                    </div>
                                    <div class="input-field col s12 m3">
                                        <input class="white-text" type="text" id="Matricula" disabled value="Matricula" name="Matricula">
                                        <label class="white-text" for="Matricula">Matricula</label>
                                    </div>
                                    <div class="input-field col s12 m12">
                                        <input class="white-text" type="text" id="licenciatura" disabled value="Licenciatura" name="licenciatura">
                                        <label class="white-text" for="licenciatura">Licenciatura</label>
                                    </div>
                                    <div class="input-field col s12 m2">
                                        <input class="white-text" type="text" id="semestre" disabled value="Semestre" name="semestre">
                                        <label class="white-text" for="semestre">Semestre</label>
                                    </div>
                                    <div class="input-field col s12 m10">
                                        <input class="white-text" type="text" id="correo" disabled value="Correo" name="correo">
                                        <label class="white-text" for="correo">Correo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row col s12 m12 center">
                                <a href="{{route('nuevasolicitud')}}">
                                    <button name="solicitud" class=" black-text light-blue accent-1 btn boton">Solicitar Asesoría</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection