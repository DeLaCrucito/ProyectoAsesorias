@extends('templates.alumno')
@section('main')
    <div class="section">
        <div class="row" style="background-color: transparent" id="SolicitudAdd">
            <form class="col s12" method="post">
                {{ csrf_field() }}
                <div class="col s12 m12">
                    <div align="center">
                        <div class="row">
                            <div class="col s12 m12">
                                <div class="row center ">
                                    <div class="row col s12 m9">
                                        <blockquote>
                                            <h4 class="left-align thin white-text">Historial de solicitud</h4>
                                        </blockquote>
                                    </div>
                                </div>
                                <div style="margin-top: 50px">
                                    <div class="row">                                                
                                        <p class="white-text center-align">* Usted puede filtrar los datos con las siguientes opciones.</p>
                                        <div class="input-field col s12 m6 white-text">
                                            <select id="Unidads" name="Unidads" >
                                                <option value="" disabled selected>Buscar por Unidad de Aprendizaje</option>
                                                <option value="asda">unidad x</option>
                                            </select>
                                            <label class="white-text">Unidad de Aprendizaje</label>
                                        </div>
                                        <div class="input-field col s12 m6 white-text">
                                            <select id="Estados" name="Estados" >
                                                <option value="" disabled selected>Buscar por estado</option>
                                                <option value="asda">estado x</option>
                                            </select>
                                            <label class="white-text">Estado</label>
                                        </div>
                                    </div>
                                    <table class="white-text highlight responsive-table">
                                        <thead>
                                        <tr>
                                            <th>Folio</th>
                                            <th>Unidad de Aprendizaje</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr>
                                            <td>123</td>
                                            <td>Quimica</td>
                                            <td>05-02-2018</td>
                                            <td><a name="cancel" style=" cursor: default;" id="cancel" data-position="top" data-delay="10" data-tooltip="No completada" class="black-text red btn-floating tooltipped"><i class="material-icons">close</i></a></td>
                                            <td><a class="white-text" href="">VER DETALLES</a></td>
                                        </tr>
                                        <tr>
                                            <td>121</td>
                                            <td>Calculo Integral</td>
                                            <td>02-12-2018</td>
                                            <td><a name="cancel" style=" cursor: default;" id="cancel" data-position="top" data-delay="10" data-tooltip="Completada con éxito" class="black-text green btn-floating tooltipped"><i class="material-icons">check</i></a></td>
                                            <td><a class="white-text" href="">VER DETALLES</a></td>

                                        </tr>
                                        <tr>
                                            <td>124</td>
                                            <td>Ecuaciones diferenciales</td>
                                            <td>11-08-2018</td>
                                            <td><a name="cancel" style="cursor: default;" id="cancel" data-position="top" data-delay="10" data-tooltip="Se realiza hoy" class="black-text blue btn-floating tooltipped"><i class="material-icons">event_available</i></a></td>
                                            <td><a class="white-text" href="">EVALUAR</a></td>

                                        </tr>
                                        <tr>
                                            <td>124</td>
                                            <td>Ecuaciones diferenciales</td>
                                            <td>11-08-2018</td>
                                            <td><a name="cancel" style=" cursor: default;" id="cancel" data-position="top" data-delay="10" data-tooltip="Pendiente" class="black-text purple btn-floating tooltipped"><i class="material-icons">access_alarm</i></a></td>
                                            <td><a class="white-text" href="">VER DETALLES</a></td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection