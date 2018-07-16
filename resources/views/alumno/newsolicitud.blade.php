@extends('alumno.base')
@section('elementos')
    <form class="col s12" method="post"  id="solicitudAs" action="{{ route('confirmarsoli') }}">
        {{ csrf_field() }}
            <div class="row">
                <div class="col s12 m12">
                    <div class="row center ">
                        <div class=" col s12 m9">
                            <blockquote>
                                <h4 class="left-align thin white-text">Nueva Solicitud</h4>
                            </blockquote>
                        </div>
                    </div>
                    <div style="margin-top: 50px">
                        @if ($errors->any())
                            <div class="red darken-1 white-text center-align" style="border-radius: 25px">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            @if(session()->has('message'))
                                <div class="red darken-1 white-text col s12 m12 center-align" style="border-radius: 25px">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                        <div class="row col s12 m6">
                            <div class="input-field col s12 m12 white-text">
                                <select id="semestre" onchange="selectUnidades(this.value)" name="semestre" >
                                    <option value="" disabled selected="selected">Seleccione el semestre de la unidad de aprendizaje</option>
                                    @foreach(range(1,$student->degree->semestres) as $semestre)
                                        <option value="{{ $semestre }}">{{ $semestre }}</option>
                                    @endforeach
                                </select>
                                <label class="white-text">Semestre de la Unidad de Aprendizaje</label>
                            </div>
                            <div class="input-field col s12 m12 white-text">
                                <select id="unidad" onchange="selectAsesor(this.value)" name="unidad" >
                                    <option value="" disabled selected="selected">Seleccione un semestre</option>
                                </select>
                                <label class="white-text" for="unidad">Unidad de Aprendizaje</label>
                            </div>
                            <div class="input-field col s12 m12 white-text">
                                <select id="asesor" name="asesor">
                                    <option value="" disabled selected="selected">Seleccione una unidad de aprendizaje</option>
                                </select>
                                <label class="white-text">Asesor</label>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <input class="white-text datepicker" type="date" onchange="selectHorario(this
                                    .value)" name="fecha" id="fecha" required placeholder="Seleccione una fecha" />
                                    <label for="fecha" class="white-text active">Fecha de Asesoría</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <label for="hora" class="white-text active">Horario</label>
                                    <select class="white-text" id="hora" name="hora">
                                        <option value="" selected="selected">Seleccione una fecha</option>
                                    </select>
                                </div>
                                <p class="white-text">* El horario seleccionado no estará disponible durante 5 min.</p>
                            </div>
                        </div>
                        <div class="row col s12 m6" >
                            <div class="row col s12 m4" >
                                <label><h6 class="white-text left-align">Tipo de Asesoría</h6></label>
                                <p>
                                    <input class="white-text" name="tipo" type="radio" id="T1"
                                           onchange="ValidarTipo(this)" checked value="Individual"/>
                                    <label class="white-text" for="T1">Individual</label>
                                </p>
                                <p>
                                    <input class="white-text" name="tipo" type="radio" id="T2"
                                           onchange="ValidarTipo(this)" value="Grupal"/>
                                    <label class="white-text" for="T2">Grupal</label>
                                </p>
                            </div>
                            <div class="input-field col s12 m8">
                                <input class="white-text " type="text" name="textema" id="textema" required>
                                <label class="white-text" for="textema">Tema</label>
                            </div>
                            <div class="input-field col s12 m12 oculto">
                                <div id="grupal" >
                                    <p class="white-text">Introduce las matriculas de tus compañeros, puedes
                                        generar una solicitud con un máximo de hasta dos compañeros.</p><br>
                                    <div class="input-field col s12 m6">
                                        <input class="white-text" type="number" min="11111" max="99999"
                                               placeholder="Matricula" id="compa1"
                                               name="compa1"/>
                                        <label class=" white-text" for="compa1">Compañero 1</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input class="white-text" placeholder="Matricula"
                                               type="number" min="11111" max="99999" id="compa2"
                                               name="compa2"/>
                                        <label class=" white-text" for="compa2">Compañero 2</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col s12 m12" style="display: inline-flex">
                        <div class="row col s12 m6" >

                            <br>
                            <label><h6 class="white-text center-align">Seleccione el periodo actual</h6></label>
                            <div class="row center-align" style="display: inline-block">
                                <p>
                                    <input class="white-text" name="periodo" type="radio" id="P1" value="Primer Parcial"/>
                                    <label class="white-text" for="P1">Primer Parcial</label>
                                </p>
                                <p>
                                    <input class="white-text" name="periodo" type="radio" id="P2" value="Segundo Parcial"/>
                                    <label class="white-text" for="P2">Segundo Parcial</label>
                                </p>
                                <p>
                                    <input class="white-text" name="periodo" type="radio" id="P3" value="Ordinario"/>
                                    <label class="white-text" for="P3">Ordinario</label>
                                </p>
                                <p>
                                    <input class="white-text" name="periodo" type="radio" id="P4" value="Extraordinario"/>
                                    <label class="white-text" for="P4">Extraordinario</label>
                                </p>
                                <p>
                                    <input class="white-text" name="periodo" type="radio" id="P5" value="Competencia"/>
                                    <label class="white-text" for="P5">Competencia</label>
                                </p>
                            </div>

                        </div>
                        <div class="row col s12 m6" >
                            <br>
                            <label><h6 class="white-text center-align">¿Requiere apoyo?</h6></label>
                            <div class="row center-align" style="display: inline-block">
                                <p>
                                    <input class="white-text" name="apoyo" type="radio" value="Ninguno" id="Ap0"
                                           checked/>
                                    <label class="white-text" for="Ap0">Ninguno</label>
                                </p>
                                <p>
                                    <input class="white-text" name="apoyo" type="radio" value="Tutor" id="Ap1"/>
                                    <label class="white-text" for="Ap1">Tutor</label>
                                </p>
                                <p>
                                    <input class="white-text" name="apoyo" type="radio" value="Coordinador de PE" id="Ap2"/>
                                    <label class="white-text" for="Ap2">Coordinador de PE</label>
                                </p>
                                <p>
                                    <input class="white-text" name="apoyo" type="radio" value="Coordinador General" id="Ap3"/>
                                    <label class="white-text" for="Ap3">Coordinador General</label>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m12 white-text">
                        <h6 class="center-align">* Todas las asesorías tienen una duración de 30 minutos.</h6>
                    </div>
                    <input type="hidden" name="UnidadA">
                    <div class="row col s12 m12 center-align">
                        <button type="submit" name="btn_login"  class=" black-text light-blue accent-1 btn
                        boton">Generar solicitud</button>
                    </div>
                </div>
            </div>
    </form>
    <script>
        function ValidarTipo(tipo) {
            var valor = tipo.getAttribute('value');
            var divoculto = document.getElementsByClassName("oculto");;
            if (valor == 'Grupal') {
                MostrarOcultos();
            }
            if (valor == 'Individual') {
                $(divoculto).css('display','none');
            }
        }

        function selectUnidades(val) {
            var selecte = document.getElementById('unidad');
            $.ajax({
                type: 'post',
                url: '{{route('aluselectunidad')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    semestre: val
                },
                success: function (response) {
                    var cosas = response.html;
                    selecte.innerHTML = cosas;
                    $("#unidad").trigger('contentChanged');
                }
            });
        }

        function selectAsesor(val) {
            var selecte = document.getElementById('asesor');
            $.ajax({
                type: 'post',
                url: '{{route('aluselectasesor')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    materia: val
                },
                success: function (response) {
                    var cosas = response.html;
                    selecte.innerHTML = cosas;
                    $("#asesor").trigger('contentChanged');
                }
            });
        }

        function selectHorario(val) {
            var asesor = document.getElementById('asesor').value;
            var selecte = document.getElementById('hora');
            $.ajax({
                type: 'post',
                url: '{{route('showhorario')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    fecha: val,
                    asesor : asesor
                },
                success: function (response) {
                    var cosas = response.html;
                    selecte.innerHTML = cosas;
                    $("#hora").trigger('contentChanged');
                }
            });
        }
    </script>
@endsection
@section('scripts')
    <script>
        $('.datepicker').pickadate({
            selectMonths: true,
            today:false,
            clear: false,
            closeOnSelect: true,
            format: 'yyyy-mm-dd',
            close: false,
            min: "{{ \Carbon\Carbon::tomorrow()->format('Y,m,d') }}",
            disable: [
                @foreach($fechas as $date)
                {{  '('.$date->format('Y,m,d').')' }} ,
                @endforeach
            ]

        });

    </script>
@endsection