<table class="white-text highlight">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($consultants as $consultant)
        <tr>
            <td>{{ $consultant->nombre ." ". $consultant->apellido}}</td>
            <td>{{ $consultant->correo }}</td>
            <td><a href="{{ route('editasesor', $consultant->id) }}" >Ver detalles</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $consultants->links() !!}

