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

		//==========================================================
		// Borrar la Venta
		// =========================================================
		static public function mdlEliminarVenta ($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
			$stmt->bindParam(":id", $datos, PDO::PARAM_INT);
			if ($stmt->execute())
			{
				return "ok";
			}
			else
			{
				return "error";
			}
			$stmt->close();
			$stmt=null;
		}	

		// ============================================================
		// Rangos de Fecha 
		// ============================================================

		static public function mdlRangoFechasVentas($tabla,$fechaInicial,$fechaFinal)
		{
			if ($fechaInicial == null)
			{
				$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla ORDER BY id ASC");
				$stmt->execute();
				return $stmt->fetchAll();
			} 
			else if($fechaInicial == $fechaFinal)
			{
				$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");
				$stmt->bindParam(":fecha",$fechaFinal,PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetchAll();

			} // if ($fehaInicial == null)
			else
			{
				$fechaActual = new DateTime();
				
				// Para agregar un dia, a la fecha actual
				$fechaActual->add(new DateInterval("P1D")); 
				$fechaActualMasUno = $fechaActual->format("Y-m-d");

				// $fechaFinal ; viene desde el parámetro de la función.
				$fechaFinal2 = new DateTime($fechaFinal);
				$fechaFinal2->add(new DateInterval("P1D")); 
				$fechaFinal2MasUno = $fechaFinal2->format("Y-m-d");

				if ($fechaFinal2MasUno == $fechaActualMasUno)
				{
					$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
				}
				else
				{
					$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");
				}

				$stmt->execute();
				return $stmt->fetchAll(); 
			}

		} //  static public function mdlRangoFechasVentas($tabla,$fechaInicial,$fechaFinal)

		// ===================================================
		// Suma Total De Ventas
		// ==================================================
		static public function mdlSumaTotalVentas($tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) AS total FROM $tabla");
			
			$stmt->execute();
			
			return $stmt->fetch();
			$stmt->close();
			$stmt=null;		
		}

	} // class ModeloVentas 
	
?>