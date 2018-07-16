<table class="white-text highlight responsive-table">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Especialidad</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($consultants as $consultant)
        <tr>
            <td width="40%">{{ $consultant->nombre ." ". $consultant->apellido}}</td>
            <td width="40%">{{ $consultant->especialidad }}</td>
            <td><a class="tooltipped" data-position="top" data-delay="50"
                   data-tooltip="Consultar detalles de materias y horarios"
                   href="{{ route('detalleasesor', ['id'=>encrypt($consultant->id)]) }}" >Ver
                    detalles</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@unless (count($consultants))
    <p class="white-text center-align">No existen asesores.</p>
@endunless
{!! $consultants->links() !!}