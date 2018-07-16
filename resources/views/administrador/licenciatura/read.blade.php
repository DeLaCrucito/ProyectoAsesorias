@extends('administrador.base')
@section('elementos')
    <form class="col s12" method="post">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Licenciaturas</h4>
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
                    <div class="row input-field col s12 m6">
                        <label class="active white-text" for="tipo">Facultad</label>
                        <select class="white-text" id="facultad" name="facultad" onchange="mostrarTabla(this.value)">
                            <option disabled selected="selected">Seleccione una facultad</option>
                            @foreach($facultads as $facultad)
                                 <option value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row center-align col s12 m6">
                        <a name="nuevo" id="nuevo" href="{{ route('newlicenciatura') }}" class="white-text red
                        darken-1 btn boton">Agregar Nuevo</a>
                    </div>
                </div>
                <div class="posts row" id="posts">
                </div>
            </div>
        </div>
    </form>
    <script>
        function mostrarTabla(val) {
            $.ajax({
                type: 'post',
                url: '{{route('tablalicenciatura')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    facultad: val
                },
                success: function (response) {
                    document.getElementById('posts').innerHTML = response.html;
                    $('.modal').modal();
                    $('.tooltipped').tooltip({delay: 50});
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
                $('.posts').html(data);
                $('.modal').modal();
                $('.tooltipped').tooltip({delay: 50});
            })
        }
    </script>
@endsection