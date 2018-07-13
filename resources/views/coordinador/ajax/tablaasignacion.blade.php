<table class="white-text highlight">
    <thead>
    <tr>
        <th>Unidad de Aprendizaje</th>
        <th>Semestre</th>
        <th>Tipo de asignatura</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subjects as $subject)
        <tr>
            <td>{{ $subject->nombre }}</td>
            <td>{{ $subject->semestre }}</td>
            <td>{{ $subject->tipo }}</td>
            <td><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $subject->id }}"><span></span>Asignar</a></td>
        </tr>
        <div id="modal{{ $subject->id }}" class="modal">
            <div class="modal-content">
                <h5>Podrá remover la materia posteriormente</h5>
                <p>¿Desea asignar la materia {{
                                                   $subject->nombre }} al asesor
                    {{$consultant->nombre . ' '. $consultant->apellido}}?</p>
            </div>
            <div class="modal-footer">
                <a id="#disagree" onclick="$('#modal{{ $subject->id }}').modal('close');" class="modal-action modal-close
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
    @endforeach
    </tbody>
</table>
{!! $subjects->links() !!}