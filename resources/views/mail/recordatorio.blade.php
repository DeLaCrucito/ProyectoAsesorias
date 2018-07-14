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
    <h2 style="text-align: center;"><b>RECORDATORIO DE ASESORÍA ACADÉMICA</b></h2>
    <br>
    <br>
</div>

<div>
    <p>Este mensaje es un recordatorio de la asesoría académica con número de folio <b>{{ $solicitud->fecha->format
    ('l, d F Y')}}</b> que se realizará el día de hoy de la unidad de aprendizaje<b>{{ $solicitud->subject->nombre }}</b> del
        tema <b>{{ $solicitud->tema }}</b>, con el asesor <b>{{ $solicitud->consultant->nombre .' '.
    $solicitud->consultant->apellido }}</b> en horario de <b>{{ $solicitud->fecha->format('h:i A') }}</b> y que se
        realizará en <b>{{ $solicitud->consultant->lugar }}</b>. Recuerda ser puntual y en caso de no realizarse la
        asesoría, indicarlo en el Portal de Asesorías al termino de la sesión de 30 minutos.</p>

    <br>
    <br>
    <br>
</div>
<footer>
    <div align="center">
        <h4 style="text-align: center;"><b>ATTENTAMENTE</b></h4>
        <h4 style="text-align: center;"><b>RESPONSABLE DE PIA EN LA {{ strtoupper($solicitud->student->degree->faculty->nombre) }}</b></h4>
        <p style="text-align: center;"><b>PD.</b> Le sugerimos guardar este correo electrónico en el ciclo escolar activo para cualquier aclaración</p>
        <br>
    </div>
</footer>
</body>
</html>