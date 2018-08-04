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

                <button onclick="VerDocuemtosMaterias(<?= $key->Materia_ID ?>)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" data-backdrop="false">
                Documentos
                </button>
              </div>

            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <div class="clearfix"></div>

    </div>
  </div>
</div>




<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Archivos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="TablaDocMaterias"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script>
       function VerDocuemtosMaterias(idMateria){
         $.post("<?= base_url('Alumnos/docMateriasAlumno') ?>",
         {
           idMat: idMateria
         },
         function (data, status) {
           $('#TablaDocMaterias').html(data);


         });

       }
     </script>
