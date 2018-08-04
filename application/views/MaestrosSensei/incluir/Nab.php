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
				<a class="navbar-brand" href="<?= base_url('Maestros') ?>">Principal</a>


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
                                <i class="ti-comment-alt"></i>
                                <p class="notification"> <?php if($NumberComentarioAlum != 0){echo $NumberComentarioAlum;} ?></p>
              <p>Comentarios</p>
              <b class="caret"></b>
                          </a>
						<ul class="dropdown-menu">
							<?php foreach ($ComentarioAlum->result() as $key): ?>
								<li><a href="<?= base_url('Maestros/Leercomentario/').$key->Blog_ID ?>"><?= $key->Comentario_Nombre  ?></a></li>
							<?php endforeach ?>
						</ul>
					</li>
					<li>
						<a href="#">
            <i class="ti-settings"></i>
            <p>Configuracion</p>
                        </a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user-circle-o"></i>

              <p><?= $this->session->Usuario ?></p>
              <b class="caret"></b>
                          </a>
						<ul class="dropdown-menu">
							<li><a href="<?= base_url('Maestros/BlogEntradas') ?>">Escribir Blog</a></li>
							<li><a href="<?= base_url('Maestros/CerrarSesion') ?>">Salir</a></li>

						</ul>
					</li>
				</ul>

			</div>
		</div>
	</nav>
