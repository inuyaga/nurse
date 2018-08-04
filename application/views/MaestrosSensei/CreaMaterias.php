
<div class="col-lg-12 col-md-12">
	<div class="card">
		<div class="header">
			<h4 class="title">Crear materia</h4>
		</div>
		<div class="content">
			<form action="<?= base_url('Maestros/GuardaMaterias') ?>" method="POST">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Materia</label>
							<input type="text" class="form-control border-input" name="NombreMateria" placeholder="Nombre de la materia" required>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						    <label for="exampleFormControlSelect1">Seleccione Aula</label>
						    <select class="form-control" id="exampleFormControlSelect1" name="IDGrupo" required>
						      <?php foreach ($Grupos->result() as $grupo): ?>
						      	<option value="<?= $grupo->Grup_ID ?>"><?= $grupo->Grup_Nombre ?></option>
						      <?php endforeach ?>
						    </select>
				        </div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<br>
							<button type="submit" class="btn btn-info btn-fill btn-wd">Crear</button>
						</div>
					</div>
				</div>


				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>



<div class="col-lg-12 col-md-12">
	<div class="card">
		<div class="header">
			<h4 class="title">Materias</h4>
		</div>
		<div class="content">
             <div class="content table-responsive table-full-width">
			<table class="table table-striped">
				<thead>
					<tr>
			  			<th scope="col" colspan="4"></th>
			  			<th scope="col" colspan="2">Documentos</th>
			  			<th scope="col" colspan="2"></th>
					</tr>
					<tr>
						<th scope="col">#Inscripcion</th>
			  			<th scope="col">Materia</th>
			  			<th scope="col">Creado</th>
			  			<th scope="col">Grupo</th>
			  			<th scope="col">Subir</th>
			  			<th scope="col">Ver</th>
			  			<th scope="col">Alumnos</th>
			  			<th scope="col">Eliminar</th>
					</tr>
				</thead>
				<tbody>
          <?php foreach ($Materias->result() as $materias): ?> 
             <tr>
               <td><?= $materias->Materia_ID ?></td>
  				<td><?= $materias->Materia_Nombre ?></td>
  				<td><?= $materias->Materia_Fecha_Crea ?></td>
  				<td><?= $materias->Grup_Nombre ?></td>
					<td><button class="btn btn-success btn-sm" type="button" onclick="pasarinfo('<?= $materias->Materia_ID ?>', '<?= $materias->Materia_Nombre ?>')"  data-toggle="modal" data-target="#subirDocumento" data-whatever="@mdo" data-backdrop="false">Subir</button></td>
					<td><button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#DocuemntosMaterias" data-backdrop="false" onclick="VerDocuemtosMaterias(<?= $materias->Materia_ID ?>)">Ver</button></td>
  				<td><button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#ListaAlumnos" data-backdrop="false" onclick="lista(<?= $materias->Materia_ID ?>)">Lista</button></td>
  				<td> <a href="<?= base_url('Maestros/InformacionEliminaMateria/').$materias->Materia_ID ?>" class="btn btn-danger btn-sm"><?= $materias->Materia_ID ?>Eliminar</a></td>
             </tr>
          <?php endforeach; ?> 
				</tbody>
			</table>

		</div>
		</div>
	</div>
</div>




<div class="modal fade" id="subirDocumento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TextHeader">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('Maestros/GuardaDocumentosPorMateria') ?>" enctype="multipart/form-data" method="POST">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Descripcion</label>
								<input type="text" class="form-control border-input" name="descripcioDoc" id="descrip" name="descripcioDoc" placeholder="Brebe descripcion del archivo" required>
							</div>
						</div>
						<div class="col-md-3 hidden">
							<div class="form-group">
								<label>Materia</label>
								<input type="text" class="form-control border-input" name="IDMateria" id="IDMATERIA" placeholder="Nombre de la materia" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
						    <label for="exampleFormControlFile1">Archivo</label>
						    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="Archivo_file" required>
						  </div>
						</div>
					</div>
					<div class="row">

						 <div class="col-md-3">
 							<div class="form-group">
 						     <button type="submit" class="btn btn-primary mb-2">Guardar</button>
 						  </div>
 						</div>
					</div>


        </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div>





<!-- Button trigger modal -->




<div class="modal fade" id="DocuemntosMaterias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TextHeader">Documentos de Materia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div id="TablaDocMaterias"></div>
					</div>
				</div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="ListaAlumnos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TextHeader">Lista alumnos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<div class="row">
					<div class="col-md12">
						<div id="ListaDeAlumnos"></div>
					</div>
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
function pasarinfo(idmateria, materiaNom){
	$('#IDMATERIA').val(idmateria);

	document.getElementById("TextHeader").innerHTML = '<b>Subir documentos Materia: </b>'+materiaNom;
}


function VerDocuemtosMaterias(idMateria){
	$.post("docMaterias",
	{
		idMat: idMateria
	},
	function (data, status) {
		$('#TablaDocMaterias').html(data);


	});

}


function lista(idGrupo){

	$.post("MuestaListaAlumno",
	{
		idGrupo: idGrupo,
	},
	function (data, status) {
		$('#ListaDeAlumnos').html(data);

	});
}



function alerta(id){

	alertify.confirm('Eliminar','Esta seguro de elimar ',
	function(){
		alertify.success('Ok');
		window.location.href = "EliminaDocuemntoMateria/"+id;
	},
	function(){
		alertify.error('Cancel')
	});
}

</script>
