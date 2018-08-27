<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="header">
      <h4 class="title">Tareas</h4>
    </div>
    <div class="content">


      <div class="col-md-3">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Seleccione una Materia</label>
          <select class="form-control" id="ID_Materia">
            <option value="" disabled selected>Elija una opcion</option>
            <?php foreach ($MisMaterias->result() as $key) {?>
            <option value="<?=$key->Materia_ID?>">
              <?=$key->Materia_Nombre?>
            </option>
            <?php }?>

          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Unidad</label>
          <select class="form-control" id="IDUnidad">
            <option value="" disabled selected>Elija una opcion</option>
          </select>
        </div>
      </div>


      <!-- <div class="col-md-3">
            <div class="form-group">
                <br>
                <button type="button" class="btn btn-info btn-fill btn-wd" id="BotonPromediar" disabled>Promediar</button>
            </div>
        </div> -->



    </div>


    <div class="clearfix"></div>
    </form>
  </div>
</div>

<div id="TablaTareas"></div>




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

          <div class="input-field col s2 hide">
            <label for="first_name">TareaID</label>
            <input placeholder="" id="TareaID" type="text" class="validate" name="TareaID" required>


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

  //////////////////////////////////////////////////////////////////////////////
  $('#ID_Materia').change(function () {
    $('#TablaTareas').html('');
    //$('#BotonPromediar').attr("disabled", true);
    //$('#InformacionTarea').html('');

    $.post("<?=base_url('Alumnos/getUnidades')?>",
      {
        IDMateria: $(this).val()
      },
      function (data, status) {
        $('#IDUnidad').html(data);
      });

  });



  $('#IDUnidad').change(function () {


    $.post("<?=base_url('Alumnos/getTareasPorHacer')?>",
      {
        IDUnidad: $(this).val()
      },
      function (data, status) {
        $('#TablaTareas').html(data); 
      });

  });




</script>