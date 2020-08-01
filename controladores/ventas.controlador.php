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
					var_dump($traerProducto["ventas"]);
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

	} // class ControladorVentas

?>
