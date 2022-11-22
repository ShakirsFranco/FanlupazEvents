<?php
//guardar los datos en la base de datos
require_once('modelo.php');
//conectar a la base de datos   

class Usuarios extends modeloCredencialesBD {

    protected $name;
    protected $lastname;
    protected $email;
    protected $password;
    protected $confirm_password;
    public $token;

    //constructor
    public function __construct(){
        parent::__construct();
    }

    //metodo para registrar usuario
    public function registrar_usuario($name, $lastname, $email, $password, $confirm_password){
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        
        $instruccion = "CALL insertar_usuario('$this->name', '$this->lastname', '$this->email', '$this->password', '$this->confirm_password')";
        $consulta = $this->_db->query($instruccion);
        $resultado = mysqli_multi_query($this->_db, $instruccion);
        $resultado = mysqli_store_result($this->_db);
        $resultado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);


        if (!$resultado){
            return false;
        }else{
            return true;
        }
    }

    //verificar email no este registrado
    public function verificar_email($email){
        $this->email = $email;
        $sql = "CALL verificar_email('$this->email')";
        $result = $this->_db->query($sql);
        $resultado = mysqli_multi_query($this->_db, $sql);
        $resultado = mysqli_store_result($this->_db);
        $resultado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        if($resultado){
            echo "<div class='alert alert-danger' role='alert'>El email ya esta registrado</div>";
            return false;
        }else{
            return true;
        }
    }

    //funcion que genera un token aleatorio y mostrarlo en pantalla
    public function generar_token($email){
        $this->email = $email;
        $token = bin2hex(random_bytes(4));
        

        return $token;
        //echo $token;
    }

    

    //FUNCION INSERTAR TOKEN
    public function insertar_token($token, $email){
        $this->email = $email;
        $this->token = $token;
        $sql = "CALL insertar_token(' '$this->token',$this->email)";
        $consulta = $this->_db->query($sql);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        if(!$resultado){
            return false;
        }else{
            return true;
        }
    }

    //llamar al archivo sendmail.php
    public function enviar_correo($email, $token){
        require_once('email/sendmail.php');
        $this->email = $email;
        $this->token = $token;
        



    }





    
}

?>