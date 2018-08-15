<!DOCTYPE html>
<html lang="en">

<head>
	<title>Nurse Class</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?=base_url('Login/')?>images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('Login/')?>vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('Login/')?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('Login/')?>fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('Login/')?>vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('Login/')?>vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('Login/')?>vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('Login/')?>vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('Login/')?>vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('Login/')?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('Login/')?>css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="<?php echo base_url('Bienvenido/InicioSesion'); ?>" method="POST">
					<span class="login100-form-title p-b-26">
						Bienvenido
					</span>
					<span class="login100-form-title p-b-26">
						<h6>Nurse Class</h6>
						<img src="<?=base_url('publico/img/logo.png')?>" alt="" height="80" width="80">
					</span>



					<div class="wrap-input100 validate-input" data-validate="Ingrese nombre de usuario">
						<input class="input100" type="text" name="Usuario">
						<span class="focus-input100" data-placeholder="Usuario"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Ingrese contraseña">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="Passwod">
						<span class="focus-input100" data-placeholder="Contraseña"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Entrar
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Crear cuenta, presione
						</span>

						<a class="txt2" href="<?=base_url('Bienvenido/AltaUsuarios')?>">
							aqui
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="<?=base_url('Login/')?>vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?=base_url('Login/')?>vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?=base_url('Login/')?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?=base_url('Login/')?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?=base_url('Login/')?>vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?=base_url('Login/')?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?=base_url('Login/')?>vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="<?=base_url('Login/')?>vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="<?=base_url('Login/')?>js/main.js"></script>

</body>

</html>