<table class="white-text highlight">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Acciones</th>
        <th>Borrar</th>
    </tr>
    </thead>
    <tbody>
    @foreach($consultants as $consultant)
        <tr>
            <td>{{ $consultant->nombre ." ". $consultant->apellido}}</td>
            <td>{{ $consultant->correo }}</td>
            <td><a href="{{ route('editasesor', encrypt($consultant->id)) }}" >Ver detalles</a></td>
            <td><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $consultant->id }}"><span></span>Eliminar</a></td>
        </tr>
        <div id="modal{{ $consultant->id }}" class="modal">
            <div class="modal-content red darken-4">
                <h1 class="white-text">ADVERTENCIA</h1>
                <p class="white-text">Esta acción no se puede deshacer. Se borrarán todos los datos relacionados con
                    el asesor {{$consultant->nombre .' '.$consultant->apellido }} incluyendo solicitudes
                    registradas ¿Realmente desea eliminar a {{$consultant->nombre .' '.$consultant->apellido}}?</p>
                <div class="center-align">
                    <div style="display: inline-flex">
                        <input type="checkbox" style="background-color: #FFFFFF" onclick="continuar(this)" class="filled-in"
                               id="validar"/>
                        <label class="white-text" for="validar">Deseo contiuar</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer red darken-4">
                <a id="#disagree" onclick="$('#modal{{ $consultant->id }}').modal('close');" class="modal-action modal-close
                                            waves-effect waves-red btn-flat white-text">Cancelar</a>
                <a id="#agree" href="{{ route('deleteasesor', ['id'=>encrypt($consultant->id)]) }}"
                   class="disabled modal-action modal-close waves-effect white-text waves-green btn-flat">Aceptar</a>
            </div>
        </div>
    @endforeach
    </tbody>
</table>
@unless (count($consultants))
    <p class="white-text center-align">No se encontró ningún asesor.</p>
@endunless
{!! $consultants->links() !!}