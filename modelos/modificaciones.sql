/*
CREATE TABLE t_Usuario
(
  id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(45) NOT NULL,
  usuario VARCHAR(45) NOT NULL,
  clave VARCHAR(45) NOT NULL,
  perfil VARCHAR(45) NOT NULL,
  vendedor VARCHAR(45) NULL,
  foto VARCHAR(45) NULL,
  estado INTEGER UNSIGNED,
  ultimo_login DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);
*/ 
INSERT INTO t_Usuario (id,nombre,usuario,clave,perfil,vendedor,foto,estado,ultimo_login,fecha) VALUES
  (1,'Usuario Administrador','admin','123','Administrador','','',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

/*
ALTER TABLE `t_Equipo`
	MODIFY num_serie VARCHAR(45) UNIQUE NOT NULL; /* Evalua que sea único en esta tabla. */

/*
ALTER TABLE t_Usuario
  MODIFY clave VARCHAR(80) NOT NULL
*/
