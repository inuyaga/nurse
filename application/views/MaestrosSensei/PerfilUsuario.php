<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4 col-md-5">
				<div class="card card-user">
					<div class="image">
						<img src="<?= base_url('publico/img/FondoPerfil.jpg') ?>" alt="..." />
					</div>
					<div class="content">
						<div class="author">
							<img class="avatar border-white" src="<?= base_url($this->session->Avatar) ?>" alt="..." />
							<h4 class="title"><?= $this->session->Nombre ?><br />
                                     <a href="#"><small><?= $this->session->Correo ?></small></a>
                                  </h4>
						</div>
						<p class="description text-center">
							"<?= $this->session->Usuario_Mensaje ?>"
						</p>
					</div>
					<hr>
					
				</div>
				<!-- <div class="card">
					<div class="header">
						<h4 class="title">Team Members</h4>
					</div>
					<div class="content">
						<ul class="list-unstyled team-members">
							<li>
								<div class="row">
									<div class="col-xs-3">
										<div class="avatar">
											<img src="assets/img/faces/face-0.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
										</div>
									</div>
									<div class="col-xs-6">
										DJ Khaled
										<br />
										<span class="text-muted"><small>Offline</small></span>
									</div>

									<div class="col-xs-3 text-right">
										<btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col-xs-3">
										<div class="avatar">
											<img src="assets/img/faces/face-1.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
										</div>
									</div>
									<div class="col-xs-6">
										Creative Tim
										<br />
										<span class="text-success"><small>Available</small></span>
									</div>

									<div class="col-xs-3 text-right">
										<btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col-xs-3">
										<div class="avatar">
											<img src="assets/img/faces/face-3.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
										</div>
									</div>
									<div class="col-xs-6">
										Flume
										<br />
										<span class="text-danger"><small>Busy</small></span>
									</div>

									<div class="col-xs-3 text-right">
										<btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div> -->
			</div>
			<div class="col-lg-8 col-md-7">
				<div class="card">
					<div class="header">
						<h4 class="title">Editar perfil</h4>
					</div>
					<div class="content">
						<form action="<?= base_url('Maestros/GuardaPerfin') ?>" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label>Nombre</label>
										<input name="nombre" type="text" class="form-control border-input" placeholder="Nombre completo" value="<?= $this->session->Nombre ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Usuario</label>
										<input type="text" class="form-control border-input" placeholder="Username" disabled value="<?= $this->session->Usuario ?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="exampleInputEmail1">Correo electronico</label>
										<input name="email" type="email" class="form-control border-input" placeholder="Correo" value="<?= $this->session->Correo ?>">
									</div>
								</div> 
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label for="exampleFormControlFile1">Foto perfil</label>
									<input name="avatar" type="file" class="form-control-file" id="exampleFormControlFile1" required>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
											<label>Mensaje</label>
											<input maxlength="255" type="text" class="form-control border-input" name="msn_perfil" placeholder="Mensaje" value="<?= $this->session->Usuario_Mensaje ?>">
									</div>
									
							    </div>

							</div>

							<div class="text-center">
								<button type="submit" class="btn btn-info btn-fill btn-wd">Actualizar Perfil</button>
							</div>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
