@extends('asesor.base')
@section('elementos')
    <div class="section">
        <div class="row" style="background-color: transparent">
            {{ csrf_field() }}
            <div class="col s12 m12">
                <div align="center">
                    <div class="row">
                        <div class="col s12 m12">
                            <div class="row center ">
                                <div class=" col s12 m9">
                                    <blockquote>
                                        <h4 class="left-align thin white-text">Asesor</h4>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="center-align" style="margin-top: 50px">
                                <div class="row col s12 m12">
                                    <div class="input-field col s12 m9">
                                        <input type="text" disabled name="Nombre" id="Nombre" value="{{
                                        $consultant->nombre .' '.$consultant->apellido
                                         }}"
                                               class="white-text"/>
                                        <label class="white-text" for="Nombre">Nombre</label>
                                    </div>
                                    <div class="input-field col s12 m10">
                                        <input class="white-text" type="text" id="correo" disabled value="{{
                                        $consultant->correo }}"
                                               name="correo">
                                        <label class="white-text" for="correo">Correo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row col s12 m12" style="display: inline-flex">
                                <div class="row col s12 m6">
                                    <table class="white-text centered">
                                        <thead>
                                        <tr>
                                            <th>Aprovechamiento de alumnos</th>
                                            <th>Porcentaje</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Insuficiente</td>
                                            <td>{{ $insuficientes }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Satisfactorio</td>
                                            <td>{{ $satisfactorios }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Bueno</td>
                                            <td>{{ $buenos }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Excelente</td>
                                            <td>{{ $excelentes }}%</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection