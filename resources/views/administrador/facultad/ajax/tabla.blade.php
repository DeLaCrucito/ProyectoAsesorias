<table class="white-text highlight responsive-table">
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
            <td width="50%">{{ $facultad->nombre }}</td>
            <td width="25%"><a href="{{ route('editfacultad', ['id'=>encrypt($facultad->id)]) }}" >Ver detalles</a></td>
            <td width="25%"><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $facultad->id }}"><span></span>Eliminar</a></td>
        </tr>
        <div id="modal{{ $facultad->id }}" class="modal">
            <div class="modal-content red darken-4">
                <h1 class="white-text">ADVERTENCIA</h1>
                <p class="white-text">Esta acción no se puede deshacer. Se borrarán todos los datos relacionados con la
                    {{$facultad->nombre }} incluyendo solicitudes, alumnos, unidades de aprendizaje y licenciaturas.
                    ¿Realmente desea
                    eliminar {{$facultad->nombre }}?</p>
                <div class="center-align">
                    <div style="display: inline-flex">
                        <input type="checkbox" onclick="continuar(this,'#agree{{$facultad->id}}')" class="filled-in"
                               id="validar{{$facultad->id}}"/>
                        <label class="white-text" for="validar{{$facultad->id}}">Deseo contiuar</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer red darken-4">
                <a id="#disagree" onclick="$('#modal{{ $facultad->id }}').modal('close');" class="modal-action modal-close
                                            waves-effect waves-red btn-flat white-text">Cancelar</a>
                <a id="#agree{{$facultad->id}}" href="{{ route('deletefacultad', ['id'=>encrypt($facultad->id)]) }}"
                   class="disabled modal-action modal-close waves-effect white-text waves-green btn-flat">Aceptar</a>
            </div>
        </div>
    @endforeach
    </tbody>
</table>
@unless (count($facultads))
    <p class="white-text center-align">No existen facultades.</p>
@endunless
{!! $facultads->links() !!}



