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
    /*public function registrar_usuario($name, $lastname, $email, $password, $confirm_password,$token){
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        $this->token = $token;

        //validar que los datos no esten vacios
        if (empty($this->name) || empty($this->lastname) || empty($this->email) || empty($this->password) || empty($this->confirm_password)) {
            echo "<div class='alert alert-danger' role='alert'>Por favor complete todos los campos</div>";
        }else{
            //validar que el email sea correcto
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                echo "<div class='alert alert-danger' role='alert'>El email no es valido</div>";
            }else{
                //validar que la contraseña coincida
                if ($this->password != $this->confirm_password) {
                    echo "<div class='alert alert-danger' role='alert'>Las contraseñas no coinciden</div>";
                }else{
                    //validar que el email no este registrado
                    $sql = "CALL verificar_email('$this->email')";
                    $resultado = $this->_db->query($sql);
                    $row = $resultado->fetch_assoc();
                    if ($row['email'] == $this->email) {
                        echo "<div class='alert alert-danger' role='alert'>El email ya esta registrado</div>";
                    }else{
                        //encriptar contraseña
                        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
                        //generar token
                        $this->token = md5(uniqid(mt_rand(), true));
                        //guardar datos en la base de datos
                        $sql = "INSERT INTO usuarios (name, lastname, email, password, token) VALUES ('$this->name', '$this->lastname', '$this->email', '$this->password', '$this->token')";
                        $consulta = $this->_db->query($sql);
                        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
                        if ($consulta) {
                            echo "<div class='alert alert-success' role='alert'>Usuario registrado correctamente</div>";
                        }else{
                            echo "<div class='alert alert-danger' role='alert'>Error al registrar usuario</div>";
                        }

                    }
                }
            }
        }
    }*/



    //verificar email no este registrado
    public function verificar_email($email){
        //validar que el email sea correcto
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='alert alert-danger' role='alert'>El email no es valido</div>";
        }else{
            //validar que el email no este registrado
            $sql = "CALL verificar_email('$email')";
            $resultado = $this->_db->query($sql);
            $row = $resultado->fetch_assoc();
            if ($row['email'] == $email) {
                echo "<div class='alert alert-danger' role='alert'>El email ya esta registrado</div>";
            }else{
                echo "<div class='alert alert-success' role='alert'>El email esta disponible</div>";
            }
        }

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


    //verificar token por email
    /*public function verificar_token($token, $email){
        $this->email = $email;
        $this->token = $token;
        $sql = "CALL verificar_token('$this->token', '$this->email')";
        $consulta = $this->_db->query($sql);
        $resultado = mysqli_multi_query($this->_db, $sql);
        $resultado = mysqli_store_result($this->_db);
        $resultado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        if($resultado){
            return true;
        }else{
            return false;
        }
    }*/

    //inicio de sesion
    public function iniciar_sesion($email, $password){
        $this->email = $email;
        $this->password = $password;
        $sql = "CALL iniciar_sesion('$this->email')";
        $consulta = $this->_db->query($sql);
        $resultado = mysqli_multi_query($this->_db, $sql);
        $resultado = mysqli_store_result($this->_db);
        $resultado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        if($resultado){
            foreach ($resultado as $row) {
                $password_bd = $row['password'];
                $id = $row['id'];
                $name = $row['name'];
                $lastname = $row['lastname'];
                $email = $row['email'];
                $token = $row['token'];
            }
            //verificar contraseña
            if (password_verify($this->password, $password_bd)) {
                //iniciar sesion
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['name'] = $name;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['email'] = $email;
                $_SESSION['token'] = $token;
                header('Location: index.php');
            }else{
                echo "<div class='alert alert-danger' role='alert'>Contraseña incorrecta</div>";
            }
        }else{
            echo "<div class='alert alert-danger' role='alert'>El email no esta registrado</div>";
        }
    }


    //consultar token ligado al email 
    public function consultar_token($email){
        $this->email = $email;
        $sql = "CALL consultar_token('$this->email')";
        $consulta = $this->_db->query($sql);
        $resultado = mysqli_multi_query($this->_db, $sql);
        $resultado = mysqli_store_result($this->_db);
        $resultado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        if($resultado){
            foreach ($resultado as $row) {
                $token = $row['token'];
            }
            return $token;
        }else{
            return false;
        }
    }

}

?>