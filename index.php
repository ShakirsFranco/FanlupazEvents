<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Fanlupaz_Events_login</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/styles.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
</head>

<body>
  <!-- Start: Login Form Basic -->
  <section class="position-relative py-4 py-xl-5">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
          <h2>Fanlupaz Events</h2>
          <p class="w-lg-50"></p>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-xl-4">
          <div class="card mb-5">
            <div class="card-body d-flex flex-column align-items-center">
              <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4" data-aos="fade"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z">
                  </path>
                </svg></div>
              <form class="text-center" method="get">
                <div class="mb-3"><input class="form-control" type="email" name="email" id="email" placeholder="Email"></div>
                <div class="mb-3"><input class="form-control" type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-group mb-3">
                <input class="btn btn-primary" type="submit" name="logear" value="registrar">
            </div>
                <p class="text-muted">Forgot your password?</p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End: Login Form Basic -->
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="assets/js/script.min.js"></script>

  <?php
  
  require_once('assets/class/fanlupaz_funciones.php');
  //error_reporting(0);
  $user = new Usuarios();

  $mail = $_REQUEST['email'];
  $pass = $_REQUEST['password'];

  // si se presiona el boton de logear
  if (isset($_POST['logear'])) {
    //validar que los campos no esten vacios
    if (empty($mail) || empty($pass)) {
      echo "<script>alert('Los campos no pueden estar vacios')</script>";
    } else {
      //validar que el usuario exista
      $user->iniciar_sesion($mail, $pass);
      //redireccionar a la validaion.php
      header('location:validacion.php');
    }
  }
  




  ?>

</body>

</html>