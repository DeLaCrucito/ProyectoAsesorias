<<<<<<< HEAD
@extends('alumno.base')
@section('elementos')
    <form class="col s12" method="post" >
        {{ csrf_field() }}
        <div class="row">
            <div class="col s12 m12">
                <div class="row center ">
                    <div class="row col s12 m9">
                        <blockquote>
                            <h4 class="left-align thin white-text">Detalles de la solicitud.</h4>
                            <h5 class="left-align thin white-text">Folio: {{ $solicitud->folio }}</h5>
                        </blockquote>
                    </div>
                </div>
                <div style="margin-top: 50px">
                    <div class="row col s12 m6">
                        <div class="row col s12 m12">
                            <div class="input-field col s12 m12">
                                <input type="text" disabled name="Nombre" id="Nombre"
                                       value="{{ $solicitud->student->nombre .' '. $solicitud->student->apellido }}"
                                       class="white-text"/>
                                <label class="white-text" for="Nombre">Alumno</label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input class="white-text" type="text" id="Matricula" disabled
                                       value="{{ $solicitud->student->matricula }}" name="Matricula">
                                <label class="white-text" for="Matricula">Matricula</label>
                            </div>
                            <div class="input-field col s12 m9">
                                <input class="white-text" type="text" id="licenciatura" disabled
                                       value="{{ $solicitud->student->degree->nombre }}" name="licenciatura">
                                <label class="white-text" for="licenciatura">Licenciatura</label>
                            </div>
                        </div>
                    </div>
                    <div class="row col s12 m6 ">
                        <div class="row col s12 m12">
                            <div class="input-field col s12 m12">
                                <input class="white-text" type="text" id="unidad_aprendizaje"
                                       disabled  value="{{ $solicitud->subject->nombre }}"
                                       name="unidad_aprendizaje">
                                <label class="white-text" for="unidad_aprendizaje">Unidad de aprendizaje</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input class="white-text" type="text"  id="ciclo" disabled
                                       value="Fase <?php echo (date('Y')) ?> - {{ $solicitud->subject->fase }}"
                                       name="ciclo">
                                <label class="white-text" for="ciclo">Cliclo Escolar</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input class="white-text" type="text" id="Periodo" disabled
                                       value="{{ $solicitud->periodo }}" name="Periodo">
                                <label class="white-text" for="Periodo">Periodo</label>
                            </div>
                        </div>
                    </div>
                    <div class="row col s12 m6">
                        <div class="row col s12 m12">
                            <div class="input-field col s12 12">
                                <input class="white-text" type="text" id="Asesor" disabled
                                       value="{{ $solicitud->consultant->nombre .' '. $solicitud->consultant->apellido
                                        }}"
                                       name="Asesor">
                                <label class="white-text" for="Asesor">Asesor</label>
                            </div>
                            <div class="input-field col s12 m12">
                                <input class="white-text" type="text" id="Lugar" disabled
                                       value="{{ $solicitud->consultant->lugar }}" name="Lugar">
                                <label class="white-text" for="Lugar">Lugar de asesoría</label>
                            </div>
                        </div>
                    </div>
                    <div class="row col s12 m6 ">
                        <div class="row col s12 m12">

                            <div class="input-field col s12 m8">
                                <input class="white-text" type="text" id="fecha" disabled
                                       value="{{ $solicitud->fecha->format('D, d M Y') }}"
                                       name="fecha">
                                <label class="white-text" for="fecha">Fecha de asesoría</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <input class="white-text" type="text" id="hora" disabled
                                       value="{{ $solicitud->fecha->format('h:i A') }}" name="hora">
                                <label class="white-text" for="hora">Hora</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 white-text">
                    <h6 class="center-align">* Los detalles de la solicitud han sido enviados a su correo institucional.</h6>
                </div>
                <div class="row col s12 m12">
                    <p></p>
                    <button type="submit" name="historial" href="{{ route('viewhistory') }}" id="historial"
                            class="black-text
                    light-blue accent-1 btn boton">Ver historial</button>
                    <p></p>
                    <a name="cierras" id="cierras" href="#signout" class="white-text red darken-1 btn
                     boton modal-trigger">Cerrar
                        sesión</a>
                </div>
            </div>
        </div>
    </form>
@endsection