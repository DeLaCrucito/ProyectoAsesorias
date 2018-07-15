@extends('asesor.base')
@section('elementos')
    <form class="col s12" method="post" >
        {{ csrf_field() }}
        <div class="col s12 m12">
            <div class="row center ">
                <div class="row col s12 m9">
                    <blockquote>
                        <h4 class="left-align thin white-text">Mi Horario</h4>
                    </blockquote>
                </div>
            </div>
            @if(session()->has('message'))
                <div class="green darken-4 white-text col s12 m12 center-align" style="border-radius: 25px">
                    <h5>{{ session()->get('message') }}</h5>
                </div><br>
            @endif
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
                <div class="col s12 m12">
                    <div class="posts row" id="posts">
                        <table class="white-text highlight centered">
                            <thead>
                            <tr>
                                <th>Dia</th>
                                <th>Horario disponible</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->dia }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimeString($schedule->hr_inicio)->format('h:i
                                    A') .' - '. Carbon\Carbon::createFromTimeString($schedule->hr_fin)->format
                                    ('h:i A') }}</td>
                            @endforeach
                            </tbody>
                        </table>
                        @unless (count($schedules))
                            <p class="white-text center-align">No existen horarios.</p>
                        @endunless
                        {!! $schedules->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        function cargaTabla(page) {
            $.ajax({
                url:'?page='+page
            }).done(function (data) {
                $('.posts').html(data);
                $('.modal').modal();
                $('.tooltipped').tooltip({delay: 50});
            })
        }
    </script>
    <script>

    </script>
@endsection