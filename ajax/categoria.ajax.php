<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/categorias.controlador.php";
	require_once "../modelos/categorias.modelo.php";
	
	class AjaxCategorias
	{
		// Validar si existe una categoria.
		public $validarCategoria;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarCategoria()
		{
			$item = "nombre";
			$valor = $this->validarCategoria;

			$respuesta = ControladorCategorias::ctrMostrarCategorias($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Categorias
		public $idCategoria;
		public function ajaxEditarCategoria()
		{
			$item = "id";
			$valor = $this->idCategoria;
			$respuesta = ControladorCategorias::ctrMostrarCategorias($item,$valor);
			echo json_encode($respuesta);
		}


	} // class AjaxUsuarios

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Categoria.
	// datos.append("idCategoria",idCategoria); // Se crea la variable "POST", "idCategoria"
	if (isset($_POST["idCategoria"]))
	{
		$categoria = new AjaxCategorias();
		$categoria->idCategoria = $_POST["idCategoria"];
		$categoria->ajaxEditarCategoria();
	}

	// Validar que NO se repita la categoria.
	if (isset($_POST["validarCategoria"]))
	{
		$valCategoria = new AjaxCategorias();
		$valCategoria->validarCategoria = $_POST["validarCategoria"];
		$valCategoria->ajaxValidarCategoria();
	}

?>