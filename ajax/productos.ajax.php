<?php
	require_once "../controladores/productos.controlador.php";
	require_once "../modelos/productos.modelo.php";

	// Se agregan estos archivos, ya que no se cargan al iniciar el archivo "index.php",se carga al ejecutar el archivo "productos.ajax.php"

	class AjaxProductos
	{
		// Generar código a partir de ID Categoría 
		public $idCategoria;
		public function ajaxCrearCodigoProducto()
		{
			$item = "id_categoria";
			$valor = $this->idCategoria;
			 
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);
			 
		}

		// Editar "Productos"
		// Para obtener un producto que se va a editar.
		public $idProducto;
		public function ajaxEditarProducto()
		{
			$item = "id";
			$valor = $this->idProducto;
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);

		}


	} // class AjaxProductos

	if (isset($_POST["idCategoria"]))
	{
		$codigoProducto = new AjaxProductos();
		$codigoProducto->idCategoria = $_POST["idCategoria"];
		$codigoProducto->ajaxCrearCodigoProducto();
	}

	// Para editar el producto.
	if (isset($_POST["idProducto"]))
	{
		$editarProducto = new AjaxProductos();
		$editarProducto->idProducto = $_POST["idProducto"];
		$editarProducto->ajaxEditarProducto();
	}

?>