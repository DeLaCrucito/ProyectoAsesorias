<table class="white-text highlight">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Licenciatura</th>
        <th>Acciones</th>
        <th>Borrado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->nombre ." ". $student->apellido}}</td>
            <td>{{ $student->correo }}</td>
            <td>{{ $student->degree->nombre }}</td>
            <td><a href="{{ route('editalumno', $student->id) }}" >Ver detalles</a></td>
            <td><a href="{{ route('deletealumno', $student->id) }}">Eliminar</a> </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $students->links() !!}

