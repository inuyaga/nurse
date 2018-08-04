<div class="col-lg-12 col-md-12">
	<div class="card">
		<div class="header">
			<h4 class="title"><?= $NombreMateria.' Tareas: '.$TareasXmateria ?></h4>
      <h3>Unidades</h3>
      <div class="row">
        <div class="col-md-3">
          <h5><?php echo 'Tareas entregadas: '.$NumeroTareasXalumno ?></h5>
        </div>
        <div class="col-md-3">
          <h5><?php echo 'Tareas calificadas: '.$CalificadasDelAlumno ?></h5>
        </div>
        <div class="col-md-3">
          <h5><?php echo 'Puntuación: '.$SumaTareasXalumno ?></h5>
        </div>
        <div class="col-md-3">
          <h5><?php echo 'Calificación: '.round($Calificacion, 3) ?></h5>
        </div>
      </div>
        
        
        
         
		</div>
		<div class="content">
      <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-md-12">
              <div class="card">

                <ul class="list-group list-group-flush">
                  <?php foreach ($UnidadMateria->result() as $key): ?>

                      <li class="list-group-item"><a href="<?= base_url('Maestros/UnidadesMateriasXAlumno/').$IDAlumno.'/'.$IDMareia.'/'.$key->Unidades_ID ?>"><?= $key->Unidad_Descripcion ?></a></li>

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
