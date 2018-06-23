@extends('templates.admin')
@section('main')
    <div class="section">
        <div class="row" style="background-color: transparent" >
            <form class="col s12" method="post" action="{{ route('updatefacultad', $faculty->id) }}">
                {{ csrf_field() }}
                <div class="col s12 m12">
                    <div align="center">
                        <div class="row">
                            <div class="col s12 m12">
                                <div class="row center ">
                                    <div class="row col s12 m9">
                                        <blockquote>
                                            <h4 class="left-align thin white-text">Editar Facultad</h4>
                                        </blockquote>
                                    </div>
                                </div>
                                <div style="margin-top: 50px">
                                    @if ($errors->any())
                                        <div class="red darken-1 white-text" style="border-radius: 25px">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="input-field col s12 m12">
                                            <input class="white-text" type="text" value="{{ old('nombre', $faculty->nombre) }}" placeholder="Ingrese el nombre de la Facultad o Escuela" name="nombre" id="nombre"/>
                                            <label class="white-text" for="nombre">Nombre</label>
                                        </div>
                                    </div>
                                        <input type="hidden" name="id" id="id" value="{{ old('id', $faculty->id) }}">
                                    <div class="row col s12 m6" >
                                        <label><h6 class="white-text left-align">Nivel de Estudios</h6></label>
                                        <p>
                                            <input class="white-text" name="nivel" type="radio" id="bachillerato" @if (old('tipo', $faculty->tipo) === "Bachillerato") checked @endif  value="Bachillerato"/>
                                            <label class="white-text" for="bachillerato">Medio Superior</label>
                                        </p>
                                        <p>
                                            <input class="white-text" name="nivel" type="radio" id="licenciatura" @if (old('tipo', $faculty->tipo) === "Licenciatura") checked @endif value="Licenciatura"/>
                                            <label class="white-text" for="licenciatura">Superior</label>
                                        </p>
                                    </div>

                                </div>


                            </div>
                            <div class="row center-align">
                                <button type="submit" name="guardar"  class=" black-text light-blue accent-1 btn boton">Guardar</button>
                                <br>
                                <a name="nuevo" id="nuevo" href="{{ route('viewfacultad') }}" class="white-text red darken-1 btn boton">Cancelar</a>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection