@extends('templates.admin')
@section('main')
    <div class="section">
        <div class="row" style="background-color: transparent" id="SolicitudAdd">
            <form class="col s12" method="post" action="{{ route('savelicenciatura') }}" >
                {{ csrf_field() }}
                <div class="col s12 m12">
                    <div align="center">
                        <div class="row">
                            <div class="col s12 m12">
                                <div class="row center ">
                                    <div class="row col s12 m9">
                                        <blockquote>
                                            <h4 class="left-align thin white-text">Nueva Licenciatura</h4>
                                        </blockquote>
                                    </div>
                                </div>
                                <div style="margin-top: 50px">
                                    <div class="row">
                                        <div class="input-field col s12 m12 white-text">
                                            <select id="facultad" name="facultad" required>
                                                <option disabled >Seleccione una facultad</option>
                                                @foreach($facultads as $facultad)
                                                    <option value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <label class="white-text">Facultad</label>
                                        </div>
                                        <div class="input-field col s12 m12">
                                            <input class="white-text" type="text" name="nombre" id="nombre"/>
                                            <label class="white-text" for="nombre">Nombre de la licenciatura</label>
                                        </div>
                                    </div>

                                </div>


                            </div>
                            <div class="row center-align">
                                <button type="submit" name="guardar"  class=" black-text light-blue accent-1 btn boton">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection