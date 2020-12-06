<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2> Prestamo Aprobado</h2>
    <ul>
        <li>Solicitud ID: {{ $info ->id }}</li>
        <li>Estudiante a cargo: {{  $info ->user_id }}</li>
        <li>Equipo Solicitado {{ $info ->existencia_id}}</li>
        <li> Fecha Retiro de Equipo: {{ $info ->fecha_inicio }}</li>
        <li> Fecha Devolución Equipo: {{ $info ->fecha_fin }}</li>

    </ul>
</body>
</html>