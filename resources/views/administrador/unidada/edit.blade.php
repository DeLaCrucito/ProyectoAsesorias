@extends('administrador.base')
@section('elementos')
    <style>
        .oculto {
            display: none;
        }
    </style>
    <form class="col s12" method="post" action="{{ route('updateunidad',$subject->id) }}">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Nueva Unidad de Aprendizaje</h4>
                    </blockquote>
                </div>
            </div>
            @if(session()->has('message'))
                <div class="green darken-4 white-text col s12 m12 center-align" style="border-radius: 25px">
                    <h5>{{ session()->get('message') }}</h5>
                </div><br>
            @endif
            <div style="margin-top: 50px">
                @if ($errors->any())
                    <div class="red darken-1 white-text" style="border-radius: 25px">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    @foreach($degrees as $degree)
                        @if($degree->id === $subject->licenciatura)
                        <div class="input-field col s12 m12 white-text">
                            <select id="facultad" name="facultad" onchange="realizaProceso(this.value)" required>
                                <option disabled selected="selected">Seleccione la facultad a la que pertenece la nueva Unidad de Aprendizaje
                                </option>
                                @foreach($facultads as $facultad)
                                    <option @if ($facultad->id === $degree->facultad) selected="selected" @endif  value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                                @endforeach
                            </select>
                            <label class="white-text" for="facultad">Facultad</label>
                        </div>
                        @endif
                    @endforeach
                    <div id="cajalicen" class="input-field col s12 m6 white-text ">
                        <select id="licen" name="licen" onchange="mostrarsemestre(this.value)" required>
                            <option disabled selected>Seleccione una licenciatura</option>
                            @foreach($degrees as $degree)
                                <option @if ($subject->licenciatura === $degree->id) selected="selected"  @php($numero = $degree->semestres) @endif value="{{ $degree->id }}">{{ $degree->nombre }}</option>
                            @endforeach
                        </select>
                        <label for="licen" class="white-text">Licenciatura</label>
                    </div>
                    <div class="input-field col s12 m6 " id="oculto2">
                        <input class="white-text" type="text" name="nombre" id="nombre"
                               placeholder="Ingrese el nombre de la Unidad de Aprendizaje" value="{{ $subject->nombre }}"/>
                        <label class="white-text" for="nombre">Nombre de la unidad de aprendizaje</label>
                    </div>
                    <div id="oculto4" class="input-field col s6 m3 white-text ">
                        <select id="semestre" onchange="parimpar(this.value)" name="semestre"  required>
                            <option disabled selected="selected">Seleccione un semestre</option>
                            @foreach(range(1, $numero ) as $semestre)
                                <option @if ($subject->semestre === $semestre) selected="selected" @endif value="{{ $semestre }}">{{ $semestre }}</option>
                            @endforeach
                         </select>
                         <label for="semestre" class="white-text">Semestre</label>
                     </div>


                    <div class=" input-field row col s6 m3 " id="oculto3">
                        <input class="white-text" readonly name="fase" id="fase" value="{{ $subject->fase }}"/>
                        <label class="white-text active" for="fase">Ciclo Escolar (Fase)</label>
                    </div>

                    <div class="row col s12 m3 " id="oculto6">
                        <h6 class="white-text left-align">Tipo de asignatura</h6>
                        <p>
                            <input class="white-text" name="tipo" type="radio" id="obligatoria" @if ($subject->tipo === "Obligatoria") checked @endif  value="Obligatoria"/>
                            <label class="white-text" for="obligatoria">Obligatoria</label>
                        </p>
                        <p>
                            <input class="white-text" name="tipo" type="radio" id="optativa" @if ($subject->tipo === "Optativa") checked @endif value="Optativa"/>
                            <label class="white-text" for="optativa">Optativa</label>
                        </p>
                    </div>

                    <div class="input-field col s12 m3 " id="oculto5">
                        <input class="white-text" type="text" value="{{ $subject->clave }}" name="clave" id="clave"
                               placeholder="Ingrese la clave de la unidad"/>
                        <label class="white-text" for="clave">Clave</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row center-align">
            <div style="display: inline-flex">
                <input type="checkbox" onclick="Validacaja(this)" class="filled-in" id="validar"/>
                <label class="white-text" for="validar">Los datos son correctos</label>
            </div>
            <br>
            <button type="submit" name="guardar" id="guardar" class="disabled black-text light-blue accent-1 btn boton">Guardar</button>
            <br>
            <a name="cancel" id="cancel" href="{{ route('viewunidad') }}" class="white-text red darken-1 btn boton">Cancelar y volver</a>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        function realizaProceso(val) {
            var selecte = document.getElementById('licen');
            $.ajax({
                type: 'post',
                url: '{{route('ajaxlicen')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    facultad: val
                },
                success: function (response) {
                    var cosas = response.html;
                    selecte.innerHTML = cosas;
                    $("#licen").trigger('contentChanged');
                    MostrarOcultos();
                }
            });
        }

        function parimpar(numero) {
            if (numero % 2 === 0) {
                document.getElementById('fase').setAttribute('value', "2");
            } else {
                document.getElementById('fase').setAttribute('value', "1");
            }
        }

        function Validacaja(caja) {
            var finalizar = document.getElementById('guardar');
            finalizar.getAttribute('class');
            if (caja.checked === true) {
                finalizar.setAttribute('class', 'black-text light-blue accent-1 btn boton');
            } else if (caja.checked === false) {
                finalizar.setAttribute('class', 'disabled black-text light-blue accent-1 btn boton');
            }
        }

        function mostrarsemestre(val) {
            var selecte = document.getElementById('semestre');
            $.ajax({
                type: 'post',
                url: '{{route('ajaxsemestre')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    licenciatura: val
                },
                success: function (response) {
                    var cosas = response.html;
                    selecte.innerHTML = cosas;
                    $("#semestre").trigger('contentChanged');
                }
            });
        }
    </script>
@endsection