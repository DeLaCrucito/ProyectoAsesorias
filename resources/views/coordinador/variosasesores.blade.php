@extends('coordinador.base')
@section('elementos')
    <form class="col s12" method="post">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Asesores</h4>
                    </blockquote>
                </div>
            </div>
            @if(session()->has('message'))
                <div class="green darken-4 white-text col s12 m12 center-align" style="border-radius: 25px">
                    <h5>{{ session()->get('message') }}</h5>
                </div><br>
            @endif
            @if(session()->has('alert'))
                <div class="red darken-4 white-text col s12 m12 center-align" style="border-radius: 25px">
                    <h5>{{ session()->get('alert') }}</h5>
                </div><br>
            @endif
            <div style="margin-top: 50px">
                <div class="row">
                    <h5 class="white-text">Agregar asesores a la materia {{ $subject->nombre }}</h5>
                    <div class="row input-field col s12 m6">
                        <label class="active white-text" for="tipo">Especialidad</label>
                        <select class="white-text" id="especialidad" name="especialidad" onchange="mostrarTabla(this
                        .value)">
                            <option disabled selected="selected" value="nada">Buscar por especialidad</option>
                            @foreach($consultants as $consultant)
                                <option value="{{ $consultant->especialidad }}">{{ $consultant->especialidad }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="posts row" id="posts">
                    <table class="white-text highlight responsive-table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Especialidad</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($consultants as $consultant)
                            <tr>
                                <td>{{ $consultant->nombre ." ". $consultant->apellido}}</td>
                                <td>{{ $consultant->especialidad }}</td>
                                <td><a class="btn-flat blue-text modal-trigger"
                                       href="#modal{{ $consultant->id }}"><span></span>Asignar</a></td>

                                <div id="modal{{ $consultant->id }}" class="modal">
                                    <div class="modal-content">
                                        <h5>Podrá remover la materia posteriormente</h5>
                                        <p>¿Desea asignar la materia {{
                                                   $subject->nombre }} al asesor
                                            {{$consultant->nombre . ' '. $consultant->apellido}}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a id="#disagree" onclick="$('#modal{{ $consultant->id }}').modal('close');" class="modal-action modal-close
                                        waves-effect
                                            waves-red btn-flat">Cancelar</a>
                                        <a id="#agree" href="{{ route('asignar', ['subject'=>encrypt($subject->id),
                'consultant'=>encrypt($consultant->id)]) }}"
                                           class="modal-action
                                        modal-close
                                        waves-effect
                                            waves-green btn-flat">Aceptar</a>
                                    </div>
                                </div>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @unless (count($consultants))
                        <p class="white-text center-align">No existen asesores.</p>
                    @endunless
                    {!! $consultants->links() !!}
                </div>
            </div>
        </div>
    </form>
    <script>
        function mostrarTabla(val) {
            $.ajax({
                type: 'post',
                url: '{{route('buscarespe')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    especialidad: val,
                    unidad : '{{ encrypt($subject->id) }}'
                },
                success: function (response) {
                    document.getElementById('posts').innerHTML = response.html;
                    $('.modal').modal();
                    $('.tooltipped').tooltip({delay: 50});
                }
            });
        }

        function cargaTabla(page) {
            var tipo = document.getElementById('especialidad').value;
            var unidad = '{{encrypt($subject->id)}}';
            $.ajax({
                data: {
                    especialidad: tipo,
                    unidad: unidad
                },
                url:'?page='+page
            }).done(function (data) {
                console.log(data)
                $('.posts').html(data);
                $('.modal').modal();
                $('.tooltipped').tooltip({delay: 50});
            })
        }
    </script>
@endsection