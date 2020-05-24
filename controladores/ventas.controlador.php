<?php
	class ControladorVentas
	{
		static public function ctrMostrarVentas($item, $valor)
		{
			$tabla = "t_Ventas";
			$respuesta = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);
			return $respuesta;
		}
	}

?>
