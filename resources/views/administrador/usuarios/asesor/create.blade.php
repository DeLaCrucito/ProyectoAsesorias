@extends('templates.admin')
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

                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection