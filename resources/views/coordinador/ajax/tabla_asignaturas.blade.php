<table class="white-text highlight">
    <thead>
    <tr>
        <th>Unidad de Aprendizaje</th>
        <th>Semestre</th>
        <th>Tipo</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subjects as $subject)
        <tr>
            <td>{{ $subject->subject->nombre }}</td>
            <td>{{ $subject->subject->semestre }}</td>
            <td>{{ $subject->subject->tipo }}</td>
            <td><a href="{{ route('asignacion', $subject->subject->id) }}" >Desasignar</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $subjects->links() !!}