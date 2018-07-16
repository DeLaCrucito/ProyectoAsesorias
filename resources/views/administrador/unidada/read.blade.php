@extends('administrador.base')
@section('elementos')
    <style>
        .oculto {
            display: none;
        }
    </style>
    <form class="col s12" method="post">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Unidades de aprendizaje</h4>
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
                    <div class="row input-field col s12 m8">
                        <label class="active white-text" for="tipo">Facultad</label>
                        <select class="white-text" id="facultad" name="facultad" onchange="realizaProceso(this.value)">
                            <option disabled selected="selected">Seleccione una facultad</option>
                            @foreach($facultads as $facultad)
                                <option value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row center-align col s12 m4">
                        <a name="nuevo" id="nuevo" href="{{ route('newunidad') }}" class="white-text red
                        darken-1 btn boton">Agregar Nuevo</a>
                    </div>
                    <div id="cajalicen" class="row input-field col s12 m6 white-text oculto">
                        <select id="licen" onchange="mostrarsemestre(this.value)" name="licen" required></select>
                        <label for="licen" class="white-text">Licenciatura</label>
                    </div>
                    <div id="cajasemestre" class="input-field col s12 m6 white-text oculto">
                        <select id="semestre" onchange="mostrarTabla(this.value)" name="semestre"  required></select>
                        <label for="semestre" class="white-text">Semestre</label>
                    </div>

                </div>
                <div class="posts row" id="posts">
                </div>
            </div>
        </div>
    </form>
    <script>
        function realizaProceso(val) {
            var caja = document.getElementById('cajalicen');
            var selecte = document.getElementById('licen');
            $.ajax({
                type: 'post',
                url: '{{route('ajaxlicen')}}',
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
                    var cosas = response.html;
                    caja.setAttribute('style', 'display: block');
                    selecte.innerHTML = cosas;
                    $("#licen").trigger('contentChanged');
                    $('.modal').modal();
                    $('.tooltipped').tooltip({delay: 50});
                }
            });
        }

        function mostrarsemestre(val) {
            var caja = document.getElementById('cajasemestre');
            var selecte = document.getElementById('semestre');
            $.ajax({
                type: 'post',
                url: '{{route('ajaxsemestre')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    licenciatura: val
                },
                success: function (response) {
                    var cosas = response.html;
                    caja.setAttribute('style', 'display: block');
                    selecte.innerHTML = cosas;
                    $("#semestre").trigger('contentChanged');
                    $('.modal').modal();
                    $('.tooltipped').tooltip({delay: 50});
                }
            });
        }


        function mostrarTabla(val) {
            var licen = document.getElementById('licen').value;
            $.ajax({
                type: 'post',
                url: '{{route('tablaunidada')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    semestre: val,
                    licenciatura: licen
                },
                success: function (response) {
                    document.getElementById('posts').innerHTML = response.html;
                    $('.modal').modal();
                    $('.tooltipped').tooltip({delay: 50});
                }
            });
        }


        function cargaTabla(page) {
            var facultad = document.getElementById('facultad').value;
            var licen = document.getElementById('licen').value;
            var semestre = document.getElementById('semestre').value;
            $.ajax({
                data: {
                    facultad: facultad,
                    licenciatura: licen,
                    semestre: semestre
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