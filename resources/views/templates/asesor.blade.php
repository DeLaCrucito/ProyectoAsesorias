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
                <img class="circle" src="{{ asset('images/asesorias.jpg') }}">
                <h6 class="white-text">Portal de Asesorías</h6>
                <h6 class="white-text">ASESOR</h6>
                <h6 class="white-text thin">{{ \Illuminate\Support\Facades\Auth::user()->nombre.' '
                .\Illuminate\Support\Facades\Auth::user()->apellido }}</h6>
                <h6 class="white-text thin">{{ \Illuminate\Support\Facades\Auth::user()->correo }}</h6>
            </div>
        </li>
        <li>
            <a  href="{{route('asesorhome')}}" class="white-text left-align"><i class="material-icons">home</i>Inicio</a>
        </li>
        <li>
            <a  href="{{route('mismaterias')}}" class="white-text left-align"><i class="material-icons">book</i>Mis Materias</a>
        </li>
        <li>
            <a  href="{{route('mishoras')}}" class="white-text left-align"><i class="material-icons">alarm</i>Mi Horario</a>
        </li>
        <li>
            <a  href="{{route('solicituduser')}}" class="white-text left-align"><i class="material-icons">storage</i>@if($nuevas != 0)
                    <span style="border-radius: 15px" class="new badge
                        red darken-2 white-text" data-badge-caption="En proceso">{{ $nuevas }}</span>
                @endif Solicitudes</a>
        </li>
        <li>
            <a href="#signout" class="white-text btn-flat left-align  modal-trigger"><span></span><i
                        class="material-icons">exit_to_app</i>Cerrar
                Sesión</a>
        </li>
    </ul>
    <div id="signout" class="modal">
        <div class="modal-content">
            <h5>Cerrar sesión</h5>
            <p>¿Desea finalizar esta sesión?</p>
        </div>
        <div class="modal-footer">
            <a id="" onclick="$('#signout').modal('close');" class="modal-action modal-close waves-effect
                                            waves-red btn-flat">Cancelar</a>
            <a id="" onclick="window.location.href = '{{ route('asesorlogout') }}'" class="modal-action modal-close waves-effect
                                            waves-green btn-flat">Aceptar</a>
        </div>
    </div>
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
