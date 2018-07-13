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
            <td><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $consultant->id }}"><span></span>Asignar</a></td>

            <div id="modal{{ $consultant->id }}" class="modal">
                <div class="modal-content">
                    <h5>Podrá remover la materia posteriormente</h5>
                    <p>¿Desea asignar la materia {{
                                                   $subject->nombre }} al asesor
                        {{$consultant->nombre . ' '. $consultant->apellido}}?</p>
                </div>
                <div class="modal-footer">
                    <a id="#disagree" onclick="$('#modal{{ $consultant->id }}').modal('close');" class="modal-action modal-close
                                        waves-effect
                                            waves-red btn-flat">Cancelar</a>
                    <a id="#agree" href="{{ route('asignar', ['subject'=>encrypt($subject->id),
                'consultant'=>encrypt($consultant->id)]) }}"
                       class="modal-action
                                        modal-close
                                        waves-effect
                                            waves-green btn-flat">Aceptar</a>
                </div>
            </div>

        </tr>
    @endforeach
    </tbody>
</table>
@unless (count($consultants))
    <p class="white-text center-align">No existen asesores.</p>
@endunless
{!! $consultants->links() !!}