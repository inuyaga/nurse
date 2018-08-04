<div class="col-lg-12 col-md-12">
	<div class="card">
		<div class="header">
			<h4 class="title"><?= $NombreMateria ?></h4>
      <h5>Unidades</h5>
		</div>
		<div class="content">
      <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-md-12">
              <div class="card">

                <ul class="list-group list-group-flush">
                  <?php foreach ($UnidadMateria->result() as $key): ?>

                      <li class="list-group-item"><a href="<?= base_url('Alumnos/TareasEntregadasAlumno/').$this->session->ID_Usuario.'/'.$IDMareia.'/'.$key->Unidades_ID ?>"><?= $key->Unidad_Descripcion ?></a></li>

                  <?php endforeach; ?>
                </ul>
                <div class="card-block">

                </div>
              </div>
            </div>

        </div>
      </div>
    </div>
    <div class="clearfix"></div>
		</div>
	</div>
