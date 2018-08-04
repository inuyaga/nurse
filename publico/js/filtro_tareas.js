function pasarInfo(IDArchivo,descripcion) {
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
 
      $.post("<?= base_url('Maestros/setCalificacion') ?>",
      {
        IDArchivo:  $("#archivoID").val(),
        Calificacion:  $("#CalificaMaster").val(),
        Comentario:  $("#ComentaMaster").val(),
      },
      function (data, status) {
        alert('Tarea calificada');
      
        $.post("<?= base_url('Maestros/getTareasHechas') ?>",
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
    $.post("<?= base_url('Maestros/getMaterias') ?>",
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
    $.post("<?= base_url('Maestros/getUnidad') ?>",
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
    $.post("<?= base_url('Maestros/getTareas') ?>",
      {
        IDUnidad: $(this).val()
      },
      function (data, status) {
         $('#ID_Tarea').html(data);
      });

  });


  $('#ID_Tarea').change(function () {
     $('#Tabla').html('');
    $.post("<?= base_url('Maestros/getTareasHechas') ?>",
      {
        IDTarea: $(this).val()
      },
      function (data, status) {
         $('#Tabla').html(data);
      });

    $.post("<?= base_url('Maestros/getTareasInfo') ?>",
      {
        IDTarea: $(this).val()
      },
      function (data, status) {
         $('#InformacionTarea').html(data);
      });

  });
