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

		// Mostrar Categorias.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarCategorias($tabla,$item,$valor)
    {
      //var_dump($tabla);
			//exit;
			// Determinar si se quiere un registro o todos.
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt->bindParam(":".$item,$valor, PDO::PARAM_STR);
				$stmt->execute();
	
				return $stmt->fetch(); // Retorna solo una linea.	
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
				$stmt->execute();

				return $stmt->fetchAll(); // Retorna solo una linea.	

			}

			$stmt->close();
			$stmt = null; 

		} // static public function mdlMostrarCategorias($tabla,$item,$valor)


	} // class ModeloCategorias

?>