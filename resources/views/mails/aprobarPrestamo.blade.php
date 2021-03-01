<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h3> Estimado(a): {{ $info->alumnoNombre }} {{ $info->alumnoApellido }}:</h3>
    <h4>
        <p>De acuerdo a lo solicitado, informo a usted que se realizo un prestamo en base a su solicitud nº {{ $info->solicitud_id }}. <br>
        Ústed se presento en el laboratorio de Diseño Gráfico el día del {{ \Carbon\Carbon::parse($info->infoSolicitud->fecha_retiro_equipo)}} a retirar su equipo. <br>
            Al momento de realizar su devolución, debera proporcionar el numero de su solicitud "{{ $info->solicitud_id }}" y su carnet de identidad.
            Esta devolución, debe ser realizada a mas tardar al medio día de su fecha de devolución.
        </p>
    </h4>
    <h4>    
        <p>La información de su solicitud es la siguiente: <br>
        Equipo: {{ $info->infoSolicitud->existencia->equipo->categoria->nombre }} Modelo: {{ $info->infoSolicitud->existencia->equipo->modelo }} Nº de serie: {{ $info->infoSolicitud->existencia->codigo }}<br>
        Fecha de retiro: {{ \Carbon\Carbon::parse($info->infoSolicitud->fecha_inicio)->isoFormat('DD [de] MMMM [del] YYYY')}}<br>
        Fecha de devolución: {{ \Carbon\Carbon::parse($info->infoSolicitud->fecha_fin)->isoFormat('DD [de] MMMM [del] YYYY')}}</p>
    
    </h4>
   <h4>
        Prestamo realizado por {{ $info->nombre }}  {{ $info->apellido }} con fecha de {{ \Carbon\Carbon::parse($info->updated_at)->isoFormat('DD [de] MMMM [del] YYYY')}}.
    </h4> 
    <h4> Saludos cordiales <br> <br> Laboratorio de Diseño Gráfico <br> Universidad del BÍO-BÍO</h4>




</body>
</html>
