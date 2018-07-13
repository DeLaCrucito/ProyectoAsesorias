<table class="white-text highlight centered">
    <thead>
    <tr>
        <th>Dia</th>
        <th>Horario disponible</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($schedules as $schedule)
        <tr>
            <td>{{ $schedule->dia }}</td>
            <td>{{ \Carbon\Carbon::createFromTimeString($schedule->hr_inicio)->format('h:i
                                    A') .' - '. Carbon\Carbon::createFromTimeString($schedule->hr_fin)->format
                                    ('h:i A') }}</td>
            <td><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $schedule->id }}"><span></span>Eliminar</a></td>

        </tr>
        <div id="modal{{ $schedule->id }}" class="modal">
            <div class="modal-content">
                <h5>Esta acción no se puede deshacer</h5>
                <p>¿Seguro que desea eliminar el horario con el día {{
                                                   $schedule->dia .' y horario '. $schedule->hr_inicio .' - '.
                                                   $schedule->hr_fin
                                                   }} para el asesor {{$consultant->nombre . ' '.
                                                   $consultant->apellido}}?</p>
            </div>
            <div class="modal-footer">
                <a id="#disagree" onclick=" $('#modal{{ $schedule->id }}').modal('close');" class="modal-action modal-close waves-effect
                                            waves-red btn-flat">Cancelar</a>
                <a id="#agree" href="{{ route('delhorario', ['id'=>encrypt($schedule->id),
                                                   'consultant'=>encrypt($consultant->id)]) }}" class="modal-action modal-close waves-effect
                                            waves-green btn-flat">Aceptar</a>
            </div>
        </div>
    @endforeach
    </tbody>
</table>
@unless (count($schedules))
    <p class="white-text center-align">No existen horarios.</p>
@endunless
{!! $schedules->links() !!}