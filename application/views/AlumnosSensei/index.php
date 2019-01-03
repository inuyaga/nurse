<link rel="stylesheet" href="<?= base_url('Bootstrap/css/Blog.css') ?>">
 <link rel="stylesheet" href="<?= base_url('Bootstrap/css/paginacion.css') ?>">


  <?php
  echo $paginacion;
foreach ($BlogsLista->result() as $key) { ?>
  <div class="row">
    <div class="col s10 offset-s1">


      <div class="card-container">
    <div class="card u-clearfix">
      <div class="card-body">
        <span class="card-number card-circle subtle"><?= $key->Blog_ID ?></span>
        <span class="card-author subtle"> <strong>Autor: </strong> <?= $key->Usuario_Nombre ?></span>
        <span class="card-author subtle"> <strong>Materia: </strong> <?= $key->Materia_Nombre ?></span>
        <h2 class="card-title"><?= $key->Blog_Nombre ?></h2>
        <span class="card-description subtle"><?= $key->Blog_Descripcion ?></span>
        <div href="#" class="card-read">  <a href="<?= base_url('Alumnos/BlogMasAlumno/'.$key->Blog_ID) ?>" class="card-read" data-position="bottom" data-delay="50" data-tooltip="Entrar">Leer</a></div>
        <span class="card-tag  subtle">
        </span>
        <span class="card-tag  subtle">

        </span>
        <!-- <span class="card-tag  subtle"> <a href="#"> <i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="Actualizar">system_update_alt</i></a> </span> -->

      </div>
      <img src="<?= $key->Blog_ImagenUrl ?>" alt="" class="card-media" width="282" height="361" />
    </div>
    <div class="card-shadow"></div>
  </div>



    </div>
  </div>
<?php }
echo $paginacion;
   ?>

</div>
