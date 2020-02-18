<?php
	// Manejando Categorias.
  class ControladorCategorias
  {
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
  