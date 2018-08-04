<div class="main-panel">

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
				<a class="navbar-brand" href="#"><img src="<?= base_url($this->session->Avatar) ?>" class="img-circle" width="30" height="30" alt="..." /></a>
				<a class="navbar-brand" href="<?= base_url('Alumnos') ?>">Principal</a>


			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="ti-panel"></i>
            <p>Stats</p>
                        </a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-bell"></i>
                                <p class="notification">5</p>
              <p>Notifications</p>
              <b class="caret"></b>
                          </a>
						<ul class="dropdown-menu">
							<li><a href="#">Notification 1</a></li>
							<li><a href="#">Notification 2</a></li>
							<li><a href="#">Notification 3</a></li>
							<li><a href="#">Notification 4</a></li>
							<li><a href="#">Another notification</a></li>
						</ul>
					</li>
					<li>
						<a href="<?= base_url('Alumnos/Perfil') ?>">
            <i class="ti-settings"></i>
            <p>Settings</p>
                        </a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user-circle-o"></i>

              <p><?= $this->session->Usuario ?></p>
              <b class="caret"></b>
                          </a>
						<ul class="dropdown-menu">
							<li><a href="#" type="button" data-toggle="modal" data-target="#ModalUnion" data-backdrop="false">Unirme a un aula</a></li>
							<li><a href="<?= base_url('Alumnos/CerrarSesion') ?>">Salir</a></li>
						</ul>
					</li>
				</ul>

			</div>
		</div>
	</nav>



<!-- Modal -->
<div class="modal fade" id="ModalUnion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Integrarse a una aula</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
					<form action="<?= base_url('Alumnos/GuardaUnionAgrupo') ?>" method="POST">
						<div class="col-lg-4 col-md-4">
							<div class="form-group">
						    <label for="exampleFormControlInput1">Clave</label>
						    <input type="number" class="form-control" id="exampleFormControlInput1" name="IDGrupoRegistrar" placeholder="Numeros enteros">
						  </div>
	          </div>
						<div class="col-lg-12 col-md-12">
							<div class="form-group">

						    <button type="submit" class="btn btn-success">Inscribir</button>
						  </div>
	          </div>
					</form>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
