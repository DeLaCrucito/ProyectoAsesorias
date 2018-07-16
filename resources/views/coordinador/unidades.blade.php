@extends('coordinador.base')
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
            <div style="margin-top: 50px">
                <div class="row">
                    <div id="cajasemestre" class="input-field col s12 m6 white-text">
                        <select id="semestre" onchange="mostrarTabla(this.value)" name="semestre"  required>
                            <option disabled selected="selected">Seleccione un semestre</option>
                            @foreach(range(1,$degree->semestres) as $semestre)
                                <option value="{{ $semestre }}">{{ $semestre }}</option>
                            @endforeach
                        </select>
                        <label for="semestre" class="white-text">Semestre</label>
                    </div>

                </div>
                <div class="posts row" id="posts">
                    <table class="white-text highlight responsive-table">
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
                                <td width="50%">{{ $subject->nombre }}</td>
                                <td>{{ $subject->semestre }}</td>
                                <td>{{ $subject->tipo }}</td>
                                <td><a class="tooltipped" data-position="top" data-delay="50"
                                       data-tooltip="Podrá consultar los detalles de la unidad, así como ver los
                                           asesores que imparten la materia" href="{{ route('coordetalleunidad',
                                           ['id'=>encrypt($subject->id)]) }}" >Ver
                                        detalles</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $subjects->links() !!}

                </div>
            </div>
        </div>
    </form>
    <script>

        function mostrarTabla(val) {
            $.ajax({
                type: 'post',
                url: '{{route('coorajaxunidades')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    semestre: val
                },
                success: function (response) {
                    document.getElementById('posts').innerHTML = response.html;
                }
            });
        }

        function cargaTabla(page) {
            var semestre = document.getElementById('semestre').value;
            $.ajax({
                data: {
                    semestre: semestre
                },
                url:'?page='+page
            }).done(function (data) {
                console.log(data);
                $('.posts').html(data);
            })
        }
    </script>
@endsection