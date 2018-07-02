@extends('templates.coordinador')
@section('main')
    <div class="section">
        <div class="row" style="background-color: transparent">
            <div class="col s12 m12">
                <div align="center">
                    <div class="row">
                        @yield('elementos')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection