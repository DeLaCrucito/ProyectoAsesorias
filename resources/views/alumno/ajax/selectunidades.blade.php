<option disabled selected>Seleccione una Unidad de Aprendizaje</option>
@foreach($subjects as $subject)
    <option value="{{ $subject->id }}">{{ $subject->nombre }}</option>
@endforeach