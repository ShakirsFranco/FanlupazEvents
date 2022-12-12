<?php
require_once 'assets/config/conf.php';
require_once 'assets/config/database.php';
require_once 'assets/class/productos_funciones.php';

//crear objeto de la clase productos
$producto = new Productos();
//obtener id del producto
$id = $_REQUEST['id'];
$cantidad = $_REQUEST['cantidad'];


//actualizar stock
$producto->actualizar_stock($id, $cantidad);




?>