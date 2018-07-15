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