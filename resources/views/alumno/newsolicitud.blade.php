@extends('templates.alumno')
@section('main')
    <div class="section">
        <div class="row" style="background-color: transparent" id="SolicitudAdd">
            <form class="col s12" method="post"  id="solicitudAs" action="{{url('alumno/ready')}}">
                {{ csrf_field() }}
                <div class="col s12 m12">
                    <div align="center">
                        <div class="row">
                            <div class="col s12 m12">
                                <div class="row center ">
                                    <div class=" col s12 m9">
                                        <blockquote>
                                            <h4 class="left-align thin white-text">Nueva Solicitud</h4>
                                        </blockquote>
                                    </div>
                                    <div class="col s12 m3 padre">
                                        <a href="" class="right-align white-text" style="position:relative;">VER HISTORIAL</a>
                                    </div>
                                </div>
                                <div style="margin-top: 50px">
                                    <div class="row col s12 m6">
                                        <div class="input-field col s12 m12 white-text">
                                            <select id="UnidadA" name="UnidadA" >
                                                <option value="" readonly selected="selected">Seleccione una unidad de aprendizaje</option>
                                                <option value="asda">unidad x</option>
                                            </select>
                                            <label class="white-text">Unidad de Aprendizaje</label>
                                        </div>
                                        <div class="input-field col s12 m12 white-text">
                                            <select id="Asesores" name="Asesores" required>
                                                <option value="" selected="selected">Seleccione un asesor</option>
                                                <option value="asesor1">asesor1</option>
                                            </select>
                                            <label class="white-text">Asesor</label>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12 m6">
                                                <input class="white-text" type="date" name="fecha" id="fecha"
                                                       min="<?php echo(date('o-m-d')) ?>" max="2099-12-31" step="any"
                                                       required/>
                                                <label for="fecha" class="white-text active">Fecha de Asesoría</label>
                                            </div>
                                            <div class="input-field col s12 m6">
                                                <label for="hora" class="white-text active">Horario</label>
                                                <select class="white-text" id="selectHoras" name="selectHoras" required>
                                                    <option value="" selected="selected">Horario</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col s12 m6" >
                                        <div class="row col s12 m6" >
                                            <label><h6 class="white-text left-align">Tipo de Asesoría</h6></label>
                                            <p>
                                                <input class="white-text" name="TAsesoria" type="radio" id="T1"
                                                       onchange="ValidarTipo(this)" checked value="Individual"/>
                                                <label class="white-text" for="T1">Individual</label>
                                            </p>
                                            <p>
                                                <input class="white-text" name="TAsesoria" type="radio" id="T2"
                                                       onchange="ValidarTipo(this)" value="Grupal"/>
                                                <label class="white-text" for="T2">Grupal</label>
                                            </p>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <div id="grupal" style="display: none">
                                                <input class="white-text" type="text" id="varios" name="varios"/>
                                                <label class="active white-text" for="varios">Matriculas</label>
                                            </div>
                                        </div>
                                        <div class="input-field col s12 m12">
                                            <input class="white-text" type="text" name="textema" id="textema" required>
                                            <label class="white-text" for="textema">Tema</label>
                                        </div>

                                    </div>

                                </div>

                                <div class="row col s12 m12" style="display: inline-flex">
                                    <div class="row col s12 m6" >

                                        <br>
                                        <label><h6 class="white-text center-align">Seleccione el periodo actual</h6></label>
                                        <div class="row center-align" style="display: inline-block">
                                            <p>
                                                <input class="white-text" name="Periodo" type="radio" id="P1" value="Primer Parcial"/>
                                                <label class="white-text" for="P1">Primer Parcial</label>
                                            </p>
                                            <p>
                                                <input class="white-text" name="Periodo" type="radio" id="P2" value="Segundo Parcial"/>
                                                <label class="white-text" for="P2">Segundo Parcial</label>
                                            </p>
                                            <p>
                                                <input class="white-text" name="Periodo" type="radio" id="P3" value="Ordinario"/>
                                                <label class="white-text" for="P3">Ordinario</label>
                                            </p>
                                            <p>
                                                <input class="white-text" name="Periodo" type="radio" id="P4" value="Extraordinario"/>
                                                <label class="white-text" for="P4">Extraordinario</label>
                                            </p>
                                            <p>
                                                <input class="white-text" name="Periodo" type="radio" id="P5" value="Competencia"/>
                                                <label class="white-text" for="P5">Competencia</label>
                                            </p>
                                        </div>

                                    </div>
                                    <div class="row col s12 m6" >
                                        <br>
                                        <label><h6 class="white-text center-align">¿Requiere apoyo?</h6></label>
                                        <div class="row center-align" style="display: inline-block">
                                            <p>
                                                <input class="white-text" name="Apoyo" type="radio" value="Ninguno" id="Ap0" checked/>
                                                <label class="white-text" for="Ap0">Ninguno</label>
                                            </p>
                                            <p>
                                                <input class="white-text" name="Apoyo" type="radio" value="Tutor" id="Ap1"/>
                                                <label class="white-text" for="Ap1">Tutor</label>
                                            </p>
                                            <p>
                                                <input class="white-text" name="Apoyo" type="radio" value="Coordinador de PE" id="Ap2"/>
                                                <label class="white-text" for="Ap2">Coordinador de PE</label>
                                            </p>
                                            <p>
                                                <input class="white-text" name="Apoyo" type="radio" value="Coordinador General" id="Ap3"/>
                                                <label class="white-text" for="Ap3">Coordinador General</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m12 white-text">
                                    <h6 class="center-align">* Todas las asesorías tienen una duración de 30 minutos.</h6>
                                </div>
                                <div class="row col s12 m12">
                                    <button type="submit" name="btn_login"  class=" black-text light-blue accent-1 btn boton">Generar solicitud</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <script>
        function ValidarTipo(tipo) {
            var valor = tipo.getAttribute('value');
            var divoculto = document.getElementById('grupal');
            if (valor == 'Grupal') {
                divoculto.style.display = 'block';

            }
            if (valor == 'Individual') {
                divoculto.style.display = 'none';
            }
        }
    </script>

@endsection