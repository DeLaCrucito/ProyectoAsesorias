@extends('administrador.base')
@section('elementos')
    <form class="col s12" method="post">
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Criterios de Evaluación</h4>
                    </blockquote>
                </div>
            </div>
            <div style="margin-top: 50px">
                <div class="row">
                    <div class="posts row" id="posts">
                        <table class="white-text highlight">
                            <thead>
                            <tr>
                                <th>Acción</th>
                                <th>Mínimo</th>
                                <th>Máximo</th>
                                <th>Aprovechamiento</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exploitations as $exploitation)
                                <tr>
                                    <td><a href="{{ route('editaprovechamiento', $exploitation->id) }}">Modificar</a></td>
                                    <td>{{ $exploitation->min }}</td>
                                    <td>{{ $exploitation->max }}</td>
                                    <td>{{ $exploitation->nivel }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection