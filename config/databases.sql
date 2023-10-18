CREATE DATABASE crud_sample;
USE crud_sample;
CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    ci_ruc VARCHAR(20) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL
);

CREATE TABLE clientes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    ci_ruc VARCHAR(20) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    email VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


INSERT INTO `usuarios` (`id`, `nombre`, `ci_ruc`, `direccion`, `telefono`, `email`)
 VALUES (NULL, 'jordy quilachamin', '1725867905', 'San isidro del inca', '0984581915', 'quilajordy@gmail.com');


DELIMITER //

CREATE PROCEDURE CrearClienteDesdeUsuario(IN usuario_id INT)
BEGIN
    DECLARE usuario_nombre VARCHAR(255);
    DECLARE usuario_ci_ruc VARCHAR(20);
    
    SELECT nombre, ci_ruc INTO usuario_nombre, usuario_ci_ruc FROM usuarios WHERE id = usuario_id;
    INSERT INTO clientes (nombre, ci_ruc) VALUES (usuario_nombre, usuario_ci_ruc);
END//

DELIMITER ;
