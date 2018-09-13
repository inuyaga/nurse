<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="header">
      <h4 class="title">Tareas de unidades</h4>
    </div>
    <div class="content">

      <div class="col-md-3">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Seleccione un Aula</label>
          <select class="form-control" id="ID_Aula">
            <option value="" disabled selected>Elija una opcion</option>
            <?php foreach ($Grupos->result() as $key) {?>
            <option value="<?=$key->Grup_ID?>">
              <?=$key->Grup_Nombre?>
            </option>
            <?php }?>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Seleccione una Materia</label>
          <select class="form-control" id="ID_Materia">
            <option value="" disabled selected>Elija una opcion</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Seleccione una Unidad</label>
          <select class="form-control" id="ID_Unidad">
            <option value="" disabled selected>Elija una opcion</option>
          </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <br>
          <button data-toggle="modal" data-target="#Creaunidad" data-backdrop="false" type="button" onclick="" class="btn btn-success btn-fill btn-wd"
            id="NuevaTarea" disabled>Nuevo</button>
        </div>
      </div>


    </div>


    <div class="clearfix"></div>

  </div>
</div>





<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="header">
      <h4 class="title">Tareas
        <a href="#" title="El resultado de todas las sumas del valor de cada tarea deben ser 100%">
          <i class="ti-help-alt"></i>
        </a>
      </h4>
    </div>
    <div class="content">
      <div id="Tabla"></div>
    </div>


    <div class="clearfix"></div>
    </form>
  </div>
</div>




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

            <div class="col-md-6">
              <div class="form-group">
                <label>Valor de tarea en porcentaje</label>
                <input type="number" class="form-control border-input" placeholder="Escribir sin el %" id="valor" name="valor" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">



              <div class="radio">
                <label><input type="radio" name="entregable" value="1" checked>Para entrega</label>
              </div>
              <div class="radio">
                <label><input type="radio" name="entregable" value="2">Solo calificar</label>
              </div>
            </div>
            </div>

            <div class="col-md-12">
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










<!-- =================================================================================================================================================== -->
<!-- Detecta cambios en el select de materias y muestra datos en el siguiente select unidades -->

<script>
  $('#ID_Aula').change(function () {
    $('#ID_Materia').html('');
    $('#ID_Unidad').html('');
    $('#ID_Tarea').html('');
    $('#NuevaTarea').attr("disabled", true);

    $('#InformacionTarea').html('');
    $('#Tabla').html('');
    $.post("<?=base_url('Maestros/getMaterias')?>",
      {
        IDGrupo: $(this).val()
      },
      function (data, status) {
        $('#ID_Materia').html(data);
      });
  });



  $('#ID_Materia').change(function () {
    $('#ID_Unidad').html('');
    $('#ID_Tarea').html('');
    $('#NuevaTarea').attr("disabled", true);

    $('#InformacionTarea').html('');
    $('#Tabla').html('');
    $.post("<?=base_url('Maestros/getUnidad')?>",
      {
        IDMateria: $(this).val()
      },
      function (data, status) {
        $('#ID_Unidad').html(data);
      });
  });


  $('#ID_Unidad').change(function () {
    $('#InformacionTarea').html('');
    $('#Tabla').html('');
    muestraTareasUnidad($(this).val());
  });

  function muestraTareasUnidad(id) {
    $.post("<?=base_url('Maestros/TablaEnVistaTarea')?>",
      {
        UnidadID: id
      },
      function (data, status) {
        $('#NuevaTarea').attr("disabled", false);
        $('#Tabla').html(data);
      });
  }




  $("#FromTareas").validate({
    rules: {
      Nombre: { required: true, minlength: 2 },
      descripcion: { required: true, minlength: 2 },
      fechaInicio: { required: true, date: true },
      fechaFinal: { required: true, date: true },
      valor: { required: true, number: true },
      entregable: { required: true},
      UnidadesID: { required: true },


    },
    messages: {
      Nombre: "Debe introducir nombre de la materia.",
      descripcion: "Debe describir el proposito de la tarea.",
      fechaInicio: "Debe introducir una fecha inicial.",
      fechaFinal: "Debe introducir una fecha final.",
      valor: "Debe de escribir numeros enteros sin %",
      entregable: "Selecciona un valor",

    },
    submitHandler: function (form) {

      $.post("<?=base_url('Maestros/GuardaTareas')?>",
        {
          Nombre: $('#NombreTarea').val(),
          descripcion: $('#TDescripcion').val(),
          UnidadesID: $('#ID_Unidad').val(),
          fechaInicio: $('#TFechaInicio').val(),
          fechaFinal: $('#TFechaFinal').val(),
          valor: $('#valor').val(),
          entregable: $('input:radio[name=entregable]:checked').val()
        },
        function (data, status) {
          // $('#Tabla').html(data);
          alertify.success(data);
          muestraTareasUnidad($('#ID_Unidad').val());
          $('#NombreTarea').val('');
          $('#TDescripcion').val('');
          $('#TFechaInicio').val('');
          $('#TFechaFinal').val('');

        });



    }
  });






</script>


<!-- ========================================================================================================================================= -->
<!-- Elimina Tarea definitivamente -->

<script>
  function alerta(id) {

    alertify.confirm('Eliminar', 'Esta seguro de elimar ',
      function () {
        alertify.success('Si');

        $.post("eliminaTarea",
          {
            IDTarea: id,
          },
          function (data, status) {
            // setTimeout('document.location.reload()',1000);

            $.post("TablaEnVistaTarea",
              {
                IDGrupo: $('#SlecMateria').val(),
                UnidadID: $('#respuesta').val()
              },
              function (data, status) {
                muestraTareasUnidad($('#ID_Unidad').val());
              });

          });


        // window.location.href = "EliminaTareaAlumno/"+id+"/"+ruta;
      },
      function () {
        alertify.error('Cancelar')
      }).set('labels', { ok: 'Si!', cancel: 'No!' });
  }
</script>

<!-- ========================================================================================================================================= -->




<script>
  function CambiaFecha(id) {

    alertify.confirm('Cambiar fecha', 'Esta seguro de cambiar fecha ',
      function () {
        alertify.success('Si');

        $.post("EditarTarea",
          {
            idtarea: id,
            FechaIni: $('#fechaIni' + id).val(),
            FechaFin: $('#fechaFin' + id).val()
          },
          function (data, status) {
            // setTimeout('document.location.reload()',1000);

            $.post("TablaEnVistaTarea",
              {
                IDGrupo: $('#SlecMateria').val(),
                UnidadID: $('#respuesta').val()
              },
              function (data, status) {
                muestraTareasUnidad($('#ID_Unidad').val());
              });

          });


        // window.location.href = "EliminaTareaAlumno/"+id+"/"+ruta;
      },
      function () {
        alertify.error('Cancelar');
      }).set('labels', { ok: 'Si!', cancel: 'No!' });
  }
</script>