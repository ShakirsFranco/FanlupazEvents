<?php
require_once 'assets/config/conf.php';
require_once 'assets/config/database.php';

$db = new Database();
$pdo = $db->connect();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == '') {
  echo "No se ha encontrado el producto";
  exit;
} else {

  $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

  if ($token == $token_tmp) {

    $statement = $pdo->prepare("SELECT count(id) FROM productos WHERE id = :id and activo = 1");
    $statement->execute(array(':id' => $id));
    $resultado = $statement->fetchColumn();

    if ($resultado == 0) {
      echo "No se ha encontrado el producto";
      exit;
    }
  } else {

    $statement = $pdo->prepare("SELECT id,nombre, descripcion, precio, stock FROM productos WHERE id = :id and activo = 1");
    $statement->execute(array(':id' => $id));
    $row = $statement->fetch();
    $id = $row['id'];
    $nombre = $row['nombre'];
    $descripcion = $row['descripcion'];
    $precio = $row['precio'];
    $stock = $row['stock'];

    $imagen = "assets/img/productos/" . $id . "/principal.jpg";

    if (!file_exists($imagen)) {
      $imagen = "assets/img/no_foto.jpg";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Fanlupaz_Events_login</title>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/styles.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
</head>

<body>
  <!-- Start: Navbar Centered Links -->
  <nav class="navbar navbar-light navbar-expand-md py-3">
    <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bezier">
            <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z">
            </path>
            <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z">
            </path>
          </svg></span><span>Fanlupaz Events</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-3"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navcol-3">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item"><a class="nav-link active" href="Homepage.php">Sobre Nosotros</a></li>
          <li class="nav-item"><a class="nav-link" href="paquetes.php">Paquetes</a></li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="registrar.php">Cerrar Sesi??n</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main>
    <div class="container">
      <div class="row">
        <!-- mostrar imagen por id -->
        <div class="col-md-6 order-md-1">
          <img src="<?php echo $imagen; ?>" class="img-fluid" alt="...">
        </div>
        <div class="col-md-6 order-md-2">
          <h2><?php echo $nombre; ?></h2>
          <h2><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></h2>
          <p class="lead">
            <?php echo $descripcion; ?>
          </p>

          <?php if ($row['stock'] > 0) { ?>
            <form method="POST">
               <!--mostrar box de cantidad-->
            <input type="number" name="cantidad" min="1" max="<?php echo $row['stock']; ?>">
            <!--mostrar boton de agregar al carrito con color verde-->
              <button type="submit" name="comprar" class="btn btn-sm btn-outline-success">Comprar</button>
            </form>
           
          <?php } else { ?>
            <!--mostrar boton de agoregar al carrito con color rojo y deshabilitado-->
            <button type="button" class="btn btn-sm btn-outline-danger" disabled>Agotado</button>
          <?php }

          ?>
          <!--Regresar a la pagina de productos-->
          <a href="paquetes.php" class="btn btn-sm btn-outline-secondary">Regresar</a>

        </div>
      </div>

      <?php
      
            if (isset($_POST['cantidad'])>0 && isset($_POST['comprar'])) {
              $cantidad = $_POST['cantidad'];
              $id_producto = $row['id'];
              echo $cantidad;
  
                //actualizar stock
                $sql = "CALL actualizar_stock($id, $cantidad)";
                $result = $pdo->query($sql);
                $row = $result->fetch(PDO::FETCH_ASSOC);

                //mensaje de exito y redireccionar a la pagina de paquetes luego de 2 segundos
                echo '<div class="alert alert-success" role="alert">
                Producto agregado al carrito
                </div>';
                header("refresh:2;url=paquetes.php");
            }
            

            ?>

    </div>
    </div>
    </div>
  </main>


  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="assets/js/script.min.js"></script>
  </script>
</body>

</html>