<div class="col-lg-12 col-md-12">
	<div class="card">
		<div class="header">
			<h4 class="title"><?= $NombreMateria ?></h4>
			
      <h6>Lista de alumnos</h6>
		</div>
		<div class="content">
      <div class="content table-responsive table-full-width">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Aula</th>
            <th scope="col">Accion</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ListaAlumnos->result() as $lista): ?>
            <tr>
              <td> <img class="circle" src="<?= base_url($lista->Usuario_Avatar) ?>" width="50" height="50"></td>
              <td><?= $lista->Alumno_Nombre ?></td>
              <td><?= $lista->AlumnoCorreo ?>mdo</td>
              <td><?= $lista->Grup_Nombre ?></td>
              <td> <a class="btn btn-info" href="<?= base_url('Maestros/RevisionTareasAlumnos/').$lista->Alumno_ID.'/'.$IDMateria ?>" target="_blank">Calificar</a> </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    </div>
				<div class="clearfix"></div>
		</div>
	</div>
