<table class="white-text highlight">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Acciones</th>
        <th>Borrar</th>
    </tr>
    </thead>
    <tbody>
    @foreach($degrees as $degree)
        <tr>
            <td>{{ $degree->nombre }}</td>
            <td><a href="{{ route('editlicenciatura', encrypt($degree->id)) }}" >Ver detalles</a></td>
            <td><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $degree->id }}"><span></span>Eliminar</a></td>
        </tr>
        <div id="modal{{ $degree->id }}" class="modal">
            <div class="modal-content red darken-4">
                <h1 class="white-text">ADVERTENCIA</h1>
                <p class="white-text">Esta acción no se puede deshacer. Se borrarán todos los datos relacionados con la
                    licenciatura {{$degree->nombre }} incluyendo solicitudes, alumnos y unidades de aprendizaje.
                    ¿Realmente desea eliminar la licenciatura {{$degree->nombre }}?</p>
                <div class="center-align">
                    <div style="display: inline-flex">
                        <input type="checkbox" style="background-color: #FFFFFF" onclick="continuar(this,'#agree{{$degree->id}}')" class="filled-in"
                               id="validar{{$degree->id}}"/>
                        <label class="white-text" for="validar{{$degree->id}}">Deseo contiuar</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer red darken-4">
                <a id="#disagree" onclick="$('#modal{{ $degree->id }}').modal('close');" class="modal-action modal-close
                                            waves-effect white-text waves-red btn-flat">Cancelar</a>
                <a id="#agree{{$degree->id}}" href="{{ route('deletelicenciatura', ['id'=>encrypt($degree->id)]) }}"
                   class="disabled modal-action white-text modal-close waves-effect waves-green btn-flat">Aceptar</a>
            </div>
        </div>
    @endforeach
    </tbody>
</table>
@unless (count($degrees))
    <p class="white-text center-align">No existen licenciaturas.</p>
@endunless
{!! $degrees->links() !!}

