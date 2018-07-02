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
    @foreach($coordinators as $coordinator)
        <tr>
            <td>{{ $coordinator->nombre ." ". $coordinator->apellido}}</td>
            <td>{{ $coordinator->correo }}</td>
            <td>{{ $coordinator->degree->nombre }}</td>
            <td><a href="{{ route('editcoordinador', $coordinator->id) }}" >Ver detalles</a></td>
            <td><a href="{{ route('deletecoordinador', $coordinator->id) }}">Eliminar</a> </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $coordinators->links() !!}

