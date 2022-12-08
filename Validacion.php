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

    <section class="shadow contact-clean" style="background: rgb(3,77,139);padding-top: 50px;padding-bottom: 354px;">
        <form class="bg-light border rounded border-secondary shadow-lg" method="post" style="background: rgb(248,248,249);">
            <h2 class="text-center">Ingrese Codigo de Validacion</h2>
            <div class="form-group mb-3">
                <input class="form-control" type="text" name="Codigo" id="Codigo" placeholder="Codigo">
            </div>
            <div class="form-group mb-3">
                <input class="btn btn-primary" type="submit" name="Validar" value="Validar">
            </div>
        </form>
    </section>

    
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/script.min.js"></script>


    <?php
    require_once('assets/class/fanlupaz_funciones.php');
    //error_reporting(0);
    $user = new Usuarios();

    //obtener email de la pagina anterior
    $email = $_GET['email'];

    //si se presiona el boton de validar
    if(isset($_POST['Validar'])){
        //verificar si los campos estan vacios
        if(empty($_POST['Codigo'])){
            echo "Por favor ingrese el codigo de validacion";
        }else{
            //obtener los datos del formulario
            $Codigo = $_POST['Codigo'];
            //verificar si el codigo es correcto
            $verificar = $user->validar_token($Codigo, $email);
            if($verificar){
                //si es correcto redireccionar a la pagina de index.php
                // si es correcto redireccionar a la pagina luego de 3 segundos
                echo "<div class='alert alert-success' role='alert'>Codigo de validacion correcto</div>";
                header("refresh:3; url=Homepage.php");
            }else{
                //mensaje de error
                echo "<div class='alert alert-danger' role='alert'>Codigo de validacion incorrecto</div>";
            }
        }
    }
    
    ?>
</body>

</html>