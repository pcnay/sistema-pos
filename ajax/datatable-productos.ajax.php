<?php
	// Para poder extraer los datos de la tabla de "productos" y agregarlos al plugin DataTable.
	// Se agrega porque este archivo no se esta disparando con el "index.php", sino con el archivo "productos.php", se carga mucho después.

	require_once "../controladores/productos.controlador.php";
	require_once "../modelos/productos.modelo.php";

	require_once "../controladores/categorias.controlador.php";
	require_once "../modelos/categorias.modelo.php";

	class TablaProductos
	{
		// Mostrar la tabla de productos.
		public function mostrarTablaProductos()
		{
			// Extraer la información de la tabla.
			$item = null;
			$valor = null;
			$productos = ControladorProductos::ctrMostrarProductos($item,$valor);

			
			// $imagen = "<img src='/vistas/img/productos/101/105.png' width='40px'>";
			$botones = "<div class='btn-group'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button><button class='btn btn-danger'><i class='fa fa-times'></i></button></div>";

			//var_dump($productos);

			 $datosJson = '{
				"data": [';
				for ($i =0;$i<count($productos);$i++)
				{
					$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";
					$datosJson  .= '[
							"'.($i+1).'",
							"'.$imagen.'",
							"'.$productos[$i][codigo].'",
							"'.$productos[$i][descripcion].'",
							"Taladros", 
							"'.$productos[$i][stock].'",
							"'.$productos[$i][precio_compra].'",
							"'.$productos[$i][precio_venta].'",
							"'.$productos[$i][fecha].'",							
							"'.$botones.'"
						],';
				}
				// Una vez que se termina el ciclo, al final de la cadena "$datosJson" se le elimina ","
				$datosJson = substr($datosJson,0,-1);
				$datosJson .=	']}';

			echo  $datosJson;

			//return; // para que no continue la ejecución.


			// Se utilizan las variables de PHP para no romper la cadena en el JSON.
		 
		} // public function mostrarTablaProductos()

	} // class TablaProductos

	// Activar la tabla de productos.
	$activarProductos = new TablaProductos();
	$activarProductos->mostrarTablaProductos();


?>