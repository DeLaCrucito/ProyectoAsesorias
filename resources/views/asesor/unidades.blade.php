@extends('asesor.base')
@section('elementos')
    <form class="col s12" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col s12 m12">
                <div class="row center ">
                    <div class="row col s12 m9">
                        <blockquote>
                            <h4 class="left-align thin white-text">Mis Materias</h4>
                        </blockquote>
                    </div>
                </div>
                <div style="margin-top: 50px">
                    <div class="row">
                        <p class="white-text center-align">* Usted puede filtrar los datos con las siguientes opciones.</p>
                        <div class="input-field col s12 m4 white-text">
                            <select id="facultad" onchange="selectFacultad(this.value)" name="facultad" >
                                <option value="" disabled selected="selected">Seleccione una facultad</option>
                                @foreach($faculties as $facultie)
                                    <option value="{{ $facultie->id }}">{{ $facultie->nombre }}</option>
                                @endforeach
                            </select>
                            <label class="white-text" for="facultad">Facultad</label>
                        </div>
                        <div class="input-field col s12 m4 white-text">
                            <select id="licen" onchange="selectLicen(this.value)" name="licen" >
                                <option value="" disabled selected="selected">Seleccione una facultad</option>
                            </select>
                            <label class="white-text" for="licen">Licenciatura</label>
                        </div>
                        <div class="input-field col s12 m4 white-text">
                            <select id="semestre" onchange="selectSemestre(this.value)" name="semestre" >
                                <option value="" disabled selected="selected">Seleccione un semestre</option>
                            </select>
                            <label class="white-text" for="semestre">Semestre</label>
                        </div>
                    </div>
                    <div class="posts row" id="posts">
                        <table class="white-text highlight">
                            <thead>
                            <tr>
                                <th>Unidad de Aprendizaje</th>
                                <th>Semestre</th>
                                <th>Tipo de asignatura</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->nombre }}</td>
                                    <td>{{ $subject->semestre }}</td>
                                    <td>{{ $subject->tipo }}</td>
                                    <td><a href="{{ route('lamateria', ['id'=>encrypt($subject->id)]) }}" >Ver
                                            detalles</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @unless (count($subjects))
                            <p class="white-text center-align">No existen Unidades de Aprendizaje.</p>
                        @endunless
                        {!! $subjects->links() !!}


                    </div>

                </div>
            </div>
        </div>
    </form>
    <script>
        function selectFacultad(val) {
            var selecte = document.getElementById('licen');
            $.ajax({
                type: 'post',
                url: '{{route('asesorselectfacultad')}}',
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
                    selecte.innerHTML = cosas;
                    $("#licen").trigger('contentChanged');
                }
            });
        }

        function selectLicen(val) {
            var selecte = document.getElementById('semestre');
            $.ajax({
                type: 'post',
                url: '{{route('asesorselectlicen')}}',
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
                    selecte.innerHTML = cosas;
                    $("#semestre").trigger('contentChanged');

                }
            });
        }

        function selectSemestre(val) {
            var licen = document.getElementById('licen').value;
            $.ajax({
                type: 'post',
                url: '{{route('ajaxmismaterias')}}',
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
            var semestre = document.getElementById('semestre').value;
            var licen = document.getElementById('licen').value;
            $.ajax({
                data: {
                    semestre: semestre,
                    licenciatura: licen

                },
                url:'?page='+page
            }).done(function (data) {
                $('.posts').html(data);
                $('.tooltipped').tooltip({delay: 50});
            })
        }
    </script>
@endsection