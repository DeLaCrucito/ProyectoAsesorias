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
            <td><a class="btn-flat blue-text"
                   onclick="if (confirm('¿Seguro que desea asignar' +
                        ' esta ' +
                        'materia?')) {
                        window.location.href = '{{ route('asignar', ['subject'=>$subject, 'consultant'=>$consultant])
                        }}';
                        }"><span></span>Asignar</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $subjects->links() !!}