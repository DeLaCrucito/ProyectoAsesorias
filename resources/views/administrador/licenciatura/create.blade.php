@extends('administrador.base')
@section('elementos')
    <form class="col s12" method="post" action="{{ route('savelicenciatura') }}">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Nueva Licenciatura</h4>
                    </blockquote>
                </div>
            </div>
            @if ($errors->any())
                <div class="red darken-1 white-text" style="border-radius: 25px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div style="margin-top: 50px">
                <div class="row">
                    <div class="input-field col s12 m5 white-text">
                        <select id="facultad" name="facultad" required>
                            <option disabled selected="selected">Seleccione una facultad</option>
                            @foreach($facultads as $facultad)
                                <option value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                            @endforeach
                        </select>
                        <label class="white-text">Facultad</label>
                    </div>
                    <div class="input-field col s12 m7">
                        <input class="white-text" type="text" placeholder="Ingrese el nombre de la licenciatura"
                               name="nombre" id="nombre"/>
                        <label class="white-text" for="nombre">Nombre de la licenciatura</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row center-align">
            <button type="submit" name="guardar" class=" black-text light-blue accent-1 btn boton">Guardar
            </button>
        </div>
    </form>
@endsection