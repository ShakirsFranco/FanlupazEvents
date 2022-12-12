<?php
require_once 'assets/class/modelo.php';
//conectar a la base de datos   

class Productos extends modeloCredencialesBD {
    
        protected $id;
        protected $nombre;
        protected $descripcion;
        protected $precio;
        protected $stock;
        protected $id_categoria;
        protected $activo;

        //constructor
        public function __construct(){
            parent::__construct();
        }

        //mostrar productos por activo
        public function mostrar_producto(){
            $sql = "SELECT * FROM productos WHERE activo = 1";
            $consulta = $this->_db->query($sql);
            $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
            return $resultado;
        }

        //actualizar stock
        public function actualizar_stock($id, $cantidad){
            $sql = "UPDATE productos SET stock = stock - $cantidad WHERE id = $id";
            $consulta = $this->_db->query($sql);
            $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
            return $resultado;
            

        }
}
        

?>