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

    <section class="shadow contact-clean" style="background: rgb(3,77,139);padding-bottom: 184px;">
        <form class="bg-light border rounded border-secondary shadow-lg" method="post" style="background: rgb(248,248,249);">

            <h2 class="text-center">Registrar</h2>
            <div class="form-group mb-3"><input class="form-control" type="text" name="name" placeholder="Nombre"></div>


            <div class="form-group mb-3"><input class="form-control" type="text" name="last_name" placeholder="Apellido" inputmode="tel"></div>

            <div class="form-group mb-3">
                <input class="form-control" type="email" name="email" placeholder="Email">
                <input class="form-control" type="password" name="password" placeholder="Contrasena" type="password" style="width: 397.024px;padding-top: 12px;margin-top: 13px;">
                <input class="form-control" type="password" name="validate_password" placeholder="Ingrese nuevamente contrasena" style="width: 397.024px;padding-top: 12px;margin-top: 13px;">
            </div>

            <div class="form-group mb-3">
                <input class="btn btn-primary" type="submit" name="registrar" value="registrar">
            </div>

            <?php
            require_once('assets/class/fanlupaz_funciones.php');
            //error_reporting(0);
            $user = new Usuarios();

            //validar datos no esten vacios, sean del tipo correcto y que la contraseña coincida y que el email no este registrado
            if (isset($_POST['registrar'])) {

                //guardar token generado en una variable
                //$token = $user->generar_token($_POST['email']);

                //obtener token generado en sendemail.php
                $token = $_GET['token'];

                //enviar token por email
                $user->enviar_correo($_POST['email'], $token);

                //mostrar token en pantalla
                echo "<div class='alert alert-success' role='alert'>El token es: $token</div>";
                echo "<div class='alert alert-success' role='alert'>Se ha enviado un email de confirmacion a su cuenta de correo </div>";

                

            
            }


            
            ?>

        </form>

    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/script.min.js"></script>


</body>

</html>