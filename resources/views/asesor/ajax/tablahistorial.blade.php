<table class="white-text highlight responsive-table">
    <thead>
    <tr>
        <th>Alumno</th>
        <th>Materia</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>

    @foreach($solicituds as $solicitud)
        <tr>
            <td width="25%">{{ $solicitud->student->nombre .' '.$solicitud->student->apellido
                                    }}</td>
            <td width="35%">{{ $solicitud->subject->nombre }}</td>
            <td>{{ $solicitud->fecha->format('d M Y, h:i A') }}</td>
            <td><a style=" cursor: default;"  data-position="top" data-delay="10"
                   data-tooltip="{{ $solicitud->state->mensaje }}" class="black-text {{
                                           $solicitud->state->color }} btn-floating tooltipped"><i
                            class="material-icons">{{ $solicitud->state->icon }}</i></a></td>
            <td><a href="{{ route('lasoli',['id'=>encrypt($solicitud->id)]) }}"
                   class="btn-flat white-text"><span></span>Detalles </a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@unless (count($solicituds))
    <p class="white-text center-align">No se encontraron solicitudes.</p>
@endunless
{!! $solicituds->links() !!}