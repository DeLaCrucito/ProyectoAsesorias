<option disabled selected>Selecciona una hora</option>
@foreach($validas as $valida)
    <option value="{{ date('H:i', $valida) }}">{{ date('h:i A', $valida) }}</option>
@endforeach