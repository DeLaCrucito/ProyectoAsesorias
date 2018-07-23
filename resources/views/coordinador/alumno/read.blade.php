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
                        <h4 class="left-align thin white-text">Alumnos</h4>
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

                    <div id="cajasemestre" class="input-field col s12 m4 white-text ">
                        <select id="semestre" onchange="mostrarTabla(this.value)" name="semestre"  required>
                            <option disabled value="0" selected="selected">Seleccione un semestre</option>
                            @foreach(range(1,\Illuminate\Support\Facades\Auth::user()->degree->semestres) as $semestre)
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
                            <th>Nombre</th>
                            <th>Matricula</th>
                            <th>Semestre</th>
                            <th>Solicitudes</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td width="40%">{{ $student->nombre ." ". $student->apellido}}</td>
                                <td width="10%">{{ $student->matricula }}</td>
                                <td>{{ $student->semestre }}</td>
                                <td>{{ $solicituds = (new App\Models\Request)->where('alumno','=',$student->id)->count() }}</td>
                                <td><a href="{{ route('studentedit', encrypt($student->id)) }}" >Ver detalles</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @unless (count($students))
                        <p class="white-text center-align">No se encontraron alumnos registrados.</p>
                    @endunless
                    {!! $students->links() !!}


                </div>
            </div>
        </div>
    </form>
    <script>
        function mostrarTabla(val) {
            $.ajax({
                type: 'post',
                url: '{{route('misalumnostable')}}',
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
                    $('.modal').modal();
                    $('.tooltipped').tooltip({delay: 50});
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
                console.log(data)
                $('.posts').html(data);
                $('.modal').modal();
                $('.tooltipped').tooltip({delay: 50});
            })
        }
    </script>
@endsection