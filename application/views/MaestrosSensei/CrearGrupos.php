
<div class="col-lg-12 col-md-12">
	<div class="card">
		<div class="header">
			<h4 class="title">Crear aula virtual</h4>
		</div>
		<div class="content">
			<form action="<?= base_url('Maestros/GuardaGrupo') ?>" method="POST">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Aula</label>
							<input type="text" class="form-control border-input" name="GrupoNom" placeholder="Nombre del aula " required>
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
			<h4 class="title">Listas de aula</h4>
		</div>
		<div class="content">
         <div class="content table-responsive table-full-width">
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Aula</th>
						<th scope="col">Creado</th>
						<th scope="col">Accion</th>
					</tr>
				</thead> 
				<tbody>
          <?php foreach ($Grupos->result() as $grupo): ?>
             <tr>
               <td><?= $grupo->Grup_ID ?></td>
               <td><?= $grupo->Grup_Nombre ?></td>
               <td><?= $grupo->Grup_FechaAdicion ?></td>
               <td> <a href="<?= base_url('Maestros/EliminaGrupos/').$grupo->Grup_ID.'/'.$grupo->Grup_Nombre ?>" type="button" class="btn btn-danger">Elimina</a> </td>
             </tr>
          <?php endforeach; ?>
				</tbody>
			</table>

		</div>
		</div>
	</div>
</div>
