<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h3> Estimado(a) {{ $info->nombre }} {{ $info->apellido }}:</h3>
    <h4>
        <p>Su Sancion referida a su solicitud n° {{ $info->infoSolicitud->id }} se ha dado por concluido</p>
        <p>
            Desde ahora, usted podra volver a solicitar equipos en el laboratorio de Diseño Gráfico. <br>
            <p>
                Fecha de inicio sanción: {{ \Carbon\Carbon::parse($info->fecha_inicio)->isoFormat('DD [de] MMMM [del] YYYY')}}<br>
                Fecha termino de sanción: {{ \Carbon\Carbon::parse($info->fecha_fin)->isoFormat('DD [de] MMMM [del] YYYY')}} <br>
                El motivo por el que se le otorgo su sanción fue: {!! $info->descripcion !!}

            </p>

            <p> <br>Información de su solicitud: </p>
            <p>
                Equipo solicitado: {{ $info->infoEquipo->nombre }} Modelo: {{ $info->infoEquipo->modelo }} Nº de serie: {{ $info->infoExistencia->codigo }}<br>
                Fecha de inicio de la solicitud: {{ \Carbon\Carbon::parse($info->infoSolicitud->fecha_inicio)->isoFormat('DD [de] MMMM [del] YYYY')}}<br>
                Fecha termino de la solicitud: {{ \Carbon\Carbon::parse($info->infoSolicitud->fecha_fin)->isoFormat('DD [de] MMMM [del] YYYY')}}<br>
                Motivo de solicitud: {!! $info->infoSolicitud->motivo !!}
            </p>

        
        </p>
    </h4>

   <h4><br>
        Correo generado por sistema con fecha de {{ \Carbon\Carbon::parse($info->notificacioncorreo)->isoFormat('DD [de] MMMM [del] YYYY')}}
    </h4> 
    <h4> Saludos cordiales <br> <br> Laboratorio de Diseño Gráfico <br> Universidad del BÍO-BÍO</h4>




</body>
</html>
