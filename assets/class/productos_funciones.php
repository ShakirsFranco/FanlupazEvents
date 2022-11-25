<?php
require_once('modelo.php');
//conectar a la base de datos   

class Productos extends modeloCredencialesBD {
    
        protected $id;
        protected $nombre;
        protected $descripcion;
        protected $precio;
        protected $id_categoria;
        protected $activo;

        //constructor
        public function __construct(){
            parent::__construct();
        }

        //mostrar productos por activo
        public function mostrar_productos(){
            $sql = "SELECT * FROM productos WHERE activo = 1";
            $consulta = $this->_db->query($sql);
            $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
            return $resultado;
        }
}
        

?>