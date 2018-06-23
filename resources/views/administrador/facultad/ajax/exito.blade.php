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
                                            <h4 class="left-align thin white-text">Se guardó exitosamente</h4>
                                        </blockquote>
                                    </div>
                                </div>
                                <div style="margin-top: 50px">
                                    <div class="row">
                                        <div class="row center-align">
                                            <a name="registros" id="registros" href="{{ route('viewfacultad') }}" class="black-text light-blue accent-1 btn boton">Ver registros</a>
                                            <br>
                                            <a name="nuevo" id="nuevo" href="{{ route('newfacultad') }}" class="white-text red darken-1 btn boton">Agregar Nuevo</a>
                                        </div>
                                    </div>

                                </div>


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