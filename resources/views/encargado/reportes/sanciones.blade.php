<div class="container-fluid">
    <h3 class="font-weight-bold text-uppercase m-2">Reporte sanciones año {{Carbon\Carbon::parse($hoy)->format('Y')}}</h3>
    <div class="row p-2">
        <div class="col-md-6">
            <div class="card table-responsive">
                <table class="table table-hover table-valign-middle">
                    {{-- <thead class="bg-maroon text-light ">
                        <tr class="table-active">
                            <th>Estado solicitud</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead> --}}
                    <tbody>
                        
                        <tr>
                            <td>Sanciones activas</td>
                            <td>{{count($sancionesActivas)}}</td>
                        </tr>
                        <tr>
                            <th>Total sanciones</th>
                            <th>{{count($totalSanciones)}}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card table-responsive">
                <table class="table table-hover table-valign-middle">
                     <thead class="bg-light text-light ">
                        <tr class="table-active">
                            <th>Tipo de sancion</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <tr>
                            <td>Fuera de plazo</td>
                            <td>{{count($sancionPlazo)}}</td>
                        </tr>
                        <tr>
                            <td>Daño Hardware o Software</td>
                            <td>{{count($sancionDaño)}}</td>
                        </tr>
                        <tr>
                            <td>Entregado por tercero</td>
                            <td>{{count($sancionEntrega)}}</td>
                        </tr>
                        <tr>
                            <td>Robado</td>
                            <td>{{count($sancionRobo)}}</td>
                        </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>