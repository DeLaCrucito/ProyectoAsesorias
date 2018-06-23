@extends('templates.alumno')
@section('main')
    <div class="section">
        <div class="row" style="background-color: transparent" id="SolicitudAdd">
            <form class="col s12" method="post" action="{{url('alumno/confirm')}}">
                {{ csrf_field() }}
                <div class="col s12 m12">
                    <div align="center">
                        <div class="row">
                            <div class="col s12 m12">
                                <div class="row center ">
                                    <div class="row col s12 m9">
                                        <blockquote>
                                            <h4 class="left-align thin white-text">Confirmación</h4>
                                        </blockquote>
                                    </div>
                                </div>
                                <div style="margin-top: 50px">
                                    <div class="row col s12 m6">
                                        <div class="row col s12 m12">
                                            <div class="input-field col s12 m9">
                                                <input type="text" disabled name="Nombre" id="Nombre" value="Nombre Completo" class="white-text"/>
                                                <label class="white-text" for="Nombre">Alumno</label>
                                            </div>
                                            <div class="input-field col s12 m3">
                                                <input class="white-text" type="text" id="Matricula" disabled value="Matricula" name="Matricula">
                                                <label class="white-text" for="Matricula">Matricula</label>
                                            </div>
                                            <div class="input-field col s12 m12">
                                                <input class="white-text" type="text" id="licenciatura" disabled value="Licenciatura" name="licenciatura">
                                                <label class="white-text" for="licenciatura">Licenciatura</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col s12 m6 ">
                                        <div class="row col s12 m12">
                                            <div class="input-field col s12 m12">
                                                <input class="white-text" type="text" id="unidad_aprendizaje" disabled value="Unidad de Aprendizaje" name="unidad_aprendizaje">
                                                <label class="white-text" for="unidad_aprendizaje">Unidad de aprendizaje</label>
                                            </div>
                                            <div class="input-field col s12 m6">
                                                <input class="white-text" type="text" id="periodo" disabled value="Fase año - n" name="periodo">
                                                <label class="white-text" for="periodo">Cliclo Escolar</label>
                                            </div>
                                            <div class="input-field col s12 m6">
                                                <input class="white-text" type="text" id="semestre" disabled value="Semestre" name="semestre">
                                                <label class="white-text" for="semestre">Semestre</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col s12 m6">
                                        <div class="row col s12 m12">
                                            <div class="input-field col s12 m12">
                                                <input class="white-text" type="text" id="Asesor" disabled value="Asesor" name="Asesor">
                                                <label class="white-text" for="Asesor">Asesor</label>
                                            </div>
                                            <div class="input-field col s12 m8">
                                                <input class="white-text" type="text" id="Lugar" disabled value="Lugar" name="Lugar">
                                                <label class="white-text" for="Lugar">Lugar de asesoría</label>
                                            </div>
                                            <div class="input-field col s12 m4">
                                                <input class="white-text" type="text" id="tipo_asesor" disabled value="Tipo de Asesor" name="tipo_asesor">
                                                <label class="white-text" for="tipo_asesor">Tipo de asesor</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col s12 m6 ">
                                        <div class="row col s12 m12">
                                            <div class="input-field col s12 m12">
                                                <input class="white-text" type="text" id="tipo_asesoria" disabled value="Tipo de asesoría" name="tipo_asesoria">
                                                <label class="white-text" for="tipo_asesoria">Tipo de asesoría</label>
                                            </div>
                                            <div class="input-field col s12 m8">
                                                <input class="white-text" type="text" id="fecha" disabled value="fecha" name="fecha">
                                                <label class="white-text" for="fecha">Fecha de asesoría</label>
                                            </div>
                                            <div class="input-field col s12 m4">
                                                <input class="white-text" type="text" id="hora" disabled value="hora" name="hora">
                                                <label class="white-text" for="hora">Hora</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row col s12 m12">
                                    <div class="row col s12 m12" style="display: inline-flex">
                                        <div class="row col s12 m6" >
                                            <div class="input-field">
                                                <input class="white-text" type="text" id="apoyo" name="apoyo" disabled value="apoyo">
                                                <label class="white-text" for="apoyo">Apoyo en la solicitud</label>
                                            </div>
                                            <div class="input-field">
                                                <input class="white-text" type="text" id="otros" name="otros" disabled value="matriculas">
                                                <label class="white-text" for="otros">Compañeros</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row col s12 m12">
                                    <div style="display: inline-flex">
                                        <input type="checkbox" onclick="Validacaja(this)" class="filled-in" id="validar"/>
                                        <label class="white-text" for="validar">Los datos son correctos</label>
                                    </div>
                                    <p></p>
                                    <button type="submit" name="finalizar" id="finalizar" class="disabled black-text light-blue accent-1 btn boton">Finalizar</button>
                                    <p></p>
                                    <a name="cancel" id="cancel" class="white-text red darken-1 btn boton">Cancelar</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function Validacaja(caja) {
            var finalizar = document.getElementById('finalizar');
            finalizar.getAttribute('class');
            if (caja.checked === true){
                finalizar.setAttribute('class','black-text light-blue accent-1 btn boton');
            }else if(caja.checked === false){
                finalizar.setAttribute('class','disabled black-text light-blue accent-1 btn boton');
            }
        }
    </script>
@endsection