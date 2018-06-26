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
                    <div class="input-field col s12 m5 white-text">
                        <select id="facultad" name="facultad" onchange="realizaProceso(this.value)" required>
                            <option disabled selected="selected">Seleccione un tipo de usuario</option>
                            <option value="Alumno">Alumno</option>
                            <option value="Asesor">Asesor</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection