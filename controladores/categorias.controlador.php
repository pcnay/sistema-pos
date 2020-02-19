<?php
	// Manejando Categorias.
  class ControladorCategorias
  {

		// ==================================================================
		// Extrae los datos desde la base de datos.
		// ==================================================================
		static public function ctrMostrarCategorias($item,$valor)
		{
			$tabla = "t_Categoria";
			$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarCategorias()


		// Crear categorias.
		static public function ctrCrearCategoria()
    {
			if (isset($_POST["nuevaCategoria"]))
			{
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaCategoria"]))
				{
					// Enviar la información al Modelo.
					$tabla = "t_Categoria";
					$datos = $_POST["nuevaCategoria"];
					$respuesta = ModeloCategorias::mdlIngresarCategoria($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La categoria ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="categorias";
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
						title: "La categoria no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="categorias";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaCategoria"]))

			}
    }
  
  }

?>
  