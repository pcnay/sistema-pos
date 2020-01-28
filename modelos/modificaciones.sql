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
<<<<<<< HEAD
*/ 
INSERT INTO t_Usuario (id,nombre,usuario,clave,perfil,vendedor,foto,estado,ultimo_login,fecha) VALUES
  (1,'Usuario Administrador','admin','123','Administrador','','',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

=======

INSERT INTO t_Usuario (id,nombre,usuario,clave,perfil,vendedor,foto,estado,ultimo_login,fecha) VALUES
  (1,'Usuario Administrador','admin','123','Administrador','','',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
*/
>>>>>>> 39ad9c9d6b3063776edd24354f00bfac7e26cd13
/*
ALTER TABLE `t_Equipo`
	MODIFY num_serie VARCHAR(45) UNIQUE NOT NULL; /* Evalua que sea único en esta tabla. */

<<<<<<< HEAD
/*
ALTER TABLE t_Usuario
  MODIFY clave VARCHAR(80) NOT NULL
*/
=======

ALTER TABLE t_Usuario
  MODIFY clave VARCHAR(80) NOT NULL
>>>>>>> 39ad9c9d6b3063776edd24354f00bfac7e26cd13
