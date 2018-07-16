@extends('alumno.base')
@section('elementos')
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
                            @if(session()->has('message'))
                                <div class="red darken-4 white-text col s12 m12 center-align" style="border-radius: 25px">
                                    <h5>{{ session()->get('message') }}</h5>
                                </div><br>
                            @endif
                            <div class="center-align" style="margin-top: 50px">
                                <div class="row col s12 m12">
                                    <div class="input-field col s12 m9">
                                        <input type="text" disabled name="Nombre" id="Nombre" value="{{
                                        $student->nombre }}"
                                               class="white-text"/>
                                        <label class="white-text" for="Nombre">Nombre</label>
                                    </div>
                                    <div class="input-field col s12 m3">
                                        <input class="white-text" type="text" id="Matricula" disabled value="{{
                                        $student->matricula }}"
                                               name="Matricula">
                                        <label class="white-text" for="Matricula">Matricula</label>
                                    </div>
                                    <div class="input-field col s12 m12">
                                        <input class="white-text" type="text" id="licenciatura" disabled value="{{
                                        $student->degree->nombre
                                        }}"
                                               name="licenciatura">
                                        <label class="white-text" for="licenciatura">Licenciatura</label>
                                    </div>
                                    <div class="input-field col s12 m2">
                                        <input class="white-text" type="text" id="semestre" disabled value="{{
                                        $student->semestre
                                         }}"
                                               name="semestre">
                                        <label class="white-text" for="semestre">Semestre</label>
                                    </div>
                                    <div class="input-field col s12 m10">
                                        <input class="white-text" type="text" id="correo" disabled value="{{
                                        $student->correo }}"
                                               name="correo">
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