<table class="white-text highlight">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($degrees as $degree)
        <tr>
            <td>{{ $degree->nombre }}</td>
            <td><a href="{{ route('editlicenciatura', $degree) }}" >Ver detalles</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $degrees->links() !!}

