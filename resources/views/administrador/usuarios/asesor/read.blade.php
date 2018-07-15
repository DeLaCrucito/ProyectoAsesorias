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
            @if(session()->has('message'))
                <div class="green darken-4 white-text col s12 m12 center-align" style="border-radius: 25px">
                    <h5>{{ session()->get('message') }}</h5>
                </div><br>
            @endif
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
                                <th>Borrar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($consultants as $consultant)
                                <tr>
                                    <td>{{ $consultant->nombre ." ". $consultant->apellido}}</td>
                                    <td>{{ $consultant->correo }}</td>
                                    <td><a href="{{ route('editasesor', encrypt($consultant->id)) }}" >Ver detalles</a></td>
                                    <td><a class="btn-flat blue-text modal-trigger"
                                           href="#modal{{ $consultant->id }}"><span></span>Eliminar</a></td>
                                </tr>
                                <div id="modal{{ $consultant->id }}" class="modal">
                                    <div class="modal-content red darken-4">
                                        <h1 class="white-text">ADVERTENCIA</h1>
                                        <p class="white-text">Esta acción no se puede deshacer. Se borrarán todos los datos relacionados con
                                            el asesor {{$consultant->nombre .' '.$consultant->apellido }} incluyendo solicitudes
                                            registradas ¿Realmente desea eliminar a {{$consultant->nombre .' '.$consultant->apellido}}?</p>
                                        <div class="center-align">
                                            <div style="display: inline-flex">
                                                <input type="checkbox" style="background-color: #FFFFFF" onclick="continuar(this,'#agree{{ $consultant->id }}')"
                                                       class="filled-in"
                                                       id="validar{{ $consultant->id }}"/>
                                                <label class="white-text" for="validar{{ $consultant->id }}">Deseo contiuar</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer red darken-4">
                                        <a id="#disagree" onclick="$('#modal{{ $consultant->id }}').modal('close');" class="modal-action modal-close
                                            waves-effect waves-red btn-flat white-text">Cancelar</a>
                                        <a id="#agree{{ $consultant->id }}" href="{{ route('deleteasesor', ['id'=>encrypt($consultant->id)]) }}"
                                           class="disabled modal-action modal-close waves-effect white-text waves-green btn-flat">Aceptar</a>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                        @unless (count($consultants))
                            <p class="white-text center-align">No se encontró ningún asesor.</p>
                        @endunless
                        {!! $consultants->links() !!}

                        }

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
                    $('.modal').modal();
                    $('.tooltipped').tooltip({delay: 50});
                }
            });
        }

        function cargaTabla(page) {
            var asesor = document.getElementById('nombre').value;
            $.ajax({
                data: {
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