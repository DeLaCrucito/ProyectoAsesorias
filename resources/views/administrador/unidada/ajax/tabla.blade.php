<table class="white-text highlight">
    <thead>
    <tr>
        <th>Unidad de Aprendizaje</th>
        <th>Tipo de asignatura</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subjects as $subject)
        <tr>
            <td>{{ $subject->nombre }}</td>
            <td>{{ $subject->tipo }}</td>
            <td><a href="{{ route('editunidad', $subject) }}" >Ver detalles</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $subjects->links() !!}

