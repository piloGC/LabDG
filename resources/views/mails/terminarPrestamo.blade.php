<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h3> Estimado(a) {{ $info->alumnoNombre }} {{ $info->alumnoApellido }}:</h3>
    <h4>
        <p>De acuerdo a lo solicitado, informo a usted que se finalizo el prestamo de su solicitud nº {{ $info->idSolicitud->id }} <br>
        Ústed se presento en el laboratorio de Diseño Gráfico el día del {{ \Carbon\Carbon::parse($info->fecha_devolucion)}} para devolver su equipo. <br>
        
        </p>
    </h4>
    <h4>    
        <p>La información de su solicitud es la siguiente: <br>
        Equipo: {{ $info->idSolicitud->existencia->equipo->categoria->nombre }} Modelo: {{ $info->idSolicitud->existencia->equipo->modelo }} Nº de serie: {{ $info->idSolicitud->existencia->codigo }}<br>
        Fecha de retiro: {{ \Carbon\Carbon::parse($info->idSolicitud->fecha_inicio)->isoFormat('DD [de] MMMM [del] YYYY')}}<br>
        Fecha de devolución: {{ \Carbon\Carbon::parse($info->idSolicitud->fecha_fin)->isoFormat('DD [de] MMMM [del] YYYY')}}</p>
    
    </h4>
   <h4>
        Prestamo realizado por {{ $info->encargadoNombre }}  {{ $info->encargadoApellido }} con fecha de {{ \Carbon\Carbon::parse($info->fecha_devolucion)->isoFormat('DD [de] MMMM [del] YYYY')}}
    </h4> 
    <h4> Saludos cordiales <br> <br> Laboratorio de Diseño Gráfico <br> Universidad del BÍO-BÍO</h4>




</body>
</html>
