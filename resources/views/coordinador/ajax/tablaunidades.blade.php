<table class="white-text highlight">
    <thead>
    <tr>
        <th>Unidad de Aprendizaje</th>
        <th>Semestre</th>
        <th>Tipo de asignatura</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subjects as $subject)
        <tr>
            <td>{{ $subject->nombre }}</td>
            <td>{{ $subject->semestre }}</td>
            <td>{{ $subject->tipo }}</td>
            <td><a class="tooltipped" data-position="top" data-delay="50"
                   data-tooltip="Podrá consultar los detalles de la unidad, así como ver los
                                           asesores que imparten la materia" href="{{ route('coordetalleunidad',
                                           $subject) }}" >Ver
                    detalles</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $subjects->links() !!}