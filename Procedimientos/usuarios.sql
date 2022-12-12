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


-- actualizar solo el campo lastname de la tabla usuarios--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_lastname`(IN `lastname` VARCHAR(30), IN `email` VARCHAR(50))
BEGIN
    UPDATE usuarios SET lastname = lastname WHERE email = email;
END

-- crear tabla usuarios con los campos name, lastname, email, password, confirm_password, y token que sea opcional--
CREATE TABLE usuarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    password VARCHAR(50),
    confirm_password VARCHAR(50),
    token VARCHAR(50) NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- procedimiento almacenado para insertar un usuario--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_usuario`(IN `name` VARCHAR(30), IN `lastname` VARCHAR(30), IN `email` VARCHAR(50), IN `password` VARCHAR(50), IN `confirm_password` VARCHAR(50), IN `token` VARCHAR(50))
BEGIN
    INSERT INTO usuarios (name, lastname, email, password, confirm_password, token) VALUES (name, lastname, email, password, confirm_password, token);
END

-- actualizar solo el campo token de la tabla usuarios--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_token`(IN `token2` VARCHAR(50), IN `email2` VARCHAR(50))
BEGIN
    UPDATE usuarios SET token = token2 WHERE email = email2;
END

--Validar que el token pertenezca al correo que se envio--
CREATE DEFINER=`root`@`localhost` PROCEDURE `verificar_token`(IN `token3` VARCHAR(50), IN `email3` VARCHAR(50))
BEGIN
    SELECT * FROM usuarios WHERE token = token3 AND email = email3;
END

-- iniciar sesion--
CREATE DEFINER=`root`@`localhost` PROCEDURE `iniciar_sesion`(IN `email4` VARCHAR(50), IN `password4` VARCHAR(50))
BEGIN
    SELECT * FROM usuarios WHERE email = email4 AND password = password4;
END

--mostrar token ligado a un correo--
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrar_token`(IN `email5` VARCHAR(50))
BEGIN
    SELECT token FROM usuarios WHERE email = email5;
END

--crear procedimiento almacenado para subir archivos longblob--
CREATE PROCEDURE `subir_archivo`(IN `archivo` LONGBLOB)
BEGIN
    INSERT INTO img (archivo) VALUES (archivo);
END

--crear procedimiento almacenado insertar datos a la tabla productos--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_producto`(IN `nombre` VARCHAR(50), IN `descripcion` VARCHAR(50), IN `precio` INT(11), IN `id_categoria` VARCHAR(50),IN `activo` INT(11))
BEGIN
    INSERT INTO productos (nombre, descripcion, precio, id_categoria, activo) VALUES (nombre, descripcion, precio, id_categoria, activo);
END

--crear procedimiento almacenado para mostrar los productos mientras activo sea igual a 1--
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrar_productos`(IN `activo2` INT(11))
BEGIN
    SELECT * FROM productos WHERE activo = activo2;
END

--crear tabla productos con los campos id, nombre, descripcion, precio, id_categoria, activo y que id sea autoincrementable, id_categoria sea foranea de la tabla categorias--
CREATE TABLE productos (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion VARCHAR(50) NOT NULL,
    precio INT(11) NOT NULL,
    id_categoria VARCHAR(50) NOT NULL,
    activo INT(11) NOT NULL,
    CONSTRAINT fk_id_categoria FOREIGN KEY (id_categoria) REFERENCES categorias (id)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- alterar tabla productos precio que sea decimal--
ALTER TABLE productos MODIFY precio DECIMAL(10,2);

--alterar tabla productos y agregar campo stock--
ALTER TABLE productos ADD stock INT(11) NOT NULL AFTER precio;


--crear procedimiento almacenado para mostrar los productos mientras id sea igual a id2 y activo sea igual a 1--
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrar_productos_id`(IN `activo3` INT(11))
BEGIN
    SELECT conut(id) FROM productos WHERE id = ? AND activo = activo3;
END

--crear procedimiento almacenado para mostrar los productos mientras id sea igual a id2 y activo sea igual a 1--
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrar_detalles`(IN `id2` INT(11), IN `activo3` INT(11))
BEGIN
    SELECT nombre, descripcion, precio FROM productos WHERE id = ? and activo = 1;
END

--modificar campo descripcion de la tabla productos para que admita html y mas caracteres--
ALTER TABLE productos MODIFY descripcion TEXT;


-- procedimiento almacenado para actulizar stock mediante id--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_stock`(IN `id3` INT(11), IN `stock2` INT(11))
BEGIN
    UPDATE productos SET stock = stock - stock2 WHERE id = id3;
END