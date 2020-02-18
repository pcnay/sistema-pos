<?php
	require_once "conexion.php";
	class ModeloCategorias
	{
		// Crear Categoria.
		static public function mdlIngresarCategoria($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre) VALUES (:nombre)");
			$stmt->bindParam(":nombre",$datos,PDO::PARAM_STR); 
			if ($stmt->execute())
			{
				return "ok";				
			}
			else
			{
				return "error";
			}
			$stmt->close();
			$stmt = null;

		} // static public function mdlIngresarCategoria($tabla,$datos)

	} // class ModeloCategorias

?>