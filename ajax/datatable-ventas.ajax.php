<?php
	// Para poder extraer los datos de la tabla de "productos" y agregarlos al plugin DataTable.
	// Se agrega porque este archivo no se esta disparando con el "index.php", sino con el archivo "productos.php", se carga mucho después.

	require_once "../controladores/productos.controlador.php";
	require_once "../modelos/productos.modelo.php";

	class TablaProductosVentas
	{
		// Mostrar la tabla de productos.
		public function mostrarTablaProductosVentas()
		{
			// Extraer la información de la tabla.
			$item = null;
			$valor = null;
			$orden = "id";
			$productos = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);

			//var_dump($productos);
			//return;
			//exit;

			 $datosJson = '{
				"data": [';
				for ($i =0;$i<count($productos);$i++)
				{
					// Se obtiene la imagen del producto, se pasa a variable para agregarlo al JSon.
					$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

					// Se utilizara un color para determinar el "Stock" de los productos.
					if ($productos[$i]["stock"] <= 10)
					{
						$stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
					}
					else if ($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <=15)
					{
						$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";
					}
					else // if ($productos[$i][stock] <= 10)
					{
						$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
					}

					

					// $imagen = "<img src='/vistas/img/productos/101/105.png' width='40px'>";
					// Se utilizan estos datos para pasarlos con Ajax a las funciones de JavaScript para obtener la información del "Producto" 
					// se agrega btnEditarProducto" = Boton para editar 
					// idProducto='".$productos[$i]["id"]."' para editar el producto.
					// data-toggle='modal' = Para desplegar una ventanta Modal.
					// data-target='#modalEditarProducto' = Pantalla para editar los productos 
					// btnEliminarProducto= Boton para eliminar producto
					// idProducto='".$productos[$i]["id"]."' = Para obtener el código del producto
					// imagen='".$productos[$i]["imagen"]."' = Para obtener la ruta de la imagen.


					// se extrae los datos utilizados para el boton de "Editar" y "Borrar"
					// "recuperarBoton" para agregarlo o quitarlo cuando se esta agregando un producto.
					$botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id"]."'>Agregar </button></div>";

					$datosJson  .= '[
							"'.($i+1).'",
							"'.$imagen.'",
							"'.$productos[$i]["codigo"].'",
							"'.$productos[$i]["descripcion"].'",
							"'.$stock.'",
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
	$activarProductosVentas = new TablaProductosVentas();
	$activarProductosVentas->mostrarTablaProductosVentas();


?>