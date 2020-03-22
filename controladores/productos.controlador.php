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

		// Crear producto
		static public function ctrCrearProducto()
		{
			if (isset($_POST["nuevaDescripcion"]))
			{
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaCategoria"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoStock"]) &&
					preg_match('/^[0-9.]+$/',$_POST["nuevoPrecioCompra"]) &&
					preg_match('/^[0-9.]+$/',$_POST["nuevoPrecioVenta"]))
				{
					$tabla = "t_Productos";
					$ruta = "vistas/img/productos/default/anonymous.png";

					// Estos campos se extraen de las etiquetas de la captura de form de los productos, y se colocan en un arreglo.					
					$datos = array("id_categoria" =>$_POST["nuevaCategoria"],
												"codigo" =>$_POST["nuevoCodigo"],
												"descripcion" =>$_POST["nuevaDescripcion"],
												"stock" =>$_POST["nuevoStock"],
												"precio_compra" =>$_POST["nuevoPrecioCompra"],
												"precio_venta" =>$_POST["nuevoPrecioVenta"],
												"imagen" =>$ruta);
					$respuesta = ModeloProductos::mdlIngresarProducto($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
							Swal.fire ({
								type: "success",
								title: "El Producto ha sido guardado correctamente ",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then(function(result){
									if (result.value)
									{
										window.location="productos";
									}
		
									});
			
							</script>';          

					}
				}
				else
				{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "El producto no puede ir con los campos vacios o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="productos";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaCategoria"]))  

			} //if (isset($_POST["nuevaDescripcion"]))
		
		}
		
	}
?>
