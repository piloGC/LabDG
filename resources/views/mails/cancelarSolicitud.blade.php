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
        De acuerdo a lo solicitado, informo a usted que su solicitud nº {{ $info->id }} fue cancelada según su criterio.
    </h4>

        <h4>
            Solicitud rechazada por {{ $info->encargadoNombre }}  {{ $info->encargadoApellido }} con fecha de {{ \Carbon\Carbon::parse($info->updated_at)->isoFormat('DD [de] MMMM [del] YYYY')}}
        </h4> 
        <h4> Saludos cordiales <br> <br> Laboratorio de Diseño Gráfico <br> Universidad del BÍO-BÍO</h4>
</body>
</html>