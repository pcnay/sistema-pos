<?php
	class ControladorVentas
	{
		static public function ctrMostrarVentas($item, $valor)
		{
			$tabla = "t_Ventas";
			$respuesta = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);
			return $respuesta;
		}

		// Para guardar la venta  en la tabla de "t_Ventas"
		static public function ctrCrearVenta()
		{
			// Si existe la variable "nuevaVenta"
			if(isset($_POST["nuevaVenta"]))
			{
				// Actualizar las compras del cliente.
				// Reducir el stock 
				// Aumentar las ventas de los clientes.

				// Obteniedo los productos que se vendieron
				$listaProductos = json_decode($_POST["listaProductos"],true);

				$totalProductosComprados = array();


				// revisando el contenido del arreglo $listaProductos.
				// var_dump($listaProductos);
				foreach ($listaProductos as $key => $value)
				{
					array_push($totalProductosComprados,$value["cantidad"]);
					
					$tablaProductos = "t_Productos";
					$item = "id";
					$valor = $value["id"];
	
					// Obtiene el Producto de la tabla de : "t_Productos"
					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos,$item,$valor);

					//var_dump($traerProducto);
					// $traerProducto["ventas"], se refiere a la cantidad de veces que se ha vendido el producto.
					//var_dump($traerProducto["ventas"]);
					$item1a = "ventas";

					// Actualiza el valor de las veces que se ha vendido el producto
					$valor1a = $value["cantidad"] + $traerProducto["ventas"];

					// Actualizar en la tabla de "t_Productos"
					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a,$valor);

					// Ahora actualizando el Stock en la tabla de "t_Productos"
					$item1b = "stock";
					$valor1b = $value["stock"];
					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b,$valor);
					

				} // foreach ($listaProductos as $key => $value)

				// Actualizando en la tabla de clientes, el monto de las compras realizadas.				
				$tablaClientes = "t_Clientes";				
				$item = "id";
				// Este valor viene desde el Select donde se selecciona el cliente, es valor de identificador del cliente.
				$valor = $_POST["seleccionarCliente"];
				
				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes,$item,$valor);
				// var_dump ($traerCliente);

				// Ahora solo mostrar el campo de "compras"
				//var_dump ($traerCliente["compras"]);
				$item1 = "compras";
				// Suma todas las cantidades de los productos comprados.
				$valor1 = array_sum($totalProductosComprados) + $traerCliente["compras"];
				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes,$item1,$valor1,$valor);

				$item1b = "ultima_compra";

				date_default_timezone_set('America/Tijuana');				
				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$fechaActual = $fecha.' '.$hora;

				$valor1b = $fechaActual; 
				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes,$item1b,$valor1b,$valor);

				// Ahora se guardara la Compra en la tabla de "t_Ventas"
				$tabla = "t_Ventas";
				$datos = array("id_vendedor"=>$_POST["idVendedor"],
											"id_cliente"=>$_POST["seleccionarCliente"],
											"codigo"=>$_POST["nuevaVenta"],
											"productos"=>$_POST["listaProductos"],
											"impuesto"=>$_POST["nuevoPrecioImpuesto"],
											"neto"=>$_POST["nuevoPrecioNeto"],
											"total"=>$_POST["totalVenta"],
											"metodo_pago"=>$_POST["listaMetodoPago"]);

				$respuesta = ModeloVentas::mdlIngresarVenta($tabla,$datos);

				if ($respuesta == "ok")
				{
					echo '<script>  
						localStorage.removeItem("rango");
						         
						Swal.fire ({
							type: "success",
							title: "La venta ha sido guardado correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="crear-venta";
								}
	
								});
		
						</script>';          

				} // if ($respuesta == "ok")

			} // if(isset($_POST["nuevaVenta"]))

		} // static public function ctrCrearVenta()


		// Para Editar la venta  en la tabla de "t_Ventas"
		static public function ctrEditarVenta()
		{
			// Si existe la variable "nuevaVenta"
			if(isset($_POST["editarVenta"]))
			{
				 
				// Se va formatear los datos, ya que si se elimina una venta, se tiene que actualizar la tabla "t_Productos" y cliente "t_Clientes" para dejarlo con los valores reales.
				// Se utiliza el campo "producto" que tiene el JSon.
				// El stock se actualizara en base a la "Cantidad" 
				// De igual manera se va a actualizar las compras que realizo el cliente, es decir se le restaran.

				// Se obtendran la venta con el "ID" actual
					$tabla = "t_Ventas";
					$item = "codigo";
					$valor = $_POST["editarVenta"];
	
					// Obtener las venta que realizo el cliente, es el campo JSon, que se utilizara para poder editar la compra.
					$traerVenta = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);

					// ===========================================================
					// Revisar si viene productos editados 
					// ===========================================================
					
					if ($_POST["listaProductos"] == "")
					{
						// El arreglo "$listaProductos" es donde se vaciara la venta que se encuentra en la base de datos, ya que no se modifico el detalle de la venta.
						$listaProductos = $traerVenta["productos"];
						// Esta variable se utiliza para determinar cuando no se actualiza la venta, en los renglones, ya que cuando se graba la actualizacion, toma el valor que se grabo en la tabla en la existencia cuando se grabo la venta, por lo que la existencia esta equivocado.
						$cambioProducto = 0;
					}
					else
					{
						$listaProductos = $_POST["listaProductos"];						
						$cambioProducto = 1;
					}
					
			

					if ($cambioProducto == 1)
					{
						$productos = json_decode($traerVenta["productos"],true);
						//var_dump($productos);
						//exit;
						
						$totalProductosComprados = array();

						foreach ($productos as $key => $value)
						{
							// Agregandolo al arreglo.
							array_push($totalProductosComprados,$value["cantidad"]);
							$tablaProductos = "t_Productos";
							$item = "id";
							$valor = $value["id"];
			
							// Obtiene el Producto de la tabla de : "t_Productos", el "Id" viene desde el JSon (Arreglo)
							$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos,$item,$valor);

							// Ahora se restara la venta.
							// Actualiza el valor de las veces que se ha vendido el producto
							$item1a = "t_Ventas";
							$valor1a = $traerProducto["ventas"] - $value["cantidad"];
							
							// Actualizar en la tabla de "t_Productos"
							$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a,$valor);


							// Ahora actualizando el Stock en la tabla de "t_Productos"
							$item1b = "stock";
							// Cantidad = JSon es el que esta guardado.
							// $traerProducto["stock"]; = Es la existencia que esta registrado en la tabla de "t_Productos"
							$valor1b = $value["cantidad"]+$traerProducto["stock"];
							$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b,$valor);

						} // for ($productos as $key => $value)

						// Actualizando en la tabla de clientes, el monto de las compras realizadas.				
						$tablaClientes = "t_Clientes";				
						$itemCliente = "id";
						// Este valor viene desde el Select donde se selecciona el cliente, es valor de identificador del cliente.
						$valorCliente = $_POST["seleccionarCliente"];
						
						$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes,$itemCliente,$valorCliente);
						// var_dump ($traerCliente);
						// Ahora solo mostrar el campo de "compras"
						//var_dump ($traerCliente["compras"]);

						$item1 = "compras";
						// Suma todas las cantidades de los productos comprados.
						$valor1 = $traerCliente["compras"] - array_sum($totalProductosComprados);
						$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes,$item1,$valor1,$valor);
						

						//==================================================================================
						// Actualizar las compras del cliente y reducir el Stock y aumentar las ventas de los productos.
						// ==================================================================================

						$listaProductos2 = json_decode($listaProductos,true);
						$totalProductosComprados = array();
						foreach ($listaProductos2 as $key =>$value)
						{
							// Agregandolo al arreglo.
							array_push($totalProductosComprados,$value["cantidad"]);
							$tablaProductos2 = "t_Productos";
							$item2 = "id";
							$valor2 = $value["id"];
			
							// Obtiene el Producto de la tabla de : "t_Productos", el "Id" viene desde el JSon (Arreglo)
							$traerProducto2 = ModeloProductos::mdlMostrarProductos($tablaProductos2,$item2,$valor2);
							// Ahora se restara la venta.
							// Actualiza el valor de las veces que se ha vendido el producto
							$item1a2 = "t_Ventas";
							$valor1a2 = $value["cantidad"] + $traerProducto2["ventas"];

							// Actualizar en la tabla de "t_Productos"
							$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a,$valor);

							// Ahora actualizando el Stock en la tabla de "t_Productos"
							$item1b2 = "stock";
							// Cantidad = JSon es el que esta guardado.
							// $traerProducto["stock"]; = Es la existencia que esta registrado en la tabla de "t_Productos"
							$valor1b2 = $value["stock"];
							$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos2, $item1b2, $valor1b2,$valor2);

						} // foreach ($listaProductos2 as $key =>$value)

							// Actualizando en la tabla de clientes, el monto de las compras realizadas.				
							$tablaClientes2 = "t_Clientes";				
							$itemCliente2 = "id";
							// Este valor viene desde el Select donde se selecciona el cliente, es valor de identificador del cliente.
							$valorCliente2 = $_POST["seleccionarCliente"];
							
							$traerCliente2 = ModeloClientes::mdlMostrarClientes($tablaClientes2,$itemCliente2,$valorCliente2);
							// var_dump ($traerCliente);
							// Ahora solo mostrar el campo de "compras"
							//var_dump ($traerCliente["compras"]);

							$item12 = "compras";
							// Suma todas las cantidades de los productos comprados.
							$valor12 = array_sum($totalProductosComprados)+$traerCliente2["compras"];
							$comprasCliente2 = ModeloClientes::mdlActualizarCliente($tablaClientes2,$item12,$valor12,$valorCliente2);

							$item1b2 = "ultima_compra";
					
							date_default_timezone_set('America/Tijuana');
							$fecha_2 = date('Y-m-d');
							$hora_2 = date('H:i:s');
							$fechaActual = $fecha_2.' '.$hora_2;
			
							$valor1b2 = $fechaActual; 
							$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes2,$item1b2,$valor1b2,$valorCliente2);

					} // if ($cambioProducto)

						// Ahora se editara la Venta "t_Ventas"
						$tabla = "t_Ventas";

						$datos = array("id_vendedor"=>$_POST["idVendedor"],
													"id_cliente"=>$_POST["seleccionarCliente"],
													"codigo"=>$_POST["editarVenta"],
													"productos"=>$listaProductos,
													"impuesto"=>$_POST["nuevoPrecioImpuesto"],
													"neto"=>$_POST["nuevoPrecioNeto"],
													"total"=>$_POST["totalVenta"],
													"metodo_pago"=>$_POST["listaMetodoPago"]);

						$respuesta = ModeloVentas::mdlEditarVenta($tabla,$datos);
						
						if ($respuesta == "ok")
						{
							echo '<script>  
								localStorage.removeItem("rango");
												
								Swal.fire ({
									type: "success",
									title: "La venta ha sido editada correctamente ",
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
									}).then(function(result){
										if (result.value)
										{
											window.location="crear-venta";
										}
			
										});
				
								</script>';          

						} // if ($respuesta == "ok")

			} // if(isset($_POST["editarVenta"]))

		} // static public function ctrEditarVenta()

		// =================================================
		// ELIMINAR VENTA 
		//==================================================

		static public function ctrEliminarVenta()
		{
			if (isset($_GET["idVenta"]))
			{
				$tabla = "t_Ventas";
				$item = "id";
				$valor = $_GET["idVenta"];
				$traerVenta = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);

				//================================================
				// Actualizar Fecha Ultima Compra
				//================================================

				// Traer todas las ventas de la tabla.
				$itemVentas = null;
				$valorVentas = null;
				$traerVentas = ModeloVentas::mdlMostrarVentas($tabla,$itemVentas,$valorVentas);
				
				$guardarFechas = array();

				foreach ($traerVentas as $key => $value)
				{
					// Obteniendo todas la ventas del cliente de la tabla de "t_Ventas"
					if ($value["id_cliente"] == $traerVenta["id_cliente"])
					{
						//var_dump($value["fecha"]);
						array_push($guardarFechas,$value["fecha"]);						

					}	// if ($value["id_cliente"]== $traerVenta["id_cliente"])

				} // foreach ($traerVentas as $key => $value)

				// var_dump($guardarFechas);
				$tablaClientes = "t_Clientes";

				if (count($guardarFechas) > 1)
				{
					// Para el caso de que se borre la penultima venta.
					if ($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2])
					{
						$item = "ultima_compra";
						$valor = $guardarFechas[count($guardarFechas)-2];
						$valorIdCliente = $traerVenta["id_cliente"];
						$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes,$item,$valor,$valorIdCliente);
					} // if ($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]))
					else
					{
						$item = "ultima_compra";
						$valor = $guardarFechas[count($guardarFechas)-1];
						$valorIdCliente = $traerVenta["id_cliente"];
						$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes,$item,$valor,$valorIdCliente);

					}

				}
				else
				{
					$item = "ultima_compra";
					$valor = "0000-00-00 00:00:00";					
					$valorIdCliente = $traerVenta["id_cliente"];
					
					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes,$item,$valor,$valorIdCliente);

				} // if (count($guardarFechas) > 1)

				// ===============================================
				// Formatear la tabla de productos y la de clientes
				// Son los ajustes que se realizan para cuando se borra una venta, se acctualizan los inventarios 
				//===============================================
				$productos = json_decode($traerVenta["productos"],true);
				//var_dump($productos);
				//exit;
				
				$totalProductosComprados = array();

				foreach ($productos as $key => $value)
				{
					// Agregandolo al arreglo.
					array_push($totalProductosComprados,$value["cantidad"]);
					$tablaProductos = "t_Productos";
					$item = "id";
					$valor = $value["id"];
	
					// Obtiene el Producto de la tabla de : "t_Productos", el "Id" viene desde el JSon (Arreglo)
					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos,$item,$valor);

					// Ahora se restara la venta.
					// Actualiza el valor de las veces que se ha vendido el producto
					$item1a = "t_Ventas";
					$valor1a = $traerProducto["ventas"] - $value["cantidad"];
					
					// Actualizar en la tabla de "t_Productos"
					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a,$valor);


					// Ahora actualizando el Stock en la tabla de "t_Productos"
					$item1b = "stock";
					// Cantidad = JSon es el que esta guardado.
					// $traerProducto["stock"]; = Es la existencia que esta registrado en la tabla de "t_Productos"
					$valor1b = $value["cantidad"]+$traerProducto["stock"];
					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b,$valor);

				} // for ($productos as $key => $value)

				// Actualizando en la tabla de clientes, el monto de las compras realizadas.				
				$tablaClientes = "t_Clientes";				
				$itemCliente = "id";
				// Este valor viene desde el Select donde se selecciona el cliente, es valor de identificador del cliente.
				$valorCliente = $traerVenta["id_cliente"];
				
				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes,$itemCliente,$valorCliente);
				// var_dump ($traerCliente);
				// Ahora solo mostrar el campo de "compras"
				//var_dump ($traerCliente["compras"]);

				$item1 = "compras";
				// Suma todas las cantidades de los productos comprados.
				$valor1 = $traerCliente["compras"] - array_sum($totalProductosComprados);
				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes,$item1,$valor1,$valorCliente);

				//======================================================================
				// Eliminar la Venta 
				// =====================================================================

				$respuesta = ModeloVentas::mdlEliminarVenta($tabla,$_GET["idVenta"]);

				if ($respuesta == "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "La venta ha sido borrado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="ventas";
							}

						});
		
					</script>';          


				}

		
				
				//
			} // if (isset($_GET["idVenta"]))

		} // public function ctrEliminarVenta()

		
		// ========================================================
		// Rangos de Fechas
		// ========================================================
		static public function ctrRangoFechasVentas($fechaInicial,$fechaFinal)
		{
			$tabla = "t_Ventas";
			$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla,$fechaInicial,$fechaFinal);
			return $respuesta;

		}

	} // class ControladorVentas
