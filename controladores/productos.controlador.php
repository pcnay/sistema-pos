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
          /* Para guardar las fotos, sera de la siguiente manera: 
          1.- En una carpeta del servidor se subira la foto
          2.- En la base de datos solo se guardara la ruta donde esta almacenada la foto en el servidor.

           */
          
					// Validando que se encuentre la foto en la etiqueta de "vistas/modulos/usuarios.php" seccion de "modalAgregarUsuario" etiqueta tipo "File" "nuevaImagen"
          if (isset($_FILES["nuevaImagen"]["tmp_name"]))
          {
            // Crea un nuevo array
            //Definiendo el tamaño de la foto de 500X500.
            // getimagesize($_FILES["nuevaImagen"]["tmp_name"]), es un arreglo que en la primera, segunda posicion tiene el tamaño de la foto "Ancho" y "Alto"
            list($ancho,$alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);
            //var_dump(getimagesize($_FILES["nuevaImagen"]["tmp_name"])); 

            // Los tamaños de la foto a guardar en la computadora
            $nuevoAncho = 500;
            $nuevoAlto = 500;

            // Crear el directorio donde se guardara la foto del usuario
						$directorio = "vistas/img/productos/".$_POST["nuevoCodigo"];
						// Si se esta utilizando servidor de Linux, se tiene que dar permisos totales a la carpeta de "productos".
            mkdir ($directorio,0755);

            // De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
            if ($_FILES["nuevaImagen"]["type"] == "image/jpeg")
            {
              $aleatorio = mt_rand(100,999); // Utilizado para el nombre del archivo.
              $ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";
              $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
              // Cuando se define el nuevo tamaño de al foto, mantenga los colores.
							$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
							
							// Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
							// imagecopyresized (dst_image,src_image,dst_x, dst_y,src_x,src_y,dst_w,dst_h,src_w,src_h)
              imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
              // Guardar la foto en la computadora.
							imagejpeg($destino,$ruta);
							
            }

            // De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
            if ($_FILES["nuevaImagen"]["type"] == "image/png")
            {
              $aleatorio = mt_rand(100,999);
              $ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";
              $origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);
              // Cuando se define el nuevo tamaño de al foto, mantenga los colores.
              $destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
							// Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
							// imagecopyresized (dst_image,src_image,dst_x, dst_y,src_x,src_y,dst_w,dst_h,src_w,src_h)

              imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
              // Guardar la foto en la computadora.
              imagejpeg($destino,$ruta);
            }
            
          }





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
