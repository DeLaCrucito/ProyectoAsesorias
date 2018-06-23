<table class="white-text highlight">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($facultads as $facultad)
        <tr>
            <td>{{ $facultad->nombre }}</td>
            <td><a href="{{ route('editfacultad', $facultad) }}" >Ver detalles</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $facultads->links() !!}

