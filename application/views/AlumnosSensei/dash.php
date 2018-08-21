<?php

foreach ($MisMaterias->result() as $key) {?>
<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-warning text-center">
                            <i class="ti-book"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <strong><p>Materia</p></strong>
                            <p>
                                <?=$key->Materia_Nombre?>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        <i class="ti-reload"></i>
                        <?=$key->Materia_Nombre?>
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
                            <i class="ti-list"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>Unidades</p>
                            <?=$this->M_Sensei->getUnidades($key->Materia_ID)->num_rows();?>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        <i class="ti-reload"></i>
                        <?=$key->Materia_Nombre?>
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
                            <i class="ti-write"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>Tareas</p>
                            <?=$this->M_Sensei->getTareasDeMateria($key->Materia_ID)->num_rows();?>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        <i class="ti-reload"></i>
                        <?=$key->Materia_Nombre?>
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
                            <i class="ti-gift"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>Calificación</p>
                            <?=$this->M_Sensei->getCalificacionAlumno($key->Materia_ID, $this->session->ID_Usuario);?>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        <i class="ti-reload"></i>
                        <?=$key->Materia_Nombre?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php }?>






<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Tareas Próximas a entregar</h4>
        </div>
        <div class="content">



            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>

                        <th>Grupo</th>
                        <th>Materia</th>
                        <th>Unidad</th>
                        <th>Tarea</th>
                        <th>Descripción</th>
                        <th>Entrega</th>
                        <th>Acción</th>
                        <th>Faltan</th>
                    </thead>
                    <tbody>

                        <?php foreach ($TareasPorHacer->result() as $key): ?>
                        <?php if (dateDiff(date("y-m-d"), $key->Tarea_Fecha_fin) <= -1): ?>
                        <?php else: ?>
                        <tr>
                            <td>
                                <?=$key->Grup_Nombre?>
                            </td>
                            <td>
                                <?=$key->Materia_Nombre?>
                            </td>
                            <td>
                                <?=$key->Unidad_Descripcion?>
                            </td>
                            <td>
                                <?=$key->Tarea_Nombre?>
                            </td>
                            <td>
                                <?=$key->Tarea_Descripcion?>
                            </td>
                            <td>
                                <?=$key->Tarea_Fecha_fin?>
                            </td>
                            <td>
                                <button class="btn btn-success" type="button" class="btn btn-primary" data-toggle="modal" data-target="#EntregarTarea" data-backdrop="false"
                                    data-whatever="@mdo" onclick="pasarInfo(<?=$key->Tarea_ID?>)">
                                    <i class="ti-google"></i>
                                    Google Drive
                                </button>
                                <a class="btn btn-success" type="button" class="btn btn-primary" href="<?=base_url('Alumnos/NuevoDoc/' . $key->Tarea_ID)?>">
                                    <i class="ti-file"></i> Crear documento</a>
                            </td>
                            <td>
                                <?=dateDiff(date('y-m-d'), $key->Tarea_Fecha_fin)?> Días
                            </td>

                        </tr>
                        <?php endif;?>
                        <?php endforeach;?>


                    </tbody>
                    <a></a>
                </table>

            </div>


            <div class="clearfix"></div>

        </div>
    </div>
</div>












<div class="modal fade" id="EntregarTarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Entregar Tarea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('Alumnos/GuardarTarea')?>" method="POST">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">URL documento compartido en GoogleDrive</label>
                        <input type="text" class="validate" name="ContenidoTarea" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Comentario</label>
                        <textarea class="form-control textoArea" id="message-text" placeholder="Puedes hacer un comentario" name="ComentarioAlumno"
                            required></textarea>
                    </div>



                    <div class="input-field col s2 hidden">
                        <input placeholder="" id="TareaID" type="text" class="validate" name="TareaID" required>
                        <label for="first_name">TareaID</label>


                        <input type="text" class="validate" name="TIPO" value="2">
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



<?php

function dateDiff($start, $end)
{

    $start_ts = strtotime($start);

    $end_ts = strtotime($end);

    $diff = $end_ts - $start_ts;

    return round($diff / 86400);

}
?>


<script>
    function pasarInfo(TareaID) {
        $("#TareaID").val(TareaID);

    }

</script>