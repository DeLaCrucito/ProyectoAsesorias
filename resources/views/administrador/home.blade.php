@extends('administrador.base')
@section('elementos')
    <div align="center">
        <div class="row">
            <div class="col s12 m12">
                <div class="row center ">
                    <div class=" col s12 m9">
                        <blockquote>
                            <h4 class="left-align thin white-text">Bienvenido</h4>
                        </blockquote>
                    </div>
                </div>
                <div class="center-align" style="margin-top: 50px">
                    <div class="row col s12 m12">
                        <div class="input-field col s12 m6">
                            <input type="text" disabled name="Nombre" id="Nombre" value="{{ \Illuminate\Support\Facades\Auth::user()->usuario }}" class="white-text"/>
                            <label class="white-text" for="Nombre">Nombre de usuario</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input class="white-text" type="text" id="licenciatura" disabled value="{{ \Illuminate\Support\Facades\Auth::user()->correo }}"
                            name="licenciatura">
                            <label class="white-text" for="licenciatura">Correo</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection