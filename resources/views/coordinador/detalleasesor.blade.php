@extends('coordinador.base')
@section('elementos')
    <form class="col s12" method="post" action="{{ route('updateasesor',$consultant->id) }}">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Detalles del asesor</h4>
                    </blockquote>
                </div>
            </div>
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
                <div class="input-field col s12 m6 ">
                    <input class="white-text" disabled readonly type="text" id="nombre" name="nombre" value="{{
                    $consultant->nombre . ' '. $consultant->apellido
                    }}" placeholder="Introduzca el nombre">
                    <label class="white-text" for="nombre">Nombre</label>
                </div>
                <div class="input-field col s12 m6 ">
                    <input class="white-text" disabled readonly type="text" id="nivel_estudio" name="nivel_estudio" value="{{
                    $consultant->nivel_estudio }}" placeholder="Introduzca el nivel de estudio">
                    <label class="white-text"  for="nivel_estudio">Nivel de Estudio</label>
                </div>
                <div class="input-field col s12 m6 ">
                    <input class="white-text" disabled readonly type="text" id="especialidad" name="especialidad" value="{{
                    $consultant->especialidad }}" placeholder="Introduzca la especialidad">
                    <label class="white-text"  for="especialidad">Especialidad</label>
                </div>
                <div class="input-field col s12 m6">
                    <input class="white-text" disabled readonly type="email" id="correo" name="correo" value="{{
                    $consultant->correo
                    }}" placeholder="Ingrese correo electrónico institucional">
                    <label class="white-text"  for="correo">Correo Institucional</label>
                </div>
                <div class="col s12 m6">
                    <div class="row col s12 m9">
                        <blockquote>
                            <h5 class="left-align thin white-text">Materias asignadas</h5>
                        </blockquote>
                    </div>
                    <a name="cancel" id="cancel" href="{{ route('asignacion', $consultant->id) }}" class="white-text
                    red darken-1 btn boton">Asignar materia</a>
                    <p class="white-text">Se muestra un listado con las materias que el asesor puede impartir.</p>
                    <div class="posts row" id="posts">
                        <table class="white-text highlight">
                            <thead>
                            <tr>
                                <th>Unidad de Aprendizaje</th>
                                <th>Semestre</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr >
                                    <td>{{ $subject->subject->nombre }}</td>
                                    <td>{{ $subject->subject->semestre }}</td>
                                    <td>{{ $subject->subject->tipo }}</td>
                                    <td><a class="btn-flat blue-text modal-trigger"
                                           href="#modal{{ $subject->id }}"><span></span>Remover</a></td>

                                </tr>
                                <div id="modal{{ $subject->id }}" class="modal">
                                    <div class="modal-content">
                                        <h5>Esta acción no se puede deshacer</h5>
                                        <p>¿Seguro que desea remover la materia {{
                                                   $subject->subject->nombre }} para el asesor
                                            {{$subject->nombre . ' '.
                                                                       $subject->apellido}}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a id="#disagree" onclick="$('#modal{{ $subject->id }}').modal('close');" class="modal-action modal-close waves-effect
                                            waves-red btn-flat">Cancelar</a>
                                        <a id="#agree" href="{{ route('delasignacion', ['id'=>$subject,
                                                   'consultant'=>$consultant]) }}" class="modal-action modal-close waves-effect
                                            waves-green btn-flat">Aceptar</a>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $subjects->links() !!}
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="row col s12 m9">
                        <blockquote>
                            <h5 class="left-align thin white-text">Horario</h5>
                        </blockquote>
                    </div>
                    <a name="cancel" id="cancel" href="{{ route('newhorario', $consultant->id) }}" class="white-text
                red darken-1 btn boton">Gestionar Horario</a>
                    <p class="white-text">Se muestra un listado con el horario que el asesor dispone para dar
                        asesorías.</p>
                    <div class=" row" id="">
                        <table class="white-text highlight centered">
                            <thead>
                            <tr>
                                <th>Día</th>
                                <th>Horario Disponible</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->dia }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimeString($schedule->hr_inicio)->format('h:i
                                    A') .' - '. Carbon\Carbon::createFromTimeString($schedule->hr_fin)->format
                                    ('h:i A') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>

        function cargaTabla(page) {
            var asesor = "{{ $consultant->id }}";
            $.ajax({
                data:{
                    asesor: asesor
                },
                url:'?page='+page
            }).done(function (data) {
                $('.posts').html(data);
                $('.modal').modal();
                $('.tooltipped').tooltip({delay: 50});
            })
        }
    </script>
@endsection