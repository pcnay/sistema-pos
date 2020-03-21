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

			//var_dump($productos);
			//return;
			//exit;

			 $datosJson = '{
				"data": [';
				for ($i =0;$i<count($productos);$i++)
				{
					// Se obtiene la imagen del producto, se pasa a variable para agregarlo al JSon.
					$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";
					// se extrae la categoria
					$item = "id";
					$valor = $productos[$i]["id_categoria"];
					$categoria = ControladorCategorias::ctrMostrarCategorias($item,$valor);

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
					$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo ='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."' ><i class='fa fa-times'></i></button></div>";

					$datosJson  .= '[
							"'.($i+1).'",
							"'.$imagen.'",
							"'.$productos[$i]["codigo"].'",
							"'.$productos[$i]["descripcion"].'",
							"'.$categoria["nombre"].'", 
							"'.$stock.'",
							"'.$productos[$i]["precio_compra"].'",
							"'.$productos[$i]["precio_venta"].'",
							"'.$productos[$i]["fecha"].'",							
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