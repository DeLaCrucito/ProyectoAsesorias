
    <option disabled selected>Seleccione una licenciatura</option>
    @foreach($degrees as $degree)
        <option value="{{ $degree->id }}">{{ $degree->nombre }}</option>
    @endforeach