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
        <p>De acuerdo a lo informado, se finaliza el prestamo de su solicitud nº {{ $info->idSolicitud}} </p> <br>
        <p>De igual manera, se le comunica por medio de este correo, que ha incumplido de su contrato en base a su solicitud nº {{ $info->idSolicitud }} <br>
            Desde ahora, usted pasa a estar en estado de alumno sancionado, por ende no podra emitir ninguna solicitud de equipo en el Laboratorio de Diseño Gráfico en 
            las siguientes fechas

            <p>
                Fecha de inicio sanción: {{ \Carbon\Carbon::parse($info->fecha_inicio)->isoFormat('DD [de] MMMM [del] YYYY')}}<br>
                Fecha termino de sanción: {{ \Carbon\Carbon::parse($info->fecha_fin)->isoFormat('DD [de] MMMM [del] YYYY')}}
            </p>

        Ústed se presento en el laboratorio de Diseño Gráfico el día del {{ \Carbon\Carbon::parse($info->fecha_devolucion)}} para devolver su equipo. <br>
        
        </p>
    </h4>

   <h4>
        Sancion realizado por {{ $info->encargadoNombre }}  {{ $info->encargadoApellido }} con fecha de {{ \Carbon\Carbon::parse($info->fecha_devolucion)->isoFormat('DD [de] MMMM [del] YYYY')}}
    </h4> 
    <h4> Saludos cordiales <br> <br> Laboratorio de Diseño Gráfico <br> Universidad del BÍO-BÍO</h4>




</body>
</html>
