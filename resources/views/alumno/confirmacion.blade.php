@extends('alumno.base')
@section('elementos')

    <form class="col s12" method="post" action="{{route('generasolicitud', $data) }}">
        {{ csrf_field() }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                                    <input type="text" disabled name="Nombre" id="Nombre" value="{{
                                    $student->nombre . ' ' . $student->apellido
                                    }}"
                                           class="white-text"/>
                                    <label class="white-text" for="Nombre">Alumno</label>
                                </div>
                                <div class="input-field col s12 m3">
                                    <input class="white-text" type="text" id="Matricula" disabled
                                           value="{{ $student->matricula }}" name="Matricula">
                                    <label class="white-text" for="Matricula">Matricula</label>
                                </div>
                                <div class="input-field col s12 m12">
                                    <input class="white-text" type="text" id="licenciatura" disabled
                                           value="{{ $student->degree->nombre }}" name="licenciatura">
                                    <label class="white-text" for="licenciatura">Licenciatura</label>
                                </div>
                            </div>
                        </div>
                        <div class="row col s12 m6 ">
                            <div class="row col s12 m12">
                                <div class="input-field col s12 m12">
                                    <input class="white-text" type="text" id="unidad_aprendizaje"
                                           disabled value="{{ $subject->nombre }}"
                                           name="unidad_aprendizaje">
                                    <label class="white-text" for="unidad_aprendizaje">Unidad de aprendizaje</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <input class="white-text" type="text"  id="ciclo" disabled
                                           value="Fase <?php echo (date('Y')) ?> - {{ $subject->fase }}"
                                           name="ciclo">
                                    <label class="white-text" for="ciclo">Cliclo Escolar</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <input class="white-text" type="text" id="Periodo" disabled
                                           value="{{ $datos['periodo'] }}" name="Periodo">
                                    <label class="white-text" for="Periodo">Periodo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row col s12 m6">
                            <div class="row col s12 m12">
                                <div class="input-field col s12 m12">
                                    <input class="white-text" type="text" id="Asesor" disabled
                                           value="{{ $consultant->nombre .' '. $consultant->apellido }}"
                                           name="Asesor">
                                    <label class="white-text" for="Asesor">Asesor</label>
                                </div>
                                <div class="input-field col s12 m8">
                                    <input class="white-text" type="text" id="Lugar" disabled value="{{
                                    $consultant->lugar
                                     }}"
                                           name="Lugar">
                                    <label class="white-text" for="Lugar">Lugar de asesoría</label>
                                </div>
                                <div class="input-field col s12 m4">
                                    <input class="white-text" type="text" id="tipo_asesoria" disabled
                                           value="{{ $datos['tipo'] }}" name="tipo_asesoria">
                                    <label class="white-text" for="tipo_asesoria">Tipo de asesoría</label>
                                </div>
                            </div>
                        </div>
                        <div class="row col s12 m6 ">
                            <div class="row col s12 m12">

                                <div class="input-field col s12 m8">
                                    <input class="white-text" type="text" id="fecha" disabled value="{{
                                    $datos['fecha'] }}" name="fecha">
                                    <label class="white-text" for="fecha">Fecha de asesoría</label>
                                </div>
                                <div class="input-field col s12 m4">
                                    <input class="white-text" type="text" id="hora" disabled value="{{
                                    $datos['hora'] }}" name="hora">
                                    <label class="white-text" for="hora">Hora</label>
                                </div>
                                <div class="input-field col s12 m12">
                                    <input class="white-text" type="text" id="apoyo" name="apoyo"
                                           disabled value="{{ $datos['tema'] }}">
                                    <label class="white-text" for="apoyo">Tema</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col s12 m12">
                        <div class="row col s12 m12" style="display: inline-flex">
                            <div class="row col s12 m6" >
                                <div class="input-field col s12 m12">
                                    <input class="white-text" type="text" id="apoyo" name="apoyo"
                                           disabled value="{{ $datos['apoyo'] }}">
                                    <label class="white-text" for="apoyo">Apoyo en la solicitud</label>
                                </div>
                                @if($datos['tipo'] != 'Individual')
                                    <h5 class="white-text thin">Compañeros</h5>
                                    <div class="input-field col s12 m9">
                                        <input type="text" disabled name="Nombre" id="Nombre" value="{{
                                    $companero1->nombre . ' ' . $companero1->apellido
                                    }}"
                                               class="white-text"/>
                                        <label class="white-text" for="Nombre">Nombre</label>
                                    </div>
                                    <div class="input-field col s12 m3">
                                        <input class="white-text" type="text" id="Matricula" disabled
                                               value="{{ $companero1->matricula }}" name="Matricula">
                                        <label class="white-text" for="Matricula">Matricula</label>
                                    </div>
                                    @if($datos['compas'] != 1 )
                                        <div class="input-field col s12 m9">
                                            <input type="text" disabled name="Nombre" id="Nombre" value="{{
                                                $companero2->nombre . ' ' . $companero2->apellido  }}"
                                                   class="white-text"/>
                                            <label class="white-text" for="Nombre">Nombre</label>
                                        </div>
                                        <div class="input-field col s12 m3">
                                            <input class="white-text" type="text" id="Matricula" disabled
                                                   value="{{ $companero2->matricula }}" name="Matricula">
                                            <label class="white-text" for="Matricula">Matricula</label>
                                        </div>
                                    @endif
                                @endif
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
    </form>
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