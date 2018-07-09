<!doctype html>
<html lang="es">
<head>
    <link rel="shortcut icon" href="{{ asset('images/uac.jpg') }}" >
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificación</title>
    <img type="png" src="{{ asset('images/top.png') }}">

</head>
<body>
    <div align="center">
        <h2>NOTIFICACIÓN DE ASESORÍA ACADÉMICA</h2>
        <br>
        <br>
    </div>

    <div>
        <h3>PARA   : {{ $solicitud->consultant->nombre .' '
        . $solicitud->consultant->apellido }}, {{ $solicitud->student->nombre .' '
        . $solicitud->student->apellido }}</h3>
        <h3>CC     : RESPONSABLE DE PIA EN LA ESCUELA O FACULTAD</h3>
        <h3>ASUNTO : NOTIFICACIÓN DE ASESORÍA PROGRAMADA</h3>
        <br>
        <br>
        <br>
    </div>

    <div>
        <h3>A QUIEN CORRESPONDA</h3>
        <h3>PRESENTE</h3>
        <p>Sirva a bien el presente medio para notificar la Asesoría Académica programada con número de folio {{ $solicitud->folio }}
            el dia {{ $solicitud->fecha->format('D, d M Y') }} a las {{ $solicitud->fecha->format('h:i A') }} hrs. con duración de 30 min. en
            {{ $solicitud->consultant->lugar }} asignado al asesor
            {{ $solicitud->consultant->nombre .' '. $solicitud->consultant->apellido }}.
        </p>
        <br>
        <p>Dicho apoyo académico corresponde a la Unidad de Aprendizaje {{ $solicitud->subject->nombre }}} en el/los
            tema(s)
        {{ $solicitud->tema }} con un total de alumno(s) a asesorar con matrícula(s) {{ $solicitud->student->matricula }}
        , a solicitud de {{ $solicitud->student->nombre .' '. $solicitud->student->apellido }}.</p>
        <br>
        <p>Recomendando la puntualidad y asistencia de las partes interesadas y agradeciendo el compromiso con el Programa
        Institucional de Asesorías Académicas (PIA) quedo a sus órdenes.</p>
        <br>
        <br>
    </div>

    <div>
        <h3>ATTE.</h3>
        <br>
        <h3>RESPONSABLE DE PIA EN LA ESCUELA O FACULTAD</h3>
        <br>
        <p>PD. Le sugerimos guardar este correo electrónico en el ciclo escolar activo para cualquier aclaración</p>
    </div>
</body>
</html>