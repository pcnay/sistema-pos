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
			$orden = "id";
			 
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
			echo json_encode($respuesta);
			 
		}

		// Editar "Productos"
		// Para obtener un producto que se va a editar.
		public $idProducto;
		public $traerProductos;
		public $nombreProducto;

		public function ajaxEditarProducto()
		{
			// Para el caso de que se edita utilizando un dispositivo movil
			if ($this->traerProductos == "ok")
			{
				$item = null;
				$valor = null;
				$orden = "id";
				$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
				echo json_encode($respuesta);	
			}
			else if($this->nombreProducto != "")
			{
				// Para poder obtener el registro que se selecciono del ComboBox.
				$item = "descripcion";
				$valor = $this->nombreProducto;
				$orden = "id";
				$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
				echo json_encode($respuesta);
			}			
			else 
			{
				$item = "id";
				$valor = $this->idProducto;
				$orden = "id";
				$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
				echo json_encode($respuesta);
			}

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
	
	// Traer el Producto, para dispositivos mobiles.
	if (isset($_POST["traerProductos"]))
	{
		$traerProductos = new AjaxProductos();
		$traerProductos->traerProductos = $_POST["traerProductos"];
		$traerProductos->ajaxEditarProducto();
	}

	// Para obtener el nombre del producto.	
	if (isset($_POST["nombreProducto"]))
	{
		$traerProductos = new AjaxProductos();
		$traerProductos->nombreProducto = $_POST["nombreProducto"];
		$traerProductos->ajaxEditarProducto();
	}

?>