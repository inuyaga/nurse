
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-layout-media-right-alt"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Blogs</p>
                                            <?php echo $NumberBlogs ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Listo
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-ruler-pencil"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Tareas</p>
                                           <?php echo $NumberTareas ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-calendar"></i> Fecha
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
             
                
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="ti-pencil-alt"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Tareas Entregadas</p>
                                            <?php echo $NumberTareasEntregadas ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> In the last hour
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-info text-center">
                                            <i class="ti-check-box"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Calificadas</p>
                                            <?= $Calificadas ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Proximas tareas</h4>
                            </div>
                            <div class="content">
                        <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                                <th>##</th>
                                <th>Materia</th>
                                <th>Grupo</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Dias restantes</th>
                            </thead>
                            <tbody>
                            <?php foreach ($ProxTareas->result() as $key): ?>
                
                                <?php if (dateDiff(date("y-m-d"), $key->Tarea_Fecha_fin) <= -1): ?>
                                
                                <?php else: ?>
                                <tr>
                                    <td><?= $key->Tarea_ID ?></td>
                                    <td><?= $key->Materia_Nombre ?></td>
                                    <td><?= $key->Grup_Nombre ?></td>
                                    <td><?= $key->Tarea_Nombre ?></td>
                                    <td><?= $key->Tarea_Descripcion ?></td>
                                    <td><?= $key->Tarea_Fecha_inicio ?></td>
                                    <td><?= $key->Tarea_Fecha_fin ?></td>
                                    <td><?= dateDiff(date("y-m-d"), $key->Tarea_Fecha_fin)?> Dias</td>
                                    </tr>
                                <?php endif ?>
                
                                
                                
                            <?php endforeach ?>
                            </tbody>
                        </table>
                
                         </div>
                       </div>
                        <div class="clearfix"></div>
                    </div>
                </div>


                


                
            </div>
        </div>

       


        <?php 

        function dateDiff($start, $end) { 
        
        $start_ts = strtotime($start); 
        
        $end_ts = strtotime($end); 
        
        $diff = $end_ts - $start_ts; 
        
        return round($diff / 86400); 
        
        } 
        ?>