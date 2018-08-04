<script src="<?= base_url('publico/js/ckeditor/ckeditor.js') ?>" type="text/javascript"></script>





<div class="col-lg-12 col-md-12">
	<div class="card">
		<div class="header">
			<h4 class="title">Editar blog</h4>
		</div>
		<div class="content">
			<?php foreach ($Blogs->result() as $key): ?>
			<form class="" action="<?= base_url('Maestros/BlogActualiza') ?>" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-6 col-md-6">
             <div class="form-group">
                <label>Nombre</label>
			    <input type="text" placeholder="Nombre" id="name" name="Nombre" value="<?= $key->Blog_Nombre ?>" required class="form-control" />
			</div>
          </div>

          <div class="col-lg-6 col-md-6">
             <div class="form-group">
                <label>Url imagen</label>
			    <input type="text" placeholder="URL imagen" id="name" name="ImagenUrl" value="<?= $key->Blog_ImagenUrl ?>" required class="form-control" />
			</div>
          </div>

          <div class="col s12 hide">
            <input type="text" name="IDBlog" value="<?= $IdBlog ?>">
          </div>


          <div class="col-lg-6 col-md-6">
			<div class="form-group">
			    <label for="grup">Seleccione Materia</label>
			    <select class="form-control" id="grup" name="IDMateria" value="<?= $key->Blog_ID_Materia ?>" required>
			      <?php foreach ($Materias->result() as $materia): ?>
			      	<?php if ($materia->Materia_ID == $key->Blog_ID_Materia): ?>
			    <option value="<?= $materia->Materia_ID ?>" selected><?= $materia->Materia_Nombre.' ('.$materia->Grup_Nombre.')' ?></option>
			     <?php else: ?>
			 	<option value="<?= $materia->Materia_ID ?>"><?= $materia->Materia_Nombre.' ('.$materia->Grup_Nombre.')' ?></option>
			      	<?php endif ?>
			      <?php endforeach ?>
			    </select>
	        </div>
		</div>


        <div class="col-lg-6 col-md-6">
             <div class="form-group">
                <label>Descripcion</label>
			    <input type="text" placeholder="Brebe descripcion" id="name" name="Descripcion" value="<?= $key->Blog_Descripcion ?>" required class="form-control border border-success" />
			</div>
          </div>

          </div>
          <textarea name="blog" class="ckeditor"><?php echo $key->Blog_Contenido ?></textarea>
          <br>
          <button type="submit" class="btn btn-success">Guardar</button>
        </form>	
			<?php endforeach ?>
			
		</div>
	</div>
</div>


<style> 
input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 3px solid #ccc;
    -webkit-transition: 0.5s;
    transition: 0.5s;
    outline: none;
}

input[type=text]:focus {
    border: 3px solid #555;
}
</style>