<table class="white-text highlight responsive-table">
    <thead>
    <tr>
        <th>Unidad de Aprendizaje</th>
        <th>Cita</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>

    @foreach($solicituds as $solicitud)
        <tr>
            <td>{{ $solicitud->student->nombre .' '.$solicitud->student->apellido }}</td>
            <td>{{ $solicitud->consultant->nombre .' '. $solicitud->consultant->apellido }}</td>
            <td>{{ $solicitud->subject->nombre }}</td>
            <td><a style=" cursor: default;"  data-position="top" data-delay="10"
                   data-tooltip="{{ $solicitud->state->mensaje }}" class="black-text {{
                                           $solicitud->state->color }} btn-floating tooltipped"><i
                            class="material-icons">{{ $solicitud->state->icon }}</i></a></td>
            <td><a href="{{ route('evaluacion',['id'=>encrypt($solicitud->id)]) }}"
                   class="btn-flat white-text">
                    <span></span>
                    @if($solicitud->estado === 2)
                        <?php
                        if ((new App\Models\Evaluation)->where('solicitud',"=",$solicitud->id)->exists()){
                            $texto = "Calificada";
                        }else{
                            $texto = "Calificar";
                        }
                        ?>
                        {{ $texto }}
                    @else
                        Ver Detalles
                    @endif
                </a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@unless (count($solicituds))
    <p class="white-text center-align">No se encontraron solicitudes.</p>
@endunless
{!! $solicituds->links() !!}