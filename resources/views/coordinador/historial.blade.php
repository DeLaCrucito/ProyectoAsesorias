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
                        <div class="input-field col s12 m6 white-text">
                            <select id="unidad" onchange="filtros()" name="unidad" >
                                <option value="0" disabled selected>Selecciona un semestre</option>

                            </select>
                            <label class="white-text">Unidad de Aprendizaje</label>
                        </div>
                        <div class="input-field col s12 m4 white-text">
                            <select id="estado" name="estado" onchange="filtros()">
                                <option value="0" disabled selected>Buscar por estado</option>
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
                                <th>Alumno</th>
                                <th>Asesor</th>
                                <th>Unidad de Aprendizaje</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($solicituds as $solicitud)
                                <tr>
                                    <td width="25%">{{ $solicitud->student->nombre .' '.$solicitud->student->apellido
                                    }}</td>
                                    <td width="25%">{{ $solicitud->consultant->nombre .' '.
                                    $solicitud->consultant->apellido
                                    }}</td>
                                    <td width="25%">{{ $solicitud->subject->nombre }}</td>
                                    <td><a style=" cursor: default;"  data-position="top" data-delay="10"
                                           data-tooltip="{{ $solicitud->state->mensaje }}" class="black-text {{
                                           $solicitud->state->color }} btn-floating tooltipped"><i
                                                    class="material-icons">{{ $solicitud->state->icon }}</i></a></td>
                                    <td><a href="{{ route('evaluacion',['id'=>encrypt($solicitud->id)]) }}"
                                           class="btn-flat white-text">
                                            <span></span>
                                            @if($solicitud->estado === 2)
                                                <?php
                                    if ((new App\Models\Evaluation)->where('solicitud',"=",$solicitud->id)->exists()){
                                        $texto = "Calificada";
                                    }else{
                                        $texto = "Calificar";
                                    }
                                    ?>
                                                {{ $texto }}
                                            @else
                                                Ver Detalles
                                            @endif
                                                </a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @unless (count($solicituds))
                            <p class="white-text center-align">No se encontraron solicitudes.</p>
                        @endunless
                        {!! $solicituds->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </form>
    <script>
        function selectUnidades(val) {
            var selecte = document.getElementById('unidad');
            $.ajax({
                type: 'post',
                url: '{{route('coorselectunidades')}}',
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

        function filtros() {
            var estado = document.getElementById('estado').value;
            var unidad = document.getElementById('unidad').value;
            $.ajax({
                type: 'post',
                url: '{{route('filtrohistorial')}}',
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
            var estado = document.getElementById('estado').value;
            var unidad = document.getElementById('unidad').value;
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