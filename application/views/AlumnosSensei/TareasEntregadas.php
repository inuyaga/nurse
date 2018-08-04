<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="header">
      <h4 class="title">Materias</h4>
    </div>
    <div class="content">

      <?php if ($MisMaterias->result() != null): ?>
        <?php foreach ($MisMaterias->result() as $key): ?>
          <div class="col-lg-4 col-md-6">
            <div class="card text-center">
              <div class="card-header">
                <!-- <i class="ti-book"></i> -->
                <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
               </div>
              <div class="card-body">
                <h5 class="card-title">Materia: <?= $key->Materia_Nombre ?></h5>
                <h6 class="card-title">Maestro: <?= $key->NombreMaestro ?></h6>
                <h6 class="card-title">Aula: <?= $key->Grup_Nombre ?></h6>

                <p class="card-text"> </p>
                <a class="btn btn-success"  href="<?= base_url('Alumnos/TareasEntregadasMateriaUnidad/').$key->Materia_ID ?>">Entar</a>
              </div>

            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <div class="clearfix"></div>

    </div>
  </div>
</div>
