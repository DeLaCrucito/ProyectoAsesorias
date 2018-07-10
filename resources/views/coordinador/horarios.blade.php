@extends('coordinador.base')
@section('elementos')
    <form class="col s12" method="post" action="{{ route('savehorario',$consultant->id) }}">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Gestión de Horario</h4>
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
                            <h5 class="left-align thin white-text">Horario actual</h5>
                        </blockquote>
                    </div>
                    <div class="posts row" id="posts">
                        <table class="white-text highlight centered">
                            <thead>
                            <tr>
                                <th>Dia</th>
                                <th>Horario disponible</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->dia }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimeString($schedule->hr_inicio)->format('h:i
                                    A') .' - '. Carbon\Carbon::createFromTimeString($schedule->hr_fin)->format
                                    ('h:i A') }}</td>
                                    <td><a class="btn-flat blue-text modal-trigger"
                                           href="#modal{{ $schedule->id }}"><span></span>Eliminar</a></td>

                                </tr>
                                <script>
                                    function ejecutaAccion() {
                                        window.location.href = '{{ route('delhorario', ['id'=>$schedule,
                                                   'consultant'=>$consultant]) }}'
                                    }
                                    
                                    function cierraModal() {
                                        $('#modal{{ $schedule->id }}').modal('close');
                                    }
                                </script>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $schedules->links() !!}
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="row col s12 m9">
                        <blockquote>
                            <h5 class="left-align thin white-text">Nuevo horario</h5>
                        </blockquote>
                    </div>

                    <div class="input-field col s12 m12 white-text">
                        <select name="dia" id="dia" onchange="MostrarOcultos()">
                            <option disabled selected>Días hábiles</option>
                            <option value="1">Lunes</option>
                            <option value="2">Martes</option>
                            <option value="3">Miércoles</option>
                            <option value="4">Jueves</option>
                            <option value="5">Viérnes</option>
                        </select>
                        <label class="white-text" for="dia">Seleccione un día</label>
                    </div>

                    <div class="input-field col s12 m6 oculto">
                        <input class="white-text timepicker" type="time" id="hr_inicio" name="hr_inicio"
                               value="">
                        <label class="white-text active" for="hr_inicio">Hora de inicio</label>
                    </div>
                    <div class="input-field col s12 m6 oculto">
                        <input class="white-text timepicker" type="time" id="hr_fin" name="hr_fin" value="">
                        <label class="white-text active" for="hr_fin">Hora de fin</label>
                    </div>
                        @if(session()->has('message'))
                            <div class="red darken-1 white-text col s12 m12" style="border-radius: 25px">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    <button type="submit" name="guardar" id="guardar" class=" black-text light-blue accent-1
                    btn boton oculto">Guardar</button>
                </div>

            </div>
        </div>
        @foreach($horas as $hora)
            <div id="modal{{ $hora->id }}" class="modal">
                <div class="modal-content">
                    <h5>Esta acción no se puede deshacer</h5>
                    <p>¿Seguro que desea eliminar el horario con el día {{
                                                   $hora->dia .' y horario '. $hora->hr_inicio .' - '.
                                                   $hora->hr_fin
                                                   }} para el asesor {{$consultant->nombre . ' '.
                                                   $consultant->apellido}}?</p>
                </div>
                <div class="modal-footer">
                    <a id="#disagree" onclick="cierraModal()" class="modal-action modal-close waves-effect
                                            waves-red btn-flat">Cancelar</a>
                    <a id="#agree" onclick="ejecutaAccion()" class="modal-action modal-close waves-effect
                                            waves-green btn-flat">Aceptar</a>
                </div>
            </div>
        @endforeach
    </form>
    <script>
        function cargaTabla(page) {
            $.ajax({
                url:'?page='+page
            }).done(function (data) {
                $('.posts').html(data);
            })
        }
    </script>
    <script>

    </script>
@endsection