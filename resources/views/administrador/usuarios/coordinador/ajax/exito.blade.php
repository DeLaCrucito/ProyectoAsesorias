@extends('administrador.base')
@section('elementos')
    <form class="col s12" method="post" action="{{ route('saveunidad') }}" >
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Se guardó exitosamente</h4>
                    </blockquote>
                </div>
            </div>
            <div style="margin-top: 50px">
                <div class="row">
                    <div class="row center-align">
                        <a name="registros" id="registros" href="{{ route('viewcoordinador') }}" class="black-text light-blue accent-1 btn boton">Ver registros</a>
                        <br>
                        <a name="nuevo" id="nuevo" href="{{ route('newcoordinador') }}" class="white-text red darken-1 btn boton">Agregar Nuevo</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection