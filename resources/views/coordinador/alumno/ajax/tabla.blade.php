<table class="white-text highlight responsive-table">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Matricula</th>
        <th>Semestre</th>
        <th>Solicitudes</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td width="40%">{{ $student->nombre ." ". $student->apellido}}</td>
            <td width="10%">{{ $student->matricula }}</td>
            <td>{{ $student->semestre }}</td>
            <td>{{ $solicituds = (new App\Models\Request)->where('alumno','=',$student->id)->count() }}</td>
            <td><a href="{{ route('studentedit', encrypt($student->id)) }}" >Ver detalles</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@unless (count($students))
    <p class="white-text center-align">No se encontraron alumnos registrados.</p>
@endunless
{!! $students->links() !!}

