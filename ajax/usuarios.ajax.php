<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano.

	require_once "../controladores/usuarios.controlador.php";
	require_once "../modelos/usuarios.modelo.php";
	class AjaxUsuarios
	{
		// Editar usuarios.
		public $idUsuario;
		public function ajaxEditarUsuario()
		{
			$item = "id";
			$valor = $this->idUsuario;
			// static public function ctrMostrarUsuarios($item,$valor), se define en "usuarios.controlador"
			// Para este caso solo se va buscar un solo usuarios, el que se va editar, y obtiene los valores.
			$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);  
			// Retorna el valor (El usuario encontrado) en formato JSon.
			echo json_encode($respuesta);
		}
	}

	if (isset($_POST["idUsuario"]))
	{
		$editar = new AjaxUsuarios();
		$editar->idUsuario=$_POST["idUsuario"];
		$editar->ajaxEditarUsuario(); 	
	}
	
?>