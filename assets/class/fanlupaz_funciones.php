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


    //funcion que genera un token aleatorio y mostrarlo en pantalla
    public function generar_token($email){
        $this->email = $email;
        $token = bin2hex(random_bytes(4));
        return $token;
        //echo $token;
    }

    //llamar al archivo sendmail.php
    public function enviar_correo($email){
        require_once('email/sendmail.php');
        $this->email = $email;
        $this->token = $token;
    }

    //actualizar token
    public function actualizar_token($token, $email){
        $this->email = $email;
        $this->token = $token;
        $sql = "CALL actualizar_token('$this->token', '$this->email')";
        $consulta = $this->_db->query($sql);
    }

    //Verificar si el email ya esta registrado con codigo sql base select * from usuarios where email = '$email'
    public function verificar_email($email){
        $this->email = $email;
        $sql = "SELECT * FROM usuarios WHERE email = '$this->email'";
        $consulta = $this->_db->query($sql);
        if($consulta->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    //Validar token ligado al email
    public function validar_token($token, $email){
        $this->email = $email;
        $this->token = $token;
        $sql = "SELECT * FROM usuarios WHERE email = '$this->email' AND token = '$token'";
        $consulta = $this->_db->query($sql);
        if($consulta->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    //Verificar si el correo y la contraseña coinciden
public function login($email, $password){
    $this->email = $email;
    $this->password = $password;
    $sql = "SELECT * FROM usuarios WHERE email = '$this->email' AND password = '$this->password'";
    $consulta = $this->_db->query($sql);
    if($consulta->num_rows > 0){
        return true;
    }else{
        return false;
    }
}

    //cerrar sesion
    public function cerrar_sesion(){
        
        header('Location: registrar.php');
    }
}



?>