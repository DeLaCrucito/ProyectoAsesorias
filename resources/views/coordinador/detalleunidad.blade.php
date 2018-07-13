@extends('coordinador.base')
@section('elementos')
    <form class="col s12" method="post" action="">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Detalles de la Unidad de Aprendizaje</h4>
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
                <div class="input-field col s12 m12 ">
                    <input class="white-text" disabled readonly type="text" id="nombre" name="nombre" value="{{
                    $subject->nombre }}">
                    <label class="white-text" for="nombre">Nombre</label>
                </div>
                <div class="input-field col s12 m6 ">
                    <input class="white-text" disabled readonly type="text" id="fase" name="fase" value="{{
                    $subject->fase }}">
                    <label class="white-text"  for="fase">Fase</label>
                </div>
                <div class="input-field col s12 m6 ">
                    <input class="white-text" disabled readonly type="text" id="semestre" name="semestre" value="{{
                    $subject->semestre }}">
                    <label class="white-text"  for="semestre">Semestre</label>
                </div>
                <div class="input-field col s12 m6">
                    <input class="white-text" disabled readonly type="email" id="clave" name="clave" value="{{
                    $subject->clave }}">
                    <label class="white-text"  for="clave">Clave</label>
                </div>
                <div class="input-field col s12 m6">
                    <input class="white-text" disabled readonly type="email" id="tipo" name="tipo" value="{{
                    $subject->tipo }}">
                    <label class="white-text" for="tipo">Tipo</label>
                </div>
                <div class="col s12 m12">
                    <div class="row col s12 m12">
                        <blockquote>
                            <h5 class="left-align thin white-text">Asesores que imparten la materia</h5>
                        </blockquote>
                    </div>
                    <p class="white-text center-align">Se muestra un listado con los asesores que imparten la materia.</p>
                    <div class="posts row" id="posts">
                        <table class="white-text highlight">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nivel de Estudio</th>
                                <th>Especialidad</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($consultants as $consultant)

                                <tr >
                                    <td>{{ $consultant->consultant->nombre .' '. $consultant->consultant->apellido
                                    }}</td>
                                    <td>{{ $consultant->consultant->nivel_estudio }}</td>
                                    <td>{{ $consultant->consultant->especialidad }}</td>
                                    <td><a class="btn-flat blue-text modal-trigger"
                                           href="#modal{{ $consultant->id }}"><span></span>Remover</a></td>

                                </tr>
                                <div id="modal{{ $consultant->id }}" class="modal">
                                    <div class="modal-content">
                                        <h5>Puede reasignar al asesor posteriormente</h5>
                                        <p>¿Desea remover al asesor {{
                                                   $consultant->consultant->nombre . ' '.
                                                   $consultant->consultant->apellido }}
                                            de la materia
                                            {{ $subject->nombre  }}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a id="#disagree" onclick=" $('#modal{{ $subject->id }}').modal('close');" class="modal-action modal-close waves-effect
                                            waves-red btn-flat">Cancelar</a>
                                        <a id="#agree" href="{{ route('delasignacion', ['id'=>encrypt($consultant->id)] ) }}"
                                           class="modal-action modal-close
                                                   waves-effect
                                            waves-green btn-flat">Aceptar</a>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                        @unless (count($consultants))
                            <p class="white-text center-align">Este materia no tiene asignado ningún asesor.</p>
                        @endunless
                        {!! $consultants->links() !!}
                    </div>
                </div>


            </div>
        </div>
    </form>
    <script>

        function cargaTabla(page) {
            var asesor = "{{ $subject->id }}";
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