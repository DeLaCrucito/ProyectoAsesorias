@extends('templates.base')

@section('header')
    <div class="left-align">
        <a href="" class="center white-text"><h4></h4></a>
        <a data-activates="slide-out" class="button-collapse"></a>
    </div>
@endsection
@section('aside')
    <ul id="slide-out" class="side-nav fixed grey darken-4">
        <li>
            <div class="user-view">
                <div>
                    <img src="">
                </div>
                <a href=""><img class="circle" src="https://pbs.twimg.com/profile_images/677225147703496704/bI3kWrjm.png"></a>
                <h6 class="white-text">Coordinador</h6>
            </div>
        </li>
        <li>
            <a  href="{{route('coordinadorhome')}}" class="white-text left-align"><i class="material-icons">home</i>Inicio</a>
        </li>
        <li>
            <a  href="{{route('viewunidad')}}" class="white-text left-align"><i class="material-icons">class</i>Unidades de Aprendizaje</a>
        </li>
        <li>
            <a  href="{{route('verasesores')}}" class="white-text left-align"><i
                        class="material-icons">account_circle</i>Asesores</a>
        </li>
        <li>
            <a  href="{{route('viewusuarios')}}" class="white-text left-align"><i
                        class="material-icons">account_circle</i>Solicitudes</a>
        </li>
        <li>
            <a href="{{ route('coordinadorlogout') }}" class="white-text left-align"><i class="material-icons">exit_to_app</i>Cerrar
                Sesión</a>
        </li>
    </ul>
@endsection

@section('footer')
    <div class="row">
        <div class="container left-align">
            <div class="">
                <div class="col s12 m12">
                    <h6 class="white-text center-align">Universidad Autónoma de Campeche</h6>
                    <p class="white-text center-align">Portal de Aseorías</p>
                    <p class="center-align white-text thin">© 2018 Copyright</p>
                </div>
            </div>

        </div>
    </div>


@endsection
