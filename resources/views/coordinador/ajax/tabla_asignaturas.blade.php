<table class="white-text highlight responsive-table">
    <thead>
    <tr>
        <th>Unidad de Aprendizaje</th>
        <th>Semestre</th>
        <th>Tipo</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subjects as $subject)
        <tr >
            <td>{{ $subject->subject->nombre }}</td>
            <td>{{ $subject->subject->semestre }}</td>
            <td>{{ $subject->subject->tipo }}</td>
            <td><a class="btn-flat blue-text modal-trigger"
                   href="#modal{{ $subject->id }}"><span></span>Remover</a></td>

        </tr>
        <div id="modal{{ $subject->id }}" class="modal">
            <div class="modal-content">
                <h5>Esta acción no se puede deshacer</h5>
                <p>¿Seguro que desea remover la materia {{
                                                   $subject->subject->nombre }} para el asesor
                    {{$subject->nombre . ' '.
                                               $subject->apellido}}?</p>
            </div>
            <div class="modal-footer">
                <a id="#disagree" onclick="$('#modal{{ $subject->id }}').modal('close');" class="modal-action modal-close waves-effect
                                            waves-red btn-flat">Cancelar</a>
                <a id="#agree" href="{{ route('delasignacion', ['id'=>$subject,
                                                   'consultant'=>$consultant]) }}" class="modal-action modal-close waves-effect
                                            waves-green btn-flat">Aceptar</a>
            </div>
        </div>
    @endforeach
    </tbody>
</table>
@unless (count($subjects))
    <p class="white-text center-align">No existen materias.</p>
@endunless
{!! $subjects->links() !!}