<option disabled selected="selected">Seleccione un semestre</option>
@foreach($subjects as $subject)
    <option value="{{ $subject->semestre }}">{{ $subject->semestre }}</option>
@endforeach