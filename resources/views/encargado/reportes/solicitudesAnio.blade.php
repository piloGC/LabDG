
            <h4 class="font-weight-bold text-uppercase"> año {{Carbon\Carbon::parse($hoy)->format('Y')}}</h4>
        
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
                                <td>{{count($solicitudesEntrantes)}}</td>
                            </tr>
                            <tr>
                                <td>Aprobadas</td>
                                <td>{{count($solicitudesAceptadas)}}</td>
                            </tr>
                            <tr>
                                <td>En curso</td>
                                <td>{{count($solicitudesEnCurso)}}</td>
                            </tr>
                            <tr>
                                <td>Rechazadas</td>
                                <td>{{count($solicitudesRechazadas)}}</td>
                            </tr>
                            <tr>
                                <td>Canceladas</td>
                                <td>{{count($solicitudesCanceladas)}}</td>
                            </tr>
                            <tr>
                                <th>Total solicitudes</th>
                                <th>{{count($totalSolicitudes)}}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>