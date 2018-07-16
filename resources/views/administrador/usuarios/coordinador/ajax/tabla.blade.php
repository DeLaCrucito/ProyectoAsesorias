<table class="white-text highlight responsive-table">
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
            <td width="35%">{{ $coordinator->nombre ." ". $coordinator->apellido}}</td>
            <td width="20%">{{ $coordinator->correo }}</td>
            <td width="25%">{{ $coordinator->degree->nombre }}</td>
            <td><a href="{{ route('editcoordinador', encrypt($coordinator->id)) }}" >Ver detalles</a></td>
            <td><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $coordinator->id }}"><span></span>Eliminar</a></td>
        </tr>
        <div id="modal{{ $coordinator->id }}" class="modal">
            <div class="modal-content red darken-4">
                <h1 class="white-text">ADVERTENCIA</h1>
                <p class="white-text">Esta acción no se puede deshacer. Se borrarán todos los datos relacionados con
                    el coordinador {{$coordinator->nombre .' '.$coordinator->apellido }} incluyendo solicitudes
                    registradas ¿Realmente desea eliminar a {{$coordinator->nombre .' '.$coordinator->apellido}}?</p>
                <div class="center-align">
                    <div style="display: inline-flex">
                        <input type="checkbox" style="background-color: #FFFFFF" onclick="continuar(this,'#agree{{ $coordinator->id }}')"
                               class="filled-in"
                               id="validar{{ $coordinator->id }}"/>
                        <label class="white-text" for="validar{{ $coordinator->id }}">Deseo contiuar</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer red darken-4">
                <a id="#disagree" onclick="$('#modal{{ $coordinator->id }}').modal('close');" class="modal-action modal-close
                                            waves-effect waves-red btn-flat white-text">Cancelar</a>
                <a id="#agree{{ $coordinator->id }}" href="{{ route('deletecoordinador', ['id'=>encrypt($coordinator->id)]) }}"
                   class="disabled modal-action modal-close waves-effect white-text waves-green btn-flat">Aceptar</a>
            </div>
        </div>
    @endforeach
    </tbody>
</table>
@unless (count($coordinators))
    <p class="white-text center-align">No se encontró ningún coordinador.</p>
@endunless
{!! $coordinators->links() !!}

