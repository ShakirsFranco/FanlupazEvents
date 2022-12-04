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
  <section class="position -relative py-4 py-xl-5">
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
              <form class="text-center" method="POST">
                <div class="mb-3"><input class="form-control" type="email" name="email" id="email" placeholder="Email"></div>
                <div class="mb-3"><input class="form-control" type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-group mb-3">
                  <input class="btn btn-primary" type="submit" name="logear" value="Logear">

                  <?php
  require_once('assets/class/fanlupaz_funciones.php');
  //error_reporting(0);
  $user = new Usuarios();

  //validar datos no esten vacios, sean del tipo correcto y que la contraseña coincida y que el email no este registrado
  if (isset($_POST['Logear'])) {

    $email = $_POST['email'];

    //$user->registrar_usuario($name, $last_name, $email, $password, $validate_password, $token);

    //enviar token por email
    $user->enviar_correo($_REQUEST['email']);
    //verificar email
    //$user->verificar_email($_REQUEST['email']);

    //mostrar token en pantalla
    //echo "<div class='alert alert-success' role='alert'>El token es: $token</div>";
    echo "<div class='alert alert-success' role='alert'>Se ha enviado un email de confirmacion a su cuenta de correo </div>";
  }
  ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>