USE pos;
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
	ON DELETE RESTRICT ON UPDATE CASCADE
);



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
