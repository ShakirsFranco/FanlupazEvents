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
        <form class="bg-light border rounded border-secondary shadow-lg" method="POST" style="background: rgb(248,248,249);">

            <h2 class="text-center">Iniciar Sesion</h2>

            <div class="form-group mb-3">
                <!-- enviar email mediante get a la pagina de validacion -->
                <input class="form-control" type="email" name="email" placeholder="Email" inputmode="tel">
                <!--<input class="form-control" type="email" name="email" placeholder="Email">-->
                <input class="form-control" type="password" name="password" placeholder="Contrasena" type="password" style="width: 397.024px;padding-top: 12px;margin-top: 13px;">
            </div>

            <div class="form-group mb-3">
                <input class="btn btn-primary" type="submit" name="Ingresar" value="Ingresar">
            </div>

            <?php
            require_once('assets/class/fanlupaz_funciones.php');
            //error_reporting(0);
            $user = new Usuarios();

            //validar datos no esten vacios, sean del tipo correcto y que la contraseña coincida y que el email no este registrado
            if (isset($_POST['Ingresar'])) {

                //validar que los campos no esten vacios
                if (empty($_POST['email']) || empty($_POST['password'])) {
                    echo "<div class='alert alert-danger' role='alert'>Por favor llene todos los campos</div>";
                } 
                else {
                    //validar que el email sea del tipo correcto
                    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        echo "<div class='alert alert-danger' role='alert'>Por favor ingrese un email valido</div>";
                    } 
                    else {
                        //validar que el email este registrado
                        if (!$user->verificar_email($_POST['email'])) {
                            echo "<div class='alert alert-danger' role='alert'>El email no esta registrado</div>";
                        } 
                        else {
                            //validar que la contraseña coincida
                            if ($user->login($_POST['email'], $_POST['password'])) {
                                //enviar token por email
                                $user->enviar_correo($_POST['email']);
                                //Mostrar mensaje de correo enviado y redireccionar a la pagina de validacion luego de 5 segundos
                                echo "<div class='alert alert-success' role='alert'>Se ha enviado un correo de validacion a su cuenta de correo electronico</div>";
                                //header("refresh:5; url=validacion.php");
                                header('refresh:3; url= Validacion.php?email=' . $_POST['email']);
                            
                            }
                            else {
                                echo "<div class='alert alert-danger' role='alert'>La contraseña es incorrecta</div>";
                            }
                        }
                    }
                }
            }
        
        

            ?>
        </form>

    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/script.min.js"></script>

</body>

</html>