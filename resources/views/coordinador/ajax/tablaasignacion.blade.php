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
            <td><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $subject->id }}"><span></span>Asignar</a></td>
        </tr>
        <script>
            function ejecutaAccion() {
                window.location.href = '{{ route('asignar', ['subject'=>$subject, 'consultant'=>$consultant]) }}'
            }

            function cierraModal() {
                $('#modal{{ $subject->id }}').modal('close');
            }
        </script>
    @endforeach
    </tbody>
</table>
{!! $subjects->links() !!}