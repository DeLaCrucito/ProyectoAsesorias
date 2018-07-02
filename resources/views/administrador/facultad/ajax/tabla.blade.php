<table class="white-text highlight">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Acciones</th>
        <th>Borrar</th>
    </tr>
    </thead>
    <tbody>
    @foreach($facultads as $facultad)
        <tr>
            <td>{{ $facultad->nombre }}</td>
            <td><a href="{{ route('editfacultad', $facultad) }}" >Ver detalles</a></td>
            <td><a href="{{ route('deletefacultad', $facultad->id) }}">Eliminar</a> </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $facultads->links() !!}

