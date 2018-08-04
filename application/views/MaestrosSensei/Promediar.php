<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="header">
      <h4 class="title">Promediar alumnos</h4>
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
          <label for="exampleFormControlSelect1">Seleccione un Alumn@</label>
          <select class="form-control" id="IDAlumno">
            <option value="" disabled selected>Elija una opcion</option>
          </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <br>
          <button type="button" onclick="proediar_inicial()" class="btn btn-info btn-fill btn-wd" id="BotonPromediar" disabled>Promediar</button>
        </div>
        <div class="form-group">
          <a href="<?= base_url('Maestros/imp_materia') ?>" target="_blank" class="btn btn-info btn-fill btn-wd">imprimir</a>
        </div>
      </div>



    </div>


    <div class="clearfix"></div>
    </form>
  </div>
</div>



<div id="InformacionMateria"></div>

<div id="InformacionAlumno"></div>
























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
    $('#IDAlumno').html('');

    $('#InformacionMateria').html('');
    $('#InformacionAlumno').html('');
    $('#BotonPromediar').attr("disabled", true);

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
    $('#InformacionAlumno').html('');

    $('#InformacionTarea').html('');
    $('#Tabla').html('');
    $('#BotonPromediar').attr("disabled", true);

    $.post("<?=base_url('Maestros/getAlumnosInscriptosEnMaterias')?>",
      {
        IDMateria: $(this).val()
      },
      function (data, status) {
        $('#IDAlumno').html(data);
      });

    $.post("<?=base_url('Maestros/getDatosMateria')?>",
      {
        IDMateria: $(this).val()
      },
      function (data, status) {
        $('#InformacionMateria').html(data);
      });


  });


  $('#IDAlumno').change(function () {


    $.post("<?=base_url('Maestros/getInfoAlumno')?>",
      {
        ID_ALUMNO: $(this).val(),
        ID_MATERIA: $('#ID_Materia').val(),

      },
      function (data, status) {
        $('#InformacionAlumno').html(data);
        $('#BotonPromediar').attr("disabled", false);
      });

  });





  function getInfoalumno() {
    $.post("<?=base_url('Maestros/getInfoAlumno')?>",
      {
        ID_ALUMNO: $('#IDAlumno').val(),
        ID_MATERIA: $('#ID_Materia').val(),

      },
      function (data, status) {
        $('#InformacionAlumno').html(data);
        $('#BotonPromediar').attr("disabled", false);
      });
  }





  function promediar_alumno() {

    alertify.confirm('¿Promediar alumno?', 'Esta accion calificara al alumno ' + $('#AlumnoNombre').html() + ' en la materia la calificacion es global y no parcial',
      function () {
        alertify.success('Si');


        $.post("<?=base_url('Maestros/Calificacion_final_alumno')?>",
          {
            total_tareas: $('#TotalTareas').html(),
            id_alumno: $('#IDAlumno').val(),
            id_materia: $('#ID_Materia').val(),

          },
          function (data, status) {
            alertify.alert('Calificado', 'Calificacion final: ' + data, function () { alertify.success('Ok'); });
            getInfoalumno();
          });

        // window.location.href = "EliminaTareaAlumno/"+id+"/"+ruta;
      },
      function () {
        alertify.error('Cancelar')
      }).set('labels', { ok: 'Si!', cancel: 'No!' });

  }



  function proediar_inicial() {
    Total_unudades = $('#numero_unidades').html();
    total_tareas = $('#TotalTareas').html();
    A_entrego = $('#alumno_entrego').html();
    A_calicado = $('#alumno_calificadas').html();

    if (A_entrego != A_calicado) {

      alertify.alert('Sin completar', 'todavia faltan ' + (A_entrego - A_calicado) + ' tareas por calificar para poder promediar al alumno', function () { alertify.success('Ok'); });

    } else {
      promediar_alumno();
    }
  }


</script>