@extends('administrador.base')
@section('elementos')

    @foreach($schedules as $schedule)
        <h5>{{ $schedule->hr_inicio }}</h5>
    @endforeach
@endsection