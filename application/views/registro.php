<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Alta usuarios NurseClass</title>
</head>

<body>
  <div class="container">
<br>
      <div class="row">
        <div class="container-fluid">
          <div class="row centered">
            <div class="col-sm-4 col-md-4">

            </div>
            <div class="col-sm-4 col-md-4">
              <?php if ($this->session->flashdata('mensaje')): ?>
                <div class="alert alert-danger" role="alert">
                   <?php echo $this->session->mensaje ?>
                 </div>
              <?php endif; ?>
              <h4>Registro de usuarios</h4>
              <form method="post" action="<?= base_url('Bienvenido/Guardar_usuario') ?>">
                <div class="form-group">
                  <label for="exampleFormControlInput1">Nombre</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nombre completo" name="name" required>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlInput1">Usuario</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Usuario sin espacios" name="usuario" required>
                </div>



                <div class="row">
                  <div class="col-xs-6 col-md-6">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Contraseña</label>
                      <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Contraseña facil de recordar" name="password" required>
                    </div>
                  </div>
                  <div class="col-xs-6 col-md-6">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Confirme contraseña</label>
                      <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Repita" name="password2" required>
                    </div>
                  </div>
                </div>



                <div class="form-group">
                  <label for="exampleFormControlInput1">Email</label>
                  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="alguien@ejemplo.com" name="email" required>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlSelect1">Tipo de registro</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="tip" required>
                    <option selected disabled>Eliga una opcion</option>
                    <option value="2">Alumno</option>
                    <option value="1">Maestro</option>
                  </select>
                </div>
                 <?php echo $this->recaptcha->render(); ?>
                <div class="form-group">
                  <button type="submit" class="btn btn-success">Crear</button>
                </div>


              </form>
            </div>
            <div class="col-sm-4 col-md-4">

            </div>
          </div>
        </div>
      </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
