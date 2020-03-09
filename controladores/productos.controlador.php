<?php
	class ControladorProductos
	{
		// Mostrar productos
		static public function ctrMostrarProductos($item, $valor)
		{
			$tabla = "t_Productos";
			$respuesta = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor);
			return $respuesta;
			
		}
	}
?>
