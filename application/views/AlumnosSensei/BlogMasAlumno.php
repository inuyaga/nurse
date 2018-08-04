<div class="col-lg-12 col-md-12">
	<div class="card">
		<div class="header">
			<h4 class="title">Lectura de blogs</h4>
		</div>
		<div class="content">

			<?php foreach ($Blogs->result() as $key): ?>
             <?php echo $key->Blog_Contenido ?>
        <?php endforeach; ?>


<br>
<br>
		<?php foreach ($Comentarios->result() as $comenta): ?>
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading"><?= $comenta->Comentario_Nombre ?></div>
					<div class="panel-body"><?= $comenta->Comentario_Comentario ?></div>
				</div>

			<div class="clearfix"></div>
		</div>
		<?php endforeach; ?>

	</div>
</div>



<div class="card">
	<div class="header">
		<h4 class="title">Deja un comentario: <?= $this->session->Nombre ?></h4>
	</div>
	<div class="content">

		<div class="row">
			<div class="col-lg-8 col-md-8">
				<form>


			 </form>



			 <form action="<?= base_url('Alumnos/GuardaComentarioBlog') ?>" method="post">
               <div class="input-field col s3 hide">
                <input type="" value="<?= $_SERVER["REQUEST_URI"] ?>" name="PaginaRetorno">
              </div>
              <input type="text" class="hide" name="idBlod" value="<?= $IDBlog ?>">
              <input type="text" class="hide" name="Nombre" value="<?= $this->session->Nombre ?>">
              <input type="text" class="hide" name="imagenPerfil" value="<?= $this->session->Avatar ?>">
               <p>Comentar</p>
                <textarea name="Comentario" class="form-control textoArea" placeholder="Escribe aqui tu comentario" rows="3"></textarea>
                <br>
                <button type="submit" class="btn btn-info">Enviar</button>
             </form>
			</div>

		</div>


</div>
</div>




</div>
