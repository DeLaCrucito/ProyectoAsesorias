@extends('templates.alumno')
@section('main')

    <div class="section">
        <div class="row" style="background-color: transparent" id="SolicitudAdd">
            <form class="col s12" method="post" >
                {{ csrf_field() }}
                <div class="col s12 m12">
                    <div align="center">
                        <div class="row">
                            <div class="col s12 m12">
                                <div class="row center ">
                                    <div class="row col s12 m9">
                                        <blockquote>
                                            <h4 class="left-align thin white-text">Asesoría programada.</h4>
                                            <h5 class="left-align thin white-text">Folio: {{ $datos['folio'] }}</h5>
                                        </blockquote>
                                    </div>
                                </div>
                                <div style="margin-top: 50px">
                                    <div class="row col s12 m6">
                                        <div class="row col s12 m12">
                                            <div class="input-field col s12 m12">
                                                <input type="text" disabled name="Nombre" id="Nombre"
                                                       value="{{ $student->nombre .' '. $student->apellido }}"
                                                       class="white-text"/>
                                                <label class="white-text" for="Nombre">Alumno</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col s12 m6 ">
                                        <div class="row col s12 m12">
                                            <div class="input-field col s12 m12">
                                                <input class="white-text" type="text" id="unidad_aprendizaje"
                                                       disabled  value="{{ $subject->nombre }}"
                                                       name="unidad_aprendizaje">
                                                <label class="white-text" for="unidad_aprendizaje">Unidad de aprendizaje</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row col s12 m6">
                                        <div class="row col s12 m12">
                                            <div class="input-field col s12 12">
                                                <input class="white-text" type="text" id="Asesor" disabled
                                                       value="{{ $consultant->nombre .' '. $consultant->apellido }}"
                                                       name="Asesor">
                                                <label class="white-text" for="Asesor">Asesor</label>
                                            </div>
                                            <div class="input-field col s12 m12">
                                                <input class="white-text" type="text" id="Lugar" disabled
                                                       value="{{ $consultant->lugar }}" name="Lugar">
                                                <label class="white-text" for="Lugar">Lugar de asesoría</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col s12 m6 ">
                                        <div class="row col s12 m12">

                                            <div class="input-field col s12 m8">
                                                <input class="white-text" type="text" id="fecha" disabled
                                                       value="{{ $datos['fecha'] }}"
                                                       name="fecha">
                                                <label class="white-text" for="fecha">Fecha de asesoría</label>
                                            </div>
                                            <div class="input-field col s12 m4">
                                                <input class="white-text" type="text" id="hora" disabled
                                                       value="{{ $datos['hora'] }}" name="hora">
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
                                        sesión</a> <br>
                                    {{--<a target="_blank"
                                       href="{{ route('pdfsolicitud',$infopdf) }}"
                                       class="white-text red darken-1 btn
                                     boton">Imprimir</a>--}}
                                    <a target="_blank"
                                       id="autoimprime"
                                       name="autoimprime"
                                       href="{{ route('pdfautogenerate',$infopdf) }}"
                                       class="oculto white-text red darken-1 btn
                                     boton">Imprimir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            setTimeout(function () {
                document.getElementById("autoimprime").click();
                console.log('se abre');
            }, 2000);
        });
    </script>
@endsection