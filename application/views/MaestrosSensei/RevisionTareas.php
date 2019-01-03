<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="header">
      <h4 class="title">Tareas por calificar</h4>
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
          <label for="exampleFormControlSelect1">Seleccione una Tarea</label>
          <select class="form-control" id="ID_Tarea">
            <option value="" disabled selected>Elija una opcion</option>
          </select>
        </div>
      </div>



    </div>


    <div class="clearfix"></div>
    </form>
  </div>
</div>



<div id="InformacionTarea"></div>





<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="header">
      <h4 class="title">Tareas</h4>
    </div>
    <div class="content">
      <div id="Tabla"></div>
    </div>


    <div class="clearfix"></div>
    </form>
  </div>
</div>






<div class="modal fade" id="RevisarTarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Revision de tareas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="FormCalificaTarea">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label>Comentario Maestro</label>
                <input type="text" class="form-control border-input" id="ComentaMaster" name="ComentaMaster" placeholder="Comentario">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Calificacion</label>
                <input type="number" min="1" max="10" step="0.01" class="form-control border-input" id="CalificaMaster" name="CalificaMaster"
                  placeholder="Calificacion">
              </div>
            </div>

            <div class="col-md-3 hidden">
              <div class="form-group">
                <input placeholder="IDArchivo" id="archivoID" type="number" class="form-control border-input" class="validate" name="IDArchivo">
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <button type="submit" class="btn btn-success">Calificar</button>
              </div>
            </div>

          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script>
  function pasarInfo(IDArchivo, descripcion) {
    $("#archivoID").val(IDArchivo);
    // $("#ComentaMaster").val(comentario);
    //$("#CalificaMaster").val(calificacion);
    //$("#TMasterID").val(TMasterID);
    //$("#TareaID").val(TareaID);

    //document.getElementById("descripcionTarea").innerHTML = '<b>Descripcion tarea: </b>'+descripcion;
    //document.getElementById("comentarioAlumno").innerHTML = '<b>Comentario alumno:</b> '+comentarioAlumno;
    //$("#ArchivoDescarga").attr("href",ArchivoDow);
    //document.getElementById("unidadTexto").innerHTML = unidad;
    //document.getElementById("grupoTexto").innerHTML = grupo;
    // $("#ok2").val(nombre);
    //  $("#ok").val(ID);
    // $("#ok2").val(nombre);

    //$("#NombreTarea").focus();
  }


  function Calificar() {

    $.post("<?=base_url('Maestros/setCalificacion')?>",
      {
        IDArchivo: $("#archivoID").val(),
        Calificacion: $("#CalificaMaster").val(),
        Comentario: $("#ComentaMaster").val(),
      },
      function (data, status) {
        alert('Tarea calificada');

        $.post("<?=base_url('Maestros/getTareasHechasPorCalificar')?>",
          {
            IDTarea: $("#ID_Tarea").val()
          },
          function (data, status) {
            $('#Tabla').html(data);
            $("#CalificaMaster").val('');
            $("#ComentaMaster").val('');
          });



      });

  }

  $('#ID_Aula').change(function () {
    $('#ID_Materia').html('');
    $('#ID_Unidad').html('');
    $('#ID_Tarea').html('');

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
    // $('#Tabla').html('');

    $('#InformacionTarea').html('');
    $('#Tabla').html('');
    $.post("<?=base_url('Maestros/getTareas')?>",
      {
        IDUnidad: $(this).val()
      },
      function (data, status) {
        $('#ID_Tarea').html(data);
      });

  });


  $('#ID_Tarea').change(function () {
    $('#Tabla').html('');
    $.post("<?=base_url('Maestros/getTareasHechasPorCalificar')?>",
      {
        IDTarea: $(this).val()
      },
      function (data, status) {
        $('#Tabla').html(data);
      });

    $.post("<?=base_url('Maestros/getTareasInfo')?>",
      {
        IDTarea: $(this).val()
      },
      function (data, status) {
        $('#InformacionTarea').html(data);
      });

  });







  $("#FormCalificaTarea").validate({
    rules: {
      ComentaMaster: { required: true, minlength: 4 },
      CalificaMaster: { required: true, minlength: 1, maxlength: 10 },
      IDArchivo: { required: true, number: true },
    },
    messages: {
      ComentaMaster: "escribir mensaje",
      CalificaMaster: "Calificacion entre 1 y 10",


    },
    submitHandler: function (form) {

      $.post("<?=base_url('Maestros/setCalificacion')?>",
        {
          IDArchivo: $("#archivoID").val(),
          Calificacion: $("#CalificaMaster").val(),
          Comentario: $("#ComentaMaster").val()
        },
        function (data, status) {
          alertify.success('Tarea calificada');
          $.post("<?=base_url('Maestros/getTareasHechasPorCalificar')?>",
            {
              IDTarea: $("#ID_Tarea").val()
            },
            function (data, status) {
              $('#Tabla').html(data);
              $("#CalificaMaster").val('');
              $("#ComentaMaster").val('');
            });


        });



    }
  });
</script>