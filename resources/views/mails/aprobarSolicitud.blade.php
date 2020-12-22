<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h3> Estimado(a) {{ $info->usuario->name }} {{ $info->usuario->lastname }}:</h3>
    <h4>
        <p>De acuerdo a lo solicitado, informo a usted que su solicitud nº {{ $info->id }} fue aprobada satisfactoriamente. <br>
            Debera presentarse en el Laboratorio de Diseño Gráfico el día {{ \Carbon\Carbon::parse($info->fecha_inicio)->isoFormat('DD [de] MMMM [del] YYYY')}} después
            del medio día, para así generar el prestamo de su equipo. <br>
            Al momento de realizar su retiro, debera proporcionar el numero de su solicitud "{{ $info->id }}" y su carnet de identidad.
        </p>
    </h4>
    <h4>    
        <p>La información de su solicitud es la siguiente: <br>
        Equipo: {{ $info->existencia->equipo->categoria->nombre }} Modelo: {{ $info->existencia->equipo->modelo }} Nº de serie: {{ $info->existencia->codigo }}<br>
        Fecha de retiro: {{ \Carbon\Carbon::parse($info->fecha_inicio)->isoFormat('DD [de] MMMM [del] YYYY')}}<br>
        Fecha de devolución: {{ \Carbon\Carbon::parse($info->fecha_fin)->isoFormat('DD [de] MMMM [del] YYYY')}}</p>
        El motivo por el que realizó esta solicitud fue:
             {!! $info->motivo !!} 
    </h4>
   <h4>
        Solicitud aprobada por {{ $info->encargadoNombre }}  {{ $info->encargadoApellido }} con fecha de {{ \Carbon\Carbon::parse($info->updated_at)->isoFormat('DD [de] MMMM [del] YYYY')}}.
    </h4> 
    <h4> Saludos cordiales <br> <br> Laboratorio de Diseño Gráfico <br> Universidad del BÍO-BÍO</h4>




</body>
</html>
