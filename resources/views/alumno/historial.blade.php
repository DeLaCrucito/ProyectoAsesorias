@extends('alumno.base')
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
                        <div class="input-field col s12 m6 white-text">
                            <select id="Unidads" name="Unidads" >
                                <option value="" disabled selected>Buscar por Unidad de Aprendizaje</option>
                                @foreach($materias as $materia)
                                    <option value="{{ $materia->materia }}">{{ $materia->subject->nombre }}</option>
                                @endforeach
                            </select>
                            <label class="white-text">Unidad de Aprendizaje</label>
                        </div>
                        <div class="input-field col s12 m6 white-text">
                            <select id="Estados" name="Estados" >
                                <option value="" disabled selected>Buscar por estado</option>
                                @foreach($estados as $estado)
                                    <option value="{{ $estado->estado }}">{{ $estado->state->nombre }}</option>
                                @endforeach
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
                                    <td>{{ $solicitud->fecha->format('D, d M Y, h:i a') }}</td>
                                    <td><a style=" cursor: default;"  data-position="top" data-delay="10"
                                           data-tooltip="{{ $solicitud->state->mensaje }}" class="black-text {{
                                           $solicitud->state->color }} btn-floating tooltipped"><i
                                           class="material-icons">{{ $solicitud->state->icon }}</i></a></td>
                                    <td><a class="white-text" href="">VER DETALLES</a></td>
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
        function cargaTabla(page) {
            $.ajax({
                data: {
                },
                url:'?page='+page
            }).done(function (data) {
                $('.posts').html(data);
                $('.tooltipped').tooltip({delay: 50});
            })
        }
    </script>

@endsection