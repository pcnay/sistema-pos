DROP DATABASE IF EXISTS pos;

CREATE DATABASE IF NOT EXISTS pos;
USE pos;

/* Solo se ejecuta la primera vez.*/
CREATE USER 'ventas-pos'@'localhost' IDENTIFIED BY 'pcnay2003';
GRANT ALL on pos.* to 'ventas-pos'  IDENTIFIED BY 'pcnay2003';

/* 
Mostrar todos los usuarios 
  select user from mysql.user;
Para borrar un usuario:
	drop user ventas-pos;
	drop user ‘ventas-pos’@’localhost’;
	flush privileges;

*/

/* Tabla de Datos */
/* Se ocupa los 9 espacios, no se desperdicia espacio.*/
  /* CHAR(X) = cuando se define de algun tamaño pero no se utiliza, se despedicia espacio, por ejemplo
  CHAR(30), pero el valor de "title" es de 20, se desperdicio 60 espacios.
  VARCHAR(80) se adapta al tamaño del titulo.
  En la base de datos se puede guardar, videos, documentos en formato binario, pero creceria mucho.
  Se sube el video, documento, solo se graba la URL en el campo de la base de datos.
  */

/* Es una tabla catalogo */ 

CREATE TABLE t_Usuario
(
  id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(45) NOT NULL,
  usuario VARCHAR(45) NOT NULL,
  clave VARCHAR(80) NOT NULL,
  perfil VARCHAR(45) NOT NULL,
  vendedor VARCHAR(45) NULL,
  foto VARCHAR(45) NULL,
  estado INTEGER UNSIGNED DEFAULT 0,
  ultimo_login DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE t_Categoria
(
  id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(80) NOT NULL,
  fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE t_Productos
(
  id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  id_categoria INTEGER UNSIGNED NOT NULL,
  codigo VARCHAR(45) NOT NULL,
  descripcion VARCHAR(80) NOT NULL,
  imagen VARCHAR(100) NOT NULL,
  stock INTEGER UNSIGNED NOT NULL DEFAULT 1,
  precio_compra decimal(10,2) DEFAULT NULL,
	precio_venta decimal(10,2) DEFAULT NULL,
  ventas varchar(45) DEFAULT NULL,  
  fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY(id_categoria) REFERENCES t_Categoria(id)
	ON DELETE RESTRICT ON UPDATE CASCADE,

);


INSERT INTO t_Usuario (id,nombre,usuario,clave,perfil,vendedor,foto,estado,ultimo_login,fecha) VALUES
  (1,'Usuario Administrador','admin','123','Administrador','','',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
