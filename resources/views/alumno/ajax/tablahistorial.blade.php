<table class="white-text highlight responsive-table">
    <thead>
    <tr>
        <th>Unidad de Aprendizaje</th>
        <th>Cita</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($solicituds as $solicitud)
        <tr>
            <td>{{ $solicitud->subject->nombre }}</td>
            <td>{{ $solicitud->fecha->diffForHumans() }}</td>
            <td>{{ $solicitud->fecha->format('l, d F Y, h:i a') }}</td>
            <td><a style=" cursor: default;"  data-position="top" data-delay="10"
                   data-tooltip="{{ $solicitud->state->mensaje }}" class="black-text {{
                                           $solicitud->state->color }} btn-floating tooltipped"><i
                            class="material-icons">{{ $solicitud->state->icon }}</i></a></td>
            <td><a href="{{ route('detallesolicitud',['id'=>encrypt($solicitud->id)]) }}"
                   class="btn-flat white-text"><span></span>Ver Detalles</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $solicituds->links() !!}