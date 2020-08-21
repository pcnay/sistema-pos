<?php
	require_once "conexion.php";
	class ModeloVentas
	{
		// Mostrar ventas
		static public function mdlMostrarVentas($tabla, $item, $valor)
		{
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");
				$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();				
			}
			else
			{
				// Para que tome el último número de factura de la tabla.
				$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla ORDER BY id ASC");
				$stmt->execute();
				return $stmt->fetchAll();
			}

		} // static public function mdlMostrarVentas($tabla, $item, $valor)

		// Guardar la venta en la tabla "t_Ventas".
		static public function mdlIngresarVenta($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,id_cliente,id_vendedor,productos, impuesto,neto,total,metodo_pago) VALUES(:codigo, :id_cliente, :id_vendedor, :productos, :impuesto, :neto, :total, :metodo_pago)");

			$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_INT);
			$stmt->bindParam(":id_cliente",$datos["id_cliente"],PDO::PARAM_INT);
			$stmt->bindParam(":id_vendedor",$datos["id_vendedor"],PDO::PARAM_INT);
			$stmt->bindParam(":productos",$datos["productos"],PDO::PARAM_STR);
			$stmt->bindParam(":impuesto",$datos["impuesto"],PDO::PARAM_STR);
			$stmt->bindParam(":neto",$datos["neto"],PDO::PARAM_STR);
			$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
			$stmt->bindParam(":metodo_pago",$datos["metodo_pago"],PDO::PARAM_STR);

				if($stmt->execute())
				{
					return "ok";
				}
				else
				{
					return "error";
				}

				$stmt->close();
				$stmt = null;

		} // 	static public function mdlIngresarVenta($tabla,$datos)

		// Actualizar la venta en la tabla "t_Ventas".
		static public function mdlEditarVenta($tabla,$datos)
		{
			//var_dump($datos);
			//var_dump($datos["productos"]);
			//var_dump($datos["codigo"]);
			
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos, impuesto = :impuesto, neto = :neto, total = :total, metodo_pago = :metodo_pago WHERE codigo = :codigo");

			$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_INT);
			$stmt->bindParam(":id_cliente",$datos["id_cliente"],PDO::PARAM_INT);
			$stmt->bindParam(":id_vendedor",$datos["id_vendedor"],PDO::PARAM_INT);
			$stmt->bindParam(":productos",$datos["productos"],PDO::PARAM_STR);
			$stmt->bindParam(":impuesto",$datos["impuesto"],PDO::PARAM_STR);
			$stmt->bindParam(":neto",$datos["neto"],PDO::PARAM_STR);
			$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
			$stmt->bindParam(":metodo_pago",$datos["metodo_pago"],PDO::PARAM_STR);


				if($stmt->execute())
				{
					return "ok";
				}
				else
				{
					return "error";
				}

				$stmt->close();
				$stmt = null;

		} // 	static public function mdlEditarVenta($tabla,$datos)
		
	} // class ModeloVentas 
	
?>