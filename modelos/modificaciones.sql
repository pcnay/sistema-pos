USE pos;

CREATE TABLE t_Categoria
(
  id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(80) NOT NULL,
  fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

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
