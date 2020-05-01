<?php
	// Crear clientes:
	class ControladorClientes
	{
		static public function ctrCrearCliente()
		{
			// Verifica si esta creada la variable Get de la forma.
			if (isset($_POST["nuevoCliente"]))
			{
				// Validando los datos
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoCliente"]) && preg_match('/^[0-9]+$/',$_POST["nuevoDocumentoId"]) && 
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"]))			
				{

					$tabla = "t_Clientes";
					$datos = array ("nombre"=>$_POST["nuevoCliente"],
					"documento"=>$_POST["nuevoDocumentoId"],
					"email"=>$_POST["nuevoEmail"],
					"telefono"=>$_POST["nuevoTelefono"],					
					"direccion"=>$_POST["nuevaDireccion"],
					"fecha_nacimiento"=>$_POST["nuevaFechaNacimiento"]);
					$respuesta = ModeloClientes::mdlIngresarCliente($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Cliente ha sido guardado correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="clientes";
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
						title: "El cliente no puede ir vacio o llevar caracteres especiales",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="clientes";
							}

						});
		
					</script>';          

				}

			} // if (isset($_POST["nuevoCliente"]))

		} // static public function ctrCrearCliente()

		// Mostrar Clientes.
		static public function ctrMostrarClientes($item,$valor)
		{
			$tabla = "t_Clientes";
			$respuesta = ModeloClientes::mdlMostrarClientes($tabla,$item,$valor);

			return $respuesta;
		}

	} // class ControladorClientes
?>
