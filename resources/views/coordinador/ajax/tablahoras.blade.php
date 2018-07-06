<table class="white-text highlight">
    <thead>
    <tr>
        <th>Dia</th>
        <th>Hora de Inicio</th>
        <th>Hora de fin</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($schedules as $schedule)
        <tr>
            <td>{{ $schedule->dia }}</td>
            <td>{{ $schedule->hr_inicio }}</td>
            <td>{{ $schedule->hr_fin }}</td>
            <td><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $schedule->id }}"><span></span>Eliminar</a></td>

        </tr>
        <script>
            function ejecutaAccion() {
                window.location.href = '{{ route('delhorario', ['id'=>$schedule,
                                                   'consultant'=>$consultant]) }}'
            }

            function cierraModal() {
                $('#modal{{ $schedule->id }}').modal('close');
            }
        </script>
    @endforeach
    </tbody>
</table>
{!! $schedules->links() !!}