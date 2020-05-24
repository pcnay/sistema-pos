<?php
	require_once "conexion.php";
	class ModeloVentas
	{
		// Mostrar ventas
		static public function mdlMostrarVentas($tabla, $item, $valor)
		{
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha DESC");
				$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetcha();				
			}
			else
			{
				$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla ORDER BY fecha DESC");
				$stmt->execute();
				return $stmt->fetchAll();
			}
		}
	}
?>