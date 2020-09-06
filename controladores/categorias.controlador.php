<?php
	// Manejando Categorias.
  class ControladorCategorias
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar categorias.
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

    } // static public function ctrCrearCategoria()


		// ==================================================================================
		// EDITAR categorias.
		static public function ctrEditarCategoria()
		{
			if (isset($_POST["editarCategoria"]))
			{
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarCategoria"]))
				{
					// Enviar la información al Modelo.
					$tabla = "t_Categoria";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("nombre"=>$_POST["editarCategoria"],
													"id"=>$_POST["idCategoria"]);

					$respuesta = ModeloCategorias::mdlEditarCategoria($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La categoria ha sido cambiada correctamente ",
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

		} // static public function ctrCrearCategoria()

		// ========================================================================
		// Borrar Categoria
		static public function ctrBorrarCategoria()
		{
			// "idCategoria" = se origina 
			/*
			//$(document).on("click",".btnEliminarCategoria",function()
		//	{	
		
				// Obteniendo los valores de "idCategoria"
				var idCategoria = $(this).attr("idCategoria");
		*/

			if (isset($_GET["idCategoria"]))
			{
				$tabla = "t_Categoria";
				$datos = $_GET["idCategoria"]; // Obtiene el valor.
				$respuesta = ModeloCategorias::mdlBorrarCategorias($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "La categoria ha sido borrada correctamente ",
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

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idCategoria"]))

		} // static public function ctrBorrarCategoria()

  } // class ControladorCategorias

?> 
  