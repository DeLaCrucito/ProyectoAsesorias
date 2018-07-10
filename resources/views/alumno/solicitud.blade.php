@extends('alumno.base')
@section('elementos')
    <form class="col s12" method="post" action="{{ route('updateestado', ['id' => encrypt($solicitud->id)]) }}">
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
                                       value="{{ $solicitud->consultant->nombre .' '. $solicitud->consultant->apellido}}"
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
                                       value="{{ $solicitud->fecha->format('l, d F Y') }}"
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
                @if(session()->has('message'))
                    <div class="green darken-1 white-text col s12 m12 center-align" style="border-radius: 25px">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if($solicitud->estado === 4)
                    @if ($errors->any())
                        <div class="red darken-1 white-text center-align" style="border-radius: 25px">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row col s12 m12" >
                        <label><h6 class="white-text center-align">¿La asesoría fue completada con éxito?</h6></label>
                        <div class="row center-align" style="display: inline-block">
                            <p>
                                <input class="white-text" name="check" type="radio" value="1" id="Ap0"/>
                                <label class="white-text" for="Ap0">Si</label>
                            </p>
                            <p>
                                <input class="white-text" name="check" type="radio" value="0" id="Ap1"/>
                                <label class="white-text" for="Ap1">No</label>
                            </p>
                        </div>
                    </div>
                    <div class="row col s12 m12">
                        <div style="display: inline-flex">
                            <input type="checkbox" onclick="Validacaja(this)" class="filled-in" id="validar"/>
                            <label class="white-text" for="validar">Acepto que los cambios son correctos</label>
                        </div>
                        <p></p>
                        <button type="submit" name="save" id="save" class="disabled black-text light-blue
                        accent-1 btn boton">Guardar</button>
                    </div>
                @endif
                <div class="row col s12 m12">
                    <a target="_blank"
                       href="{{ route('pdfsolicitud', encrypt($solicitud->id)) }}"
                       class="white-text pink darken-1 btn
                                     boton">Imprimir</a>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        function Validacaja(caja) {
            var finalizar = document.getElementById('save');
            finalizar.getAttribute('class');
            if (caja.checked === true){
                finalizar.setAttribute('class','black-text light-blue accent-1 btn boton');
            }else if(caja.checked === false){
                finalizar.setAttribute('class','disabled black-text light-blue accent-1 btn boton');
            }
        }
    </script>
@endsection