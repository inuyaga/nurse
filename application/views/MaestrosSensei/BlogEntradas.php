<script src="<?= base_url('publico/js/ckeditor/ckeditor.js') ?>" type="text/javascript"></script>





<div class="col-lg-12 col-md-12">
	<div class="card">
		<div class="header">
			<h4 class="title">Nueva entrada</h4>
		</div>
		<div class="content">
			<form action="<?= base_url('Maestros/GuardaBlogEntradas') ?>" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-6 col-md-6">
             <div class="form-group">
                <label>Nombre</label>
			    <input type="text" placeholder="Nombre" id="name" name="Nombre" required class="form-control" />
			</div>
          </div>

          <div class="col-lg-6 col-md-6">
             <div class="form-group">
                <label>Url imagen</label>
			    <input type="text" placeholder="URL imagen" id="name" name="ImagenUrl" required class="form-control" />
			</div>
          </div>

          

          <div class="col-lg-6 col-md-6">
			<div class="form-group">
			    <label for="grup">Seleccione Materia</label>
			    <select class="form-control" id="grup" name="IDMateria" value="<?= $key->Blog_ID_Materia ?>" required>
            <option disabled selected>Elina una opcion</option>
			      <?php foreach ($Materias->result() as $materia): ?>
			 	<option value="<?= $materia->Materia_ID ?>"><?= $materia->Materia_Nombre.' ('.$materia->Grup_Nombre.')' ?></option>
			      	
			      <?php endforeach ?>
			    </select>
	        </div>
		</div>


        <div class="col-lg-6 col-md-6">
             <div class="form-group">
                <label>Descripcion</label>
			    <input type="text" placeholder="Brebe descripcion" id="name" name="Descripcion" required class="form-control border border-success" />
			</div>
          </div>

          </div>
          <textarea name="blog" class="ckeditor"></textarea>
          <br>
          <button type="submit" class="btn btn-success">Guardar</button>
        </form>	
			
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