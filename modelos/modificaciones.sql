/*
-- Ejecutarlo desde una terminal de Mysql 
-- Se debe accesar al directorio donde se encuentra el "script.sql" y ejecutar el comenado "mysql" desde una terminal
-- $ mysql -u nom-usr -p NombreBaseDatos < script.sql
-- Otra Forma :
--    mysql -u usuario -p NombreBaseDatos
--    source script.sql ó \. script.sql
*/

USE pos;
/* SET time_zone = 'America/Tijuana';	*/
	

	
	/* Para agregar una columna a la tabla t_Clientes . */
	ALTER TABLE t_Clientes ADD ultima_compra DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
	


/*
	Para resetar el ID de categorias se inicie desde 1
	ALTER TABLE t_Categorias AUTO_INCREMENT = 1;

*/

/*
CREATE TABLE t_Ventas
(
  id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  codigo INTEGER UNSIGNED NOT NULL,
	id_cliente INTEGER UNSIGNED NOT NULL,
	id_vendedor INTEGER UNSIGNED NOT NULL,  
  productos TEXT,
  impuesto decimal(10,2) DEFAULT NULL,
	neto decimal(10,2) DEFAULT NULL,
	total decimal(10,2) DEFAULT NULL,
  metodo_pago varchar(80),
  fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY(id_cliente) REFERENCES t_Clientes(id)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_vendedor) REFERENCES t_Usuario(id)
	ON DELETE RESTRICT ON UPDATE CASCADE

);


/*

CREATE TABLE t_Clientes
(
  id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,  
  nombre VARCHAR(100) NULL,
	documento INTEGER UNSIGNED NULL,
	email VARCHAR(100) NULL,
	telefono VARCHAR(80) NULL,
	direccion VARCHAR(100) NULL,
	fecha_nacimiento DATE NULL,
	compras INTEGER UNSIGNED NULL,
	ultima_compra DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP  
);

CREATE TABLE t_Productos
(
  id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  id_categoria INTEGER UNSIGNED NOT NULL,
  codigo VARCHAR(45) NOT NULL,
  descripcion VARCHAR(80) NOT NULL,
  imagen VARCHAR(100) NULL,
  stock INTEGER UNSIGNED NOT NULL DEFAULT 1,
  precio_compra decimal(10,2) DEFAULT NULL,
	precio_venta decimal(10,2) DEFAULT NULL,
  ventas varchar(45) DEFAULT NULL,  
  fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY(id_categoria) REFERENCES t_Categoria(id)
	ON DELETE RESTRICT ON UPDATE CASCADE
);

*/


/*
CREATE TABLE t_Categoria
(
  id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(80) NOT NULL,
  fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);
*/
/*
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
*/

 
/*
INSERT INTO t_Usuario (id,nombre,usuario,clave,perfil,vendedor,foto,estado,ultimo_login,fecha) VALUES
  (1,'Usuario Administrador','admin','123','Administrador','','',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
*/

/*
INSERT INTO t_Usuario (id,nombre,usuario,clave,perfil,vendedor,foto,estado,ultimo_login,fecha) VALUES
  (0,'Usuario Prueba','usuariox','123','Usuario Varios','','',0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
*/

/*
ALTER TABLE t_Usuario
  MODIFY clave VARCHAR(80) NOT NULL
*/
