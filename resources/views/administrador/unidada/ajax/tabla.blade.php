<table class="white-text highlight">
    <thead>
    <tr>
        <th>Unidad de Aprendizaje</th>
        <th>Tipo de asignatura</th>
        <th>Acciones</th>
        <th>Borrar</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subjects as $subject)
        <tr>
            <td>{{ $subject->nombre }}</td>
            <td>{{ $subject->tipo }}</td>
            <td><a href="{{ route('editunidad', encrypt($subject->id)) }}" >Ver detalles</a></td>
            <td><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $subject->id }}"><span></span>Eliminar</a></td>
        </tr>
        <div id="modal{{ $subject->id }}" class="modal">
            <div class="modal-content red darken-4">
                <h1 class="white-text">ADVERTENCIA</h1>
                <p class="white-text">Esta acción no se puede deshacer. Se borrarán todos los datos relacionados con la
                    la unidad de aprendizaje {{$subject->nombre }} incluyendo solicitudes y asignaturas de los asesores.
                    ¿Realmente desea
                    eliminar la unidad de aprendizaje {{$subject->nombre }}?</p>
                <div class="center-align">
                    <div style="display: inline-flex">
                        <input type="checkbox" style="background-color: #FFFFFF" onclick="continuar(this,'#agree{{$subject->id}}')" class="filled-in"
                               id="validar{{$subject->id}}"/>
                        <label class="white-text" for="validar{{$subject->id}}">Deseo contiuar</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer red darken-4">
                <a id="#disagree" onclick="$('#modal{{ $subject->id }}').modal('close');" class="modal-action modal-close
                                            waves-effect white-text waves-red btn-flat">Cancelar</a>
                <a id="#agree{{$subject->id}}" href="{{ route('deleteunidad', ['id'=>encrypt($subject->id)]) }}"
                   class="disabled modal-action white-text modal-close waves-effect waves-green btn-flat">Aceptar</a>
            </div>
        </div>
    @endforeach
    </tbody>
</table>
@unless (count($subjects))
    <p class="white-text center-align">No existen Unidades de Aprendizaje.</p>
@endunless
{!! $subjects->links() !!}

