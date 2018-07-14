<option disabled selected="selected">Seleccione un semestre</option>
@foreach(range(1,$degree->semestres) as $semestre)
    <option value="{{ $semestre }}">{{ $semestre }}</option>
@endforeach