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
            <td><a href="{{ route('lamateria', ['id'=>encrypt($subject->id)]) }}" >Ver
                    detalles</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@unless (count($subjects))
    <p class="white-text center-align">No existen Unidades de Aprendizaje.</p>
@endunless
{!! $subjects->links() !!}