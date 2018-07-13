<table class="white-text highlight">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Especialidad</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($consultants as $consultant)
        <tr>
            <td>{{ $consultant->nombre ." ". $consultant->apellido}}</td>
            <td>{{ $consultant->especialidad }}</td>
            <td><a href="{{ route('detalleasesor', $consultant->id) }}" >Ver detalles</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@unless (count($consultants))
    <p class="white-text center-align">No existen asesores.</p>
@endunless
{!! $consultants->links() !!}
