<table class="white-text highlight responsive-table">
    <thead>
    <tr>
        <th>Unidad de Aprendizaje</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($solicituds as $solicitud)
        <tr>
            <td>{{ $solicitud->subject->nombre }}</td>
            <td>{{ $solicitud->fecha->diffForHumans() }}</td>
            <td>{{ date('h:i a',strtotime($solicitud->horario)) }}</td>
            <td><a name="cancel" style=" cursor: default;" id="cancel" data-position="top" data-delay="10" data-tooltip="No completada" class="black-text red btn-floating tooltipped"><i class="material-icons">close</i></a></td>
            <td><a class="white-text" href="">VER DETALLES</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $solicituds->links() !!}