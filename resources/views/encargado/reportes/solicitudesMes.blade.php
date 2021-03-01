
            <h4 class="font-weight-bold text-uppercase">mes {{Carbon\Carbon::parse($hoy)->isoFormat('MMMM')}}</h4>
        
                <div class="table-responsive p-0">
                    <table class="table table-hover table-valign-middle">
                        <thead class="bg-olive text-light ">
                            <tr class="table-active">
                                <th>Estado solicitud</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td>Entrantes</td>
                                <td>{{count($solicitudesEntrantesMes)}}</td>
                            </tr>
                            <tr>
                                <td>Aprobadas</td>
                                <td>{{count($solicitudesAceptadasMes)}}</td>
                            </tr>
                            <tr>
                                <td>En curso</td>
                                <td>{{count($solicitudesEnCursoMes)}}</td>
                            </tr>
                            <tr>
                                <td>Rechazadas</td>
                                <td>{{count($solicitudesRechazadasMes)}}</td>
                            </tr>
                            <tr>
                                <td>Canceladas</td>
                                <td>{{count($solicitudesCanceladasMes)}}</td>
                            </tr>
                            <tr>
                                <th>Total solicitudes</th>
                                <th>{{count($totalSolicitudesMes)}}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
       