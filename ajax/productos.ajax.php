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


	} // class AjaxProductos

	if (isset($_POST["idCategoria"]))
	{
		$codigoProducto = new AjaxProductos();
		$codigoProducto->idCategoria = $_POST["idCategoria"];
		$codigoProducto->ajaxCrearCodigoProducto();
	}
?>