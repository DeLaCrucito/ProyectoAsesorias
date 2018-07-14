<table class="white-text highlight">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Matricula</th>
        <th>Solicitudes</th>
        <th>Acciones</th>
        <th>Borrado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->nombre ." ". $student->apellido}}</td>
            <td>{{ $student->matricula }}</td>
            <td>{{ $solicituds = (new App\Models\Request)->where('alumno','=',$student->id)->count() }}</td>
            <td><a href="{{ route('editalumno', encrypt($student->id)) }}" >Ver detalles</a></td>
            <td><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $student->id }}"><span></span>Eliminar</a></td>
        </tr>
        <div id="modal{{ $student->id }}" class="modal">
            <div class="modal-content red darken-4">
                <h1 class="white-text">ADVERTENCIA</h1>
                <p class="white-text">Esta acción no se puede deshacer. Se borrarán todos los datos relacionados con
                    el alumno {{$student->nombre .' '.$student->apellido }} incluyendo solicitudes
                    registradas ¿Realmente desea eliminar a {{$student->nombre .' '.$student->apellido}}?</p>
                <div class="center-align">
                    <div style="display: inline-flex">
                        <input type="checkbox" style="background-color: #FFFFFF" onclick="continuar(this)" class="filled-in"
                               id="validar"/>
                        <label class="white-text" for="validar">Deseo contiuar</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer red darken-4">
                <a id="#disagree" onclick="$('#modal{{ $student->id }}').modal('close');" class="modal-action modal-close
                                            waves-effect waves-red btn-flat white-text">Cancelar</a>
                <a id="#agree" href="{{ route('deletealumno', ['id'=>encrypt($student->id)]) }}"
                   class="disabled modal-action modal-close waves-effect white-text waves-green btn-flat">Aceptar</a>
            </div>
        </div>
    @endforeach
    </tbody>
</table>
@unless (count($students))
    <p class="white-text center-align">No se encontraron alumnos registrados.</p>
@endunless
{!! $students->links() !!}

