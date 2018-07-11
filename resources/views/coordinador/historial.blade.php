@extends('coordinador.base')
@section('elementos')
    <form class="col s12" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col s12 m12">
                <div class="row center ">
                    <div class="row col s12 m9">
                        <blockquote>
                            <h4 class="left-align thin white-text">Historial de solicitud</h4>
                        </blockquote>
                    </div>
                </div>
                <div style="margin-top: 50px">
                    <div class="row">
                        <p class="white-text center-align">* Usted puede filtrar los datos con las siguientes opciones.</p>
                        <div class="input-field col s12 m2 white-text">
                            <select id="semestre" onchange="selectUnidades(this.value)" name="semestre" >
                                <option value="" disabled selected="selected">Seleccione un semestre</option>
                                @foreach(range(1,$coordinator->degree->semestres) as $semestre)
                                    <option value="{{ $semestre }}">{{ $semestre }}</option>
                                @endforeach
                            </select>
                            <label class="white-text">Semestre</label>
                        </div>
                        <div class="input-field col s12 m6 white-text oculto">
                            <select id="unidad" onchange="filtros()" name="unidad" >
                                <option value="0" disabled selected>Buscar por Unidad de Aprendizaje</option>

                            </select>
                            <label class="white-text">Unidad de Aprendizaje</label>
                        </div>
                        <div class="input-field col s12 m6 white-text">
                            <select id="Estados" name="Estados" onchange="filtros()">
                                <option value="0" disabled selected>Buscar por estado</option>

                            </select>
                            <label class="white-text">Estado</label>
                        </div>
                    </div>
                    <div class="posts row" id="posts">
                        <table class="white-text highlight responsive-table">
                            <thead>
                            <tr>
                                <th>Unidad de Aprendizaje</th>
                                <th>Cita</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($solicituds as $solicitud)
                                <tr>
                                    <td>{{ $solicitud->subject->nombre }}</td>
                                    <td>{{ $solicitud->fecha->diffForHumans() }}</td>
                                    <td>{{ $solicitud->fecha->format('l, d F Y, h:i a') }}</td>
                                    <td><a style=" cursor: default;"  data-position="top" data-delay="10"
                                           data-tooltip="{{ $solicitud->state->mensaje }}" class="black-text {{
                                           $solicitud->state->color }} btn-floating tooltipped"><i
                                                    class="material-icons">{{ $solicitud->state->icon }}</i></a></td>
                                    <td><a href="{{ route('detallesolicitud',['id'=>encrypt($solicitud->id)]) }}"
                                           class="btn-flat white-text"><span></span>Ver Detalles</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $solicituds->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </form>
    <script>
        function filtros() {
            var estado = document.getElementById('Estados').value;
            var unidad = document.getElementById('Unidads').value;
            $.ajax({
                type: 'post',
                url: '{{route('ajaxunidadhistorial')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    estado: estado,
                    unidad: unidad
                },
                success: function (response) {
                    document.getElementById('posts').innerHTML = response.html;
                    $('.tooltipped').tooltip({delay: 50});
                }
            });
        }

        function cargaTabla(page) {
            var estado = document.getElementById('Estados').value;
            var unidad = document.getElementById('Unidads').value;
            $.ajax({
                data: {
                    estado: estado,
                    unidad: unidad
                },
                url:'?page='+page
            }).done(function (data) {
                $('.posts').html(data);
                $('.tooltipped').tooltip({delay: 50});
            })
        }
    </script>
@endsection