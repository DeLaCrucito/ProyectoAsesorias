<option disabled selected>Selecciona una hora</option>
@foreach($validas as $valida)
    <option value="{{  $valida }}">{{ $valida }}</option>
@endforeach