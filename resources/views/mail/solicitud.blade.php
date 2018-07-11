<!doctype html>
<html lang="es">
<head>
    <link rel="shortcut icon" href="{{ asset('images/uac.jpg') }}" >
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificación</title>
    <img type="png" src="{{ $message->embed(asset('images/top.png')) }}" style="width: 100%">
    <link type="text/css" rel="stylesheet" href="{{asset('css/materialize.min.css')}}"  media="screen,projection"/>

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
            text-align: justify;
        }
    </style>
</head>
<body>
    <div align="center">
        <h2 style="text-align: center;"><b>NOTIFICACIÓN DE ASESORÍA ACADÉMICA</b></h2>
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
        <div align="center">
            <h4 style="text-align: center;"><b>ATTENTAMENTE</b></h4>
            <h4 style="text-align: center;"><b>RESPONSABLE DE PIA EN LA {{ strtoupper($solicitud->student->degree->faculty->nombre) }}</b></h4>
            <p style="text-align: center;"><b>PD.</b> Le sugerimos guardar este correo electrónico en el ciclo escolar activo para cualquier
                aclaración</p>
        </div>
    </footer>
</body>
</html>