@extends('administrador.base')
@section('elementos')
    <form class="col s12" method="post">
    {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Facultades y Escuelas</h4>
                    </blockquote>
                </div>
            </div>
            <div style="margin-top: 50px">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <label class="active white-text" for="tipo">Nivel de estudios</label>
                        <select class="white-text" id="tipo" name="tipo" onchange="mostrarTabla(this.value)" required>
                            <option disabled selected="selected" >Seleccione el nivel de estudios</option>
                            <option value="Bachillerato">Medio superior</option>
                            <option value="Licenciatura">Superior</option>
                        </select>
                    </div>
                    <div class="row center-align col s12 m6">
                        <a name="nuevo" id="nuevo" href="{{ route('newfacultad') }}" class="white-text red darken-1 btn boton">Agregar Nuevo</a>
                    </div>
                    <div class="posts row" id="posts">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        function mostrarTabla(val) {
            $.ajax({
                type: 'post',
                url: '{{route('ajaxtablafacultad')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    tipo: val
                },
                success: function (response) {
                    document.getElementById('posts').innerHTML = response.html;
                }
            });
        }

        function cargaTabla(page) {
            var tipo = document.getElementById('tipo').value;
            $.ajax({
                data: {
                    tipo: tipo
                },
                url:'?page='+page
            }).done(function (data) {
                console.log(data)
                $('.posts').html(data);
            })
        }
    </script>
@endsection