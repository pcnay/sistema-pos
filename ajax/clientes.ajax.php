<?php

	require_once "../controladores/clientes.controlador.php";
	require_once "../modelos/clientes.modelo.php";


	class AjaxClientes
	{

		public function ctrMostrarClientes($item,$valor)
		{
			$tabla = "t_Clientes";
			
			$respuesta = ModeloClientes::mdlMostrarClientes($tabla,$item,$valor);

			return $respuesta;
		}

		public $idCliente;
		public function ajaxEditarCliente()
		{
			
			$item = "id";
			$valor = $this->idCliente;

			$respuesta = ControladorClientes::ctrMostrarClientes($item,$valor);
			//$respuesta = $valor;
			//$respuesta = "Valor";
			//print_r($respuesta);

			echo json_encode($respuesta);
			
		}
		
	} // class AjaxClientes

	// Instanciando la clase para ser utilizable.
	if (isset($_POST["idCliente"]))
	{
		
		$cliente = new AjaxClientes();
		$cliente->idCliente = $_POST["idCliente"];
		$cliente->ajaxEditarCliente();
		
	}

?>


