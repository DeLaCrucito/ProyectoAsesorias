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
                    <h5 class="white-text">Nueva materia para {{ $consultant->nombre . ' ' .
                    $consultant->apellido
                    }}</h5>
                    <div id="cajasemestre" class="input-field col s12 m6 white-text">
                        <select id="semestre" onchange="mostrarTabla(this.value)" name="semestre"  required>
                            <option disabled selected="selected">Seleccione un semestre</option>
                            @foreach(range(1,$degree->semestres) as $semestre)
                                <option value="{{ $semestre }}">{{ $semestre }}</option>
                            @endforeach
                        </select>
                        <label for="semestre" class="white-text">Semestre de la unidad de aprendizaje</label>
                    </div>
                    @if(session()->has('message'))
                        <div class="red darken-1 white-text col s12 m12" style="border-radius: 25px">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <input type="hidden" id="asesor" value="{{ $consultant->id }}">
                    <div class="posts row" id="posts">
                    </div>
                </div>
            </div>
        </div>
        @foreach($subjects as $subject)
            <div id="modal{{ $subject->id }}" class="modal">
                <div class="modal-content">
                    <h5>Podrá remover la materia posteriormente</h5>
                    <p>¿Desea asignar la materia {{
                                                   $subject->nombre }} al asesor
                        {{$consultant->nombre . ' '. $consultant->apellido}}?</p>
                </div>
                <div class="modal-footer">
                    <a id="#disagree" onclick="cierraModal()" class="modal-action modal-close waves-effect
                                            waves-red btn-flat">Cancelar</a>
                    <a id="#agree" onclick="ejecutaAccion()" class="modal-action modal-close waves-effect
                                            waves-green btn-flat">Aceptar</a>
                </div>
            </div>
        @endforeach
    </form>
    <script>
        function mostrarTabla(val) {
            var asesor = document.getElementById('asesor').value;
            $.ajax({
                type: 'post',
                url: '{{route('tbasignacion')}}',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: {
                    semestre: val,
                    asesor: asesor
                },
                success: function (response) {
                    document.getElementById('posts').innerHTML = response.html;
                }
            });
        }

        function cargaTabla(page) {
            var semestre = document.getElementById('semestre').value;
            var asesor = document.getElementById('asesor').value;
            $.ajax({
                data: {
                    semestre: semestre,
                    asesor: asesor
                },
                url:'?page='+page
            }).done(function (data) {
                console.log(data)
                $('.posts').html(data);
            })
        }
    </script>
@endsection