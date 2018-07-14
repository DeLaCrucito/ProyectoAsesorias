@extends('templates.admin')
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
@section('scripts')
    <script>
        function continuar(caja) {
            var finalizar = document.getElementById('#agree');
            finalizar.getAttribute('class');
            if (caja.checked === true) {
                finalizar.setAttribute('class', 'modal-action modal-close waves-effect white-text waves-green btn-flat');
            } else if (caja.checked === false) {
                finalizar.setAttribute('class', 'disabled modal-action modal-close waves-effect white-text waves-green btn-flat');
            }
        }
    </script>
@endsection