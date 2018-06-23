@extends('templates.admin')
@section('main')
    <style>
        .oculto{
            display: none;
        }
    </style>
    <div class="section">
        <div class="row" style="background-color: transparent" id="SolicitudAdd">
            <form class="col s12" method="post" action="{{ route('saveunidad') }}" >
                {{ csrf_field() }}
                <div class="col s12 m12">
                    <div align="center">
                        <div class="row">
                            <div class="col s12 m12">
                                <div class="row center ">
                                    <div class="row col s12 m9">
                                        <blockquote>
                                            <h4 class="left-align thin white-text">Nueva Unidad de Aprendizaje</h4>
                                        </blockquote>
                                    </div>
                                </div>
                                <div style="margin-top: 50px">
                                    <div class="row">
                                        <div class="input-field col s12 m12 white-text">
                                            <select id="facultad" name="facultad" onchange="realizaProceso(this.value)" required>
                                                <option disabled selected="selected" >Seleccione la facultad a la que pertenece la nueva Unidad de Aprendizaje</option>
                                                @foreach($facultads as $facultad)
                                                    <option value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <label class="white-text">Facultad</label>
                                        </div>
                                        <div id="cajalicen"  class="input-field col s12 m6 white-text oculto">
                                            <select  id="licen" name="licen" required>
                                                
                                            </select>
                                            <label for="licen" class="white-text">Licenciatura</label>
                                        </div>
                                        <div class="input-field col s12 m6 oculto" id="oculto2">
                                            <input class="white-text" type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre de la Unidad de Aprendizaje"/>
                                            <label class="white-text" for="nombre">Nombre de la unidad de aprendizaje</label>
                                        </div>

                                        <div class="input-field col s12 m3 oculto" id="oculto4">
                                            <input class="white-text validate" type="number" min="1" max="8" onchange="parimpar(this.value)" placeholder="Introduzca el semestre" name="semestre" id="semestre"/>
                                            <label class="white-text" for="semestre">Semestre</label>
                                        </div>

                                        <div class=" input-field row col s12 m3 oculto" id="oculto3">

                                                <input class="white-text" disabled name="fase" id="fase" value=""/>
                                                <label class="white-text active" for="fase">Ciclo Escolar, Fase</label>
                                            </p>
                                        </div>

                                        <div class="input-field col s12 m6 oculto" id="oculto5">
                                            <input class="white-text" type="text" name="clave" id="clave" placeholder="Ingrese la clave de la unidad"/>
                                            <label class="white-text" for="clave">Clave</label>
                                        </div>
                                    </div>

                                </div>


                            </div>
                            <div class="row center-align">
                                <div style="display: inline-flex">
                                    <input type="checkbox" onclick="Validacaja(this)" class="filled-in" id="validar"/>
                                    <label class="white-text" for="validar">Los datos son correctos</label>
                                </div><br>
                                <button type="submit" name="guardar" id="guardar" class="disabled black-text light-blue accent-1 btn boton">Guardar</button> <br>
                                <a name="cancel" id="cancel" href="{{ route('viewunidad') }}" class="white-text red darken-1 btn boton">Cancelar y volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function realizaProceso(val) {
            var caja = document.getElementById('cajalicen');
            var selecte = document.getElementById('licen');
            var oc2 = document.getElementById('oculto2');
            var oc3 = document.getElementById('oculto3');
            var oc4 = document.getElementById('oculto4');
            var oc5 = document.getElementById('oculto5');
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
                    caja.setAttribute('style','display: block');
                    oc2.setAttribute('style','display: block');
                    oc3.setAttribute('style','display: block');
                    oc4.setAttribute('style','display: block');
                    oc5.setAttribute('style','display: block');
                    selecte.innerHTML = cosas;
                    $("#licen").trigger('contentChanged');
                }
            });
        }

        function parimpar(numero) {
            if (numero%2===0) {
                document.getElementById('fase').setAttribute('value',"2");
            } else {
                document.getElementById('fase').setAttribute('value',"1");
            }
        }

        function Validacaja(caja) {
            var finalizar = document.getElementById('guardar');
            finalizar.getAttribute('class');
            if (caja.checked === true){
                finalizar.setAttribute('class','black-text light-blue accent-1 btn boton');
            }else if(caja.checked === false){
                finalizar.setAttribute('class','disabled black-text light-blue accent-1 btn boton');
            }
        }
    </script>
@endsection