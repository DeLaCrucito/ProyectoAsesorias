<option disabled selected>Selecciona una hora</option>
@foreach($validas as $valida)
    <option value="{{ date('H:i', $valida) }}">{{ date('H:i', $valida) }}</option>
@endforeach