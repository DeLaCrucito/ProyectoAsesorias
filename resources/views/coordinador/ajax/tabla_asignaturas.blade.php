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
            <td><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $subject->id }}"><span></span>Remover</a></td>

        </tr>
        <script>
            function ejecutaAccion() {
                window.location.href = '{{ route('delasignacion', ['id'=>$subject,
                                                   'consultant'=>$consultant]) }}'
            }

            function cierraModal() {
                $('#modal{{ $subject->id }}').modal('close');
            }
        </script>
    @endforeach
    </tbody>
</table>
{!! $subjects->links() !!}