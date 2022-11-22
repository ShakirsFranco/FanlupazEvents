-- crear tabla usuarios con los campos name, lastname, email, password, confirm_password--
CREATE TABLE usuarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    password VARCHAR(50),
    confirm_password VARCHAR(50)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- procedimiento almacenado para insertar un usuario--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_usuario`(IN `name` VARCHAR(30), IN `lastname` VARCHAR(30), IN `email` VARCHAR(50), IN `password` VARCHAR(50), IN `confirm_password` VARCHAR(50))
BEGIN
    INSERT INTO usuarios (name, lastname, email, password, confirm_password) VALUES (name, lastname, email, password, confirm_password);
END


-- procedimiento almacenado para verficar email es unico--
CREATE DEFINER=`root`@`localhost` PROCEDURE `verificar_email`(IN `email` VARCHAR(50))
BEGIN
    SELECT * FROM usuarios WHERE email = email;
END

-- procedimiento almacenado para verficar que el email y sea diferente a alguno de la base de datos--
CREATE DEFINER=`root`@`localhost` PROCEDURE `verificar_email_unico`(IN `email` VARCHAR(50))
BEGIN
    SELECT * FROM usuarios WHERE email <> email;
END

-- procedimiento almacenado email sea igual a alguno de la base de datos--
CREATE DEFINER=`root`@`localhost` PROCEDURE `verificar_email_igual`(IN `email2` VARCHAR(50))
BEGIN
    SELECT * FROM usuarios WHERE email = email2;
END

-- crear tabla token con los campos id, token, email--
CREATE TABLE token (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    token VARCHAR(50),
    email VARCHAR(50)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- procedimiento almacenado para insertar un token--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_token`(IN `token` VARCHAR(50), IN `email` VARCHAR(50))
BEGIN
    INSERT INTO token (token, email) VALUES (token, email);
END
