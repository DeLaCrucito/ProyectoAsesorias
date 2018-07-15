@extends('asesor.base')
@section('elementos')
    <form class="col s12" method="post" >
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Detalles de Unidad de Aprendizaje</h4>
                    </blockquote>
                </div>
            </div>
            <div style="margin-top: 50px">
                <div class="row">
                    <div class="input-field col s12 m12 white-text">
                        <input type="text" class="white-text disabled" disabled id="facultad" value="{{
                        $subject->degree->faculty->nombre }}">
                        <label class="white-text" for="facultad">Facultad</label>
                    </div>
                    <div id="cajalicen" class="input-field col s12 m6 white-text ">
                        <input type="text" class="white-text disabled" disabled id="licen" value="{{ $subject->degree->nombre
                         }}">
                        <label for="licen" class="white-text">Licenciatura</label>
                    </div>
                    <div class="input-field col s12 m6 " id="oculto2">
                        <input class="white-text" class="white-text disabled" disabled type="text" name="nombre" id="nombre"
                               value="{{ $subject->nombre }}"/>
                        <label class="white-text" for="nombre">Nombre de la unidad de aprendizaje</label>
                    </div>

                    <div id="oculto4" class="input-field col s6 m3 white-text ">
                        <input type="text" class="white-text disabled" id="semestre" disabled value="{{ $subject->semestre }}"/>
                        <label for="semestre" class="white-text">Semestre</label>
                    </div>

                    <div class=" input-field row col s6 m3 " id="oculto3">
                        <input class="white-text" class="white-text disabled" disabled readonly name="fase" id="fase"
                               value="{{ $subject->fase }}"/>
                        <label class="white-text active" for="fase">Ciclo Escolar (Fase)</label>
                    </div>

                    <div class=" input-field col s12 m3 " id="oculto6">
                        <input class="white-text" disabled readonly type="text" name="tipo" id="tipo"
                               value="{{ $subject->tipo }}"/>
                        <label class="white-text active" for="tipo">Tipo de asignatura</label>
                    </div>

                    <div class="input-field col s12 m3 " id="oculto5">
                        <input class="white-text" type="text" disabled name="clave" id="clave"
                               value="{{ $subject->clave }}"/>
                        <label class="white-text" for="clave">Clave</label>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection