<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="header">
      <h4 class="title">Asignar unidad a materia</h4>
    </div>
    <div class="content">

      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Seleccione una Aula</label>
            <select class="form-control" name="Grup_ID" id="Grup_ID">
              <option value="" disabled selected>Elija una opcion</option>
              <?php foreach ($Grupos->result() as $resultado): ?>
              <option value="<?=$resultado->Grup_ID?>">
                <?=$resultado->Grup_Nombre?>
              </option>
              <?php endforeach?>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Seleccione una Materia</label>
            <select class="form-control" name="IDMateria" id="IDMateria">
              <option value="" disabled selected>Elija una opcion</option>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label>Unidad</label>
            <input type="text" class="form-control border-input" name="NombreUnidad" id="NombreUnidad" placeholder="Nombre de la unidad"
              required>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <br>
            <button type="submit" class="btn btn-info btn-fill btn-wd" onclick="guardaUnidad()">Crear</button>
          </div>
        </div>
      </div>


      <div class="clearfix"></div>

    </div>
  </div>
</div>




<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="header">
      <h4 class="title">Informacion</h4>
    </div>
    <div class="content">

      <div id="ListUnidades"></div>

    </div>


  </div>
</div>
</div>


<ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Cras justo odio
    <span class="badge badge-primary badge-pill"></span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Dapibus ac facilisis in
    <span class="badge badge-primary badge-pill">2</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Morbi leo risus
    <span class="badge badge-primary badge-pill">1</span>
  </li>
</ul>

<div class="modal fade" id="Creaunidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TextHeader">Crear Tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <h6>
              <B id="ik">Materia:</B>
              <em id="MateriaTexto"></em>

            </h6>
            <h6>
              <B>Unidad:</B>
              <em id="unidadTexto"></em>

            </h6>
            <h6>
              <B>Grupo:</B>
              <em id="grupoTexto"></em>
          </div>
        </div>
        <div class="row">
          <form id="FromTareas">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control border-input" placeholder="Nombre tarea" id="NombreTarea" name="Nombre" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Descripcion</label>
                <input type="text" class="form-control border-input" id="TDescripcion" name="descripcion" placeholder="Descripcion" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Fecha inicio</label>
                <input type="date" class="form-control border-input" id="TFechaInicio" name="fechaInicio" placeholder="Fecha inicial" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Fecha final</label>
                <input type="date" class="form-control border-input" id="TFechaFinal" name="fechaFinal" placeholder="Fecha final" required>
              </div>
            </div>
            <div class="col-md-3 hidden">
              <div class="form-group">
                <label>Unidad</label>
                <input type="text" class="form-control border-input" id="TGrupoID" name="GrupoID" placeholder="Nombre de la unidad" required>
              </div>
            </div>
            <div class="col-md-3 hidden">
              <div class="form-group">
                <label>Unidad</label>
                <input type="text" class="form-control border-input" id="TMateriaID" name="MateriaID" placeholder="Nombre de la unidad" required>
              </div>
            </div>
            <div class="col-md-3 hidden">
              <div class="form-group">
                <label>Unidad</label>
                <input type="text" class="form-control border-input" id="TUnidadID" name="UnidadesID" placeholder="Nombre de la unidad" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <button type="submit" class="btn btn-success">Crear</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div>


<script>

  function pasarInfo(grupoId, materiaID, UnidadID, materia, unidad, grupo) {
    $("#TGrupoID").val(grupoId);
    $("#TMateriaID").val(materiaID);
    $("#TUnidadID").val(UnidadID);
    $("#Mater").val(UnidadID);
    document.getElementById("MateriaTexto").innerHTML = materia;
    document.getElementById("unidadTexto").innerHTML = unidad;
    document.getElementById("grupoTexto").innerHTML = grupo;
    // $("#ok2").val(nombre);
    //  $("#ok").val(ID);
    // $("#ok2").val(nombre);

    //$("#NombreTarea").focus();
  }


  $('#Grup_ID').change(function () {
    $('#ListUnidades').html('');
    $.post("<?=base_url('Maestros/getMateriasAulas')?>",
      {
        ID: $(this).val(),
      },
      function (data, status) {
        $('#IDMateria').html(data);
      });

  });

  $('#IDMateria').change(function () {
    mustraListaUnidades($(this).val());
  });

  function mustraListaUnidades(id) {
    $.post("<?=base_url('Maestros/getUnidades')?>",
      {
        ID: id,
      },
      function (data, status) {
        $('#ListUnidades').html(data);
      });
  }


  function guardaUnidad() {

    if ($('#NombreUnidad').val() === '') {
      alertify.error('Vacio')
    } else {
      $.post("<?=base_url('Maestros/GuardaUnidades')?>",
        {
          ID: $('#IDMateria').val(),
          descrip: $('#NombreUnidad').val(),
        },
        function (data, status) {
          mustraListaUnidades($('#IDMateria').val());
          alertify.success(data);
        });
    }
  }








</script>