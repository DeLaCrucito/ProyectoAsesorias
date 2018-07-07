<option disabled selected>Seleccione un asesor</option>
@foreach($assignments as $assignment)
    <option value="{{ $assignment->asesor }}">{{ $assignment->consultant->nombre .' '. $assignment->consultant->apellido
    }}</option>
@endforeach