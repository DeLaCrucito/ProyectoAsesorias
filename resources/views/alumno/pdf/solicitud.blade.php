<!doctype html>
<html lang="es">
<head>
    <link rel="shortcut icon" href="{{ asset('images/uac.jpg') }}" >
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificación</title>
    <img type="png" src="{{ asset('images/top.png') }}" width="730">

    <style>
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100px;
        }

        h2,h4,h5,p{
            line-height: 1.5;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            font-weight: normal;
            color: rgba(0, 0, 0, 0.87);
        }
    </style>
</head>
<body>
    <div align="center">
        <h2><b>NOTIFICACIÓN DE ASESORÍA ACADÉMICA</b></h2>
        <br>
        <br>
    </div>

    <div>
        <h4><b>PARA   :</b> {{ $solicitud->consultant->nombre .' '
        . $solicitud->consultant->apellido }}, {{ $solicitud->student->nombre .' '
        . $solicitud->student->apellido }}</h4>
        <h4><b>CC     :</b> RESPONSABLE DE PIA EN LA ESCUELA O FACULTAD</h4>
        <h4><b>ASUNTO :</b> NOTIFICACIÓN DE ASESORÍA PROGRAMADA</h4>
        <br>
        <br>
    </div>

    <div>
        <h5><b>A QUIEN CORRESPONDA</b></h5>
        <h5><b>PRESENTE</b></h5>
        <p>Sirva a bien el presente medio para notificar la Asesoría Académica programada con número de folio {{ $solicitud->folio }}
            el dia <b>{{ $solicitud->fecha->format('l, d F Y') }}</b> a las <b>{{ $solicitud->fecha->format('h:i A') }} hrs.</b> con duración de 30 min. en
            <b>{{ $solicitud->consultant->lugar }}</b> asignado al asesor
            <b>{{ $solicitud->consultant->nombre .' '. $solicitud->consultant->apellido }}</b>.
        </p>
        <p>Dicho apoyo académico corresponde a la Unidad de Aprendizaje {{ $solicitud->subject->nombre }} en el/los
            tema(s)
            <b>{{ $solicitud->tema }}</b> con un total de alumno(s) a asesorar con matrícula(s) {{ $solicitud->student->matricula }}
        , a solicitud de {{ $solicitud->student->nombre .' '. $solicitud->student->apellido }}.</p>
        <br>
        <p>Recomendando la puntualidad y asistencia de las partes interesadas y agradeciendo el compromiso con el Programa
        Institucional de Asesorías Académicas (PIA) quedo a sus órdenes.</p>
        <br>
        <br>
        <br>
    </div>
    <footer>
        <div >
            <h4><b>ATTENTAMENTE</b></h4>
            <h4><b>RESPONSABLE DE PIA EN LA ESCUELA O FACULTAD</b></h4>
            <p><b>PD.</b> Le sugerimos guardar este correo electrónico en el ciclo escolar activo para cualquier aclaración</p>
        </div>
    </footer>
</body>
</html>