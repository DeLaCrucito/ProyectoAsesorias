@extends('administrador.base')
@section('elementos')
    <form class="col s12" method="post" action="" >
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Usuarios</h4>
                    </blockquote>
                </div>
            </div>
            <div style="margin-top: 50px">
                <div class="row">
                    <div class="input-field col s12 m4 white-text">
                        <h5>Asesores</h5>
                        <a name="cancel" id="cancel" href="{{ route('viewasesor') }}" class="white-text  indigo darken-1 btn boton">Ver Asesores</a>
                        <a name="cancel" id="cancel" href="{{ route('newasesor') }}" class="white-text red darken-1 btn boton">Agregar Nuevo</a>
                    </div>
                    <div class="input-field col s12 m4 white-text">
                        <h5>Alumnos</h5>
                        <a name="cancel" id="cancel" href="{{ route('viewalumno') }}" class="white-text  indigo darken-1 btn boton">Ver Alumnos</a>
                        <a name="cancel" id="cancel" href="{{ route('newalumno') }}" class="white-text red darken-1 btn boton">Agregar Nuevo</a>
                    </div>
                    <div class="input-field col s12 m4 white-text">
                        <h5>Coordinadores</h5>
                        <a name="cancel" id="cancel" href="{{ route('viewcoordinador') }}" class="white-text  indigo darken-1 btn boton">Ver Coordinadores</a>
                        <a name="cancel" id="cancel" href="{{ route('newcoordinador') }}" class="white-text red darken-1 btn boton">Agregar Nuevo</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection