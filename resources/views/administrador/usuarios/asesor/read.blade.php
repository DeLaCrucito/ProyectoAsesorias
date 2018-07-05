@extends('administrador.base')
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
                    <div class="input-field col s12 m6">
                        <input class="white-text" type="text" id="nombre" name="nombre" value="" placeholder="Introduzca el nombre" onkeyup="mostrarTabla(this.value)">
                        <label class="white-text" for="nombre">Nombre</label>
                    </div>
                    <div class="row center-align col s12 m4">
                        <a name="nuevo" id="nuevo" href="{{ route('newasesor') }}" class="white-text red
                        darken-1 btn boton">Agregar Nuevo</a>
                    </div>
                    <div class="posts row" id="posts">
                        <table class="white-text highlight">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                                <th>Borrado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($consultants as $consultant)
                                <tr>
                                    <td>{{ $consultant->nombre ." ". $consultant->apellido}}</td>
                                    <td>{{ $consultant->correo }}</td>
                                    <td><a href="{{ route('editasesor', $consultant->id) }}" >Ver detalles</a></td>
                                    <td><a href="{{ route('deleteasesor', $consultant->id) }}">Eliminar</a> </td>
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
                url: '{{route('tablaasesor')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    asesor: val,
                },
                success: function (response) {
                    console.log(response.html);
                    document.getElementById('posts').innerHTML = response.html;
                }
            });
        }

        function cargaTabla(page) {
            var asesor = document.getElementById('asesor').value;
            $.ajax({
                data: {
                    asesor: asesor
                },
                url:'?page='+page
            }).done(function (data) {
                $('.posts').html(data);
            })
        }
    </script>
@endsection