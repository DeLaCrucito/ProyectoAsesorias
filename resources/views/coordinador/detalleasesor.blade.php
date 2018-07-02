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
            <div style="margin-top: 50px">
                <div class="row">
                    <div class="row input-field col s12 m6">
                        <label class="active white-text" for="tipo">Especialidad</label>
                        <select class="white-text" id="especialidad" name="especialidad" onchange="mostrarTabla(this
                        .value)">
                            <option disabled selected="selected">Buscar por especialidad</option>
                            @foreach($consultants as $consultant)
                                <option value="{{ $consultant->especialidad }}">{{ $consultant->especialidad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row center-align col s12 m6">
                        <a name="nuevo" id="nuevo" href="{{ route('newasesor') }}" class="white-text red
                        darken-1 btn boton">Asignar Materias</a>
                    </div>
                    <div class="posts row" id="posts">
                        <table class="white-text highlight">
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
                                    <td><a href="{{ route('detalleasesor', $consultant->id) }}" >Ver detalles</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $consultants->links() !!}

                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        function mostrarTabla(val) {
            $.ajax({
                type: 'post',
                url: '{{route('filtroespecialidad')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    especialidad: val
                },
                success: function (response) {
                    document.getElementById('posts').innerHTML = response.html;
                }
            });
        }

        function cargaTabla(page) {
            var tipo = document.getElementById('facultad').value;
            $.ajax({
                data: {
                    facultad: tipo
                },
                url:'?page='+page
            }).done(function (data) {
                console.log(data)
                $('.posts').html(data);
            })
        }
    </script>
@endsection