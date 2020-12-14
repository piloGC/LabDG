@extends('layouts.app')

@section('content')
<body style="background-image:url('../images/fondo10.png') ">
<div class="container py-4">
<h1 class="text-center mb-3 titulos">Reglamento y Normativa</h1>
<hr>
<div class="row justify-content mt-4">
    <div class="container mx-auto bg-white">
    <div class="table-responsive">
    <article>
        <a>1.- OBJETIVO </a> 
        <p>Este reglamento tiene por finalidad poner de manifiesto el conjunto de normas que regulan el préstamo de los equipos como camaras fotograficas,  
        camaras de video, tripodes, tabletas gráficas y lectores de DVD, existentes en el laboratorio de computación de la carrera de Diseño Gráfico de la Universidad del Bío-Bío, sede Chillán.
        </p> 

        <a>2.- USUARIO HABILITADO</a>
        <p>Se entiende como usuario habilitado a todo estudiante regular de pregrado pertenecientes a Diseño Gráfico o posgrado, que pertenezca a algunos de los programas de estudio del Departamento 
        de la Universidad del Bio-Bio sede Chillán.
        </p>

        <a>3.- PRÉSTAMO DE EQUIPOS</a>
        <p>
        El préstamo es personal, y se realizará bajo las siguientes condiciones: solo a usuarios habilitados, que requieran de un equipo para uso académico, en las asignaturas de especialidad concernientes
        a su programa, situando su uso dentro del área de Diseño Gráfico. Ya en el proceso de préstamo, una vez registrado el RUN del usuario habilitado, y definida la hora y fecha de devolución del préstamo,
        el usuario habilitado reconoce, la responsabilidad inmediata, inequívoca e intransferible de la integridad física (Hardware) y lógica (Software) del equipo, sometiéndose a las sanciones definidas por 
        el reglamento, en los casos de robo, hurto, perdida, daño e incumplimiento de condiciones. No obstante el usuario habilitado, tendrá una hora para reportar al personal del laboratorio de Diseño todo
        desperfecto en el equipamiento asignado. En caso contrario, se asume la conformidad total y por lo tanto la responsabilidad inmediata, inequívoca e intransferible de la integridad física (Hardware) 
        y lógica (Software) del equipo confiado, y se somete a las sanciones definidas por el reglamento.
        </p>
        
        <a> 3.1.- Horarios de atención</a>
        <p> Los préstamo se realizarán de Lunes a Viernes desde las 9:00 horas a 13:10 horas y luego desde las 14:10 hasta las 18:10 horas.</p>

        <a> 4.- DEVOLUCIÓN DE EQUIPOS</a>
        <p> Toda devolución pasará por una inspección del personal del laboratorio de Diseño Gráfico, en caso de existir daño en sus componentes físico y/o lógicos se evaluará e informará 
            al alumno de los costos y condiciones de la reparación del equipo. De no ser factible una reparación, este deberá reponer el equipo. 
            Los usuarios que no entreguen los equipos en las fechas y horas asignadas, se someten a las sanciones asignadas por el incumplimiento de condiciones.
        </p>

        <a>4.1.- Horarios de atención </a>
        <p>
            Las devoluciones se realizarán de Lunes a Viernes desde las 9:00 horas a 13:10 horas y luego desde las 14:10 hasta las 18:10 horas.
        </p>

        <a> 5.- ROBO, HURTO, DAÑOS Y PERDIDA</a>
        <p>
            En caso de robo, hurto, perdida y/o daño del equipo prestado, el alumno tendrá un plazo máximo de 90 días para cumplir con la obligación de restituir el equipo en préstamo. 
            No obstante, el alumno mientras no restituya el equipo en cuestión quedará inhabilitado para solicitar prestamos de equipos en el laboratorio. Adicionalmente, en los casos 
            de daños y/o perdida, después de realizada la restitución del equipo. Procederá una inhabilitación de 5 meses para solicitar prestamos de equipos, en el laboratorio. 
            En caso de robo o hurto, el alumno al momento de dar a conocer la situación al personal del laboratorio, deberá presentar la constancia dejada en la comisaría respectiva asociada al delito acontecido.
        </p>

        <a> 6.- INCUMPLIMIENTO DE CONDICIONES</a>
        <p>
            El incumplimiento de las condiciones de prestamos de equipos, arriesga sanciones incrementales como se especifica a continuación:
            <br> Primer incumplimiento: Suspensión de préstamo de equipos por un mes, a contar de la fecha de la sanción.
            <br> Segundo incumplimiento: Suspensión de préstamo de equipos por 5 meses, a contar de la fecha de la sanción.
            <br> Tercer incumplimiento: Suspensión de préstamo de equipos por 10 meses, a contar de la fecha de la sanción.
        </p>

        <a> 7.- MATERIAS NO CONTEMPLADAS</a>
        <p>
            Aquellas cuestiones no contempladas en el presente reglamento, serán resueltas por el encargado del laboratorio y la jefatura del programa correspondiente.
        </p>

        <a> </a>
        <p> 
            Reglamento vigente desde marzo de 2018.
            <br>Este reglamento podrá actualizarse en la medida que la autoridad vigente asi lo estime conveniente.
        </p>

    </div></div>
</div>

<div class="col-12 mt-4 justify-content-center d-flex">
   
</div>
</body>
    
@endsection

 {{-- @section('scripts')
    <script>
        function ocultar(){
            document.getElementById('edit').style.display="none";
        }
    </script>
@endsection --}}