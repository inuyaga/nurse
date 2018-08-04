<div class="col-lg-12 col-md-12">
	<div class="card">
		<div class="header">
			<h4 class="title"><?= $NombreMateria ?></h4>
		</div>
		<div class="content">
      <div class="content table-responsive table-full-width">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">##</th>
              <th scope="col">Materia</th>
              <th scope="col">Grupo</th>
              <th scope="col">Unidad</th>
              <th scope="col">Tarea</th>
              <th scope="col">Alumno</th>
              <th scope="col">Entrego</th>
              <th scope="col">Fecha limite</th>
              <th scope="col">Accion</th>
              <th scope="col">Accion</th>
              <th scope="col">Calificacion</th>
            </tr>
          </thead>
          <tbody>
              <?php foreach ($TareasArchivos->result() as $Fila ): ?>
                <tr>
                  <td><img class="circle" src="<?= base_url($Fila->Usuario_Avatar) ?>" width="50" height="50"></td>
                  <td><?= $Fila->Materia_Nombre ?></td>
                  <td><?= $Fila->Grup_Nombre ?></td>
                  <td><?= $Fila->Unidad_Descripcion ?></td>
                  <td><?= $Fila->Tarea_Nombre ?></td>
                  <td><?= $Fila->Usuario_Nombre ?></td>
                  <td> <?php $date=date_create($Fila->Archi_Fecreacion); echo date_format($date,"Y/m/d H:i:s");  ?></td>
                  <td><?php $date=date_create($Fila->Tarea_Fecha_fin); echo date_format($date,"Y/m/d");  ?></td>
                  <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RevisarTarea" data-backdrop="false" data-whatever="@mdo"
                    onclick="pasarInfo('<?= $Fila->Tarea_Descripcion ?>', 'hola', '<?= str_replace('"', ' ', $Fila->Archi_Comentario_Alumno)?>', '<?= $Fila->Archi_ID ?>', '<?= $Fila->Archi_Comentario_Maestro ?>','<?= $Fila->Archi_Calificacion ?>') ">Revisar</button></td>
                  <td><a href="<?= base_url('Maestros/VerDocumento/').$Fila->Archi_ID ?>" type="button" class="btn btn-primary">Ver</a></td>
                  <td><?= $Fila->Archi_Calificacion ?></td>
                </tr>
              <?php endforeach; ?>

          </tbody>
        </table>
        </div>
        </div>
      <div class="clearfix"></div>
    </div>
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

      <p id="descripcionTarea">Descripcion breve de tarea</p>
      <a id="ArchivoDescarga" href="">Descargar Tarea</a>
      <h6 id="comentarioAlumno">este yn comentario alumno</h6>
        <form action="<?= base_url('Maestros/CalificarTarea') ?>" method="POST">
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
                <input type="number" step="0.01" class="form-control border-input" id="CalificaMaster" name="CalificaMaster" placeholder="Calificacion">
              </div>
            </div>
            <div class="col-md-3 hidden">
              <div class="form-group">
                <input type="" value="<?= $_SERVER["REQUEST_URI"] ?>" class="form-control border-input" name="PaginaRetorno">
              </div>
            </div>
            <div class="col-md-3 hidden">
              <div class="form-group">
                <input placeholder="IDArchivo" id="IDArchivo" type="number" class="form-control border-input" class="validate" name="IDArchivo">
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <button type="submit" class="btn btn-success">Calificar</button>
              </div>
            </div>

          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<script>
  	 function pasarInfo(DescripcionT, ArchivoDow, comentarioAlumno, IDArchivo, comentario, calificacion) {
    $("#IDArchivo").val(IDArchivo);
    $("#ComentaMaster").val(comentario);
    $("#CalificaMaster").val(calificacion);
     //$("#TMasterID").val(TMasterID);
     //$("#TareaID").val(TareaID);

     document.getElementById("descripcionTarea").innerHTML = '<b>Descripcion tarea: </b>'+DescripcionT;
     document.getElementById("comentarioAlumno").innerHTML = '<b>Comentario alumno:</b> '+comentarioAlumno;
     $("#ArchivoDescarga").attr("href",ArchivoDow);
     //document.getElementById("unidadTexto").innerHTML = unidad;
     //document.getElementById("grupoTexto").innerHTML = grupo;
    // $("#ok2").val(nombre);
    //  $("#ok").val(ID);
    // $("#ok2").val(nombre);

    //$("#NombreTarea").focus();
  }
  </script>
