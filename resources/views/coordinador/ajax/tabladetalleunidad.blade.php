<table class="white-text highlight responsive-table">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Nivel de Estudio</th>
        <th>Especialidad</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($consultants as $consultant)

        <tr >
            <td>{{ $consultant->consultant->nombre .' '. $consultant->consultant->apellido
                                    }}</td>
            <td>{{ $consultant->consultant->nivel_estudio }}</td>
            <td>{{ $consultant->consultant->especialidad }}</td>
            <td><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $consultant->id }}"><span></span>Remover</a></td>

        </tr>
        <div id="modal{{ $consultant->id }}" class="modal">
            <div class="modal-content">
                <h5>Puede reasignar al asesor posteriormente</h5>
                <p>¿Desea remover al asesor {{
                                                   $consultant->consultant->nombre . ' '.
                                                   $consultant->consultant->apellido }}
                    de la materia
                    {{ $subject->nombre  }}?</p>
            </div>
            <div class="modal-footer">
                <a id="#disagree" onclick=" $('#modal{{ $subject->id }}').modal('close');" class="modal-action modal-close waves-effect
                                            waves-red btn-flat">Cancelar</a>
                <a id="#agree" href="{{ route('delasignacion', ['id'=>encrypt($consultant->id)] ) }}"
                   class="modal-action modal-close
                                                   waves-effect
                                            waves-green btn-flat">Aceptar</a>
            </div>
        </div>
    @endforeach
    </tbody>
</table>
@unless (count($consultants))
    <p class="white-text center-align">Este materia no tiene asignado ningún asesor.</p>
@endunless
{!! $consultants->links() !!}