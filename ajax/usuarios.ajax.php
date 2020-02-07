<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.

	require_once "../controladores/usuarios.controlador.php";
	require_once "../modelos/usuarios.modelo.php";
	class AjaxUsuarios
	{
		// Editar usuarios.
		// Se conecta a la base de datos para obtener el registro que se va editar.
		public $idUsuario;
		public function ajaxEditarUsuario()
		{
			$item = "id";
			$valor = $this->idUsuario;
			// static public function ctrMostrarUsuarios($item,$valor), se define en "usuarios.controlador"
			// Para este caso solo se va buscar un solo usuarios, el que se va editar, y obtiene los valores.
			// Este método requiere tres parámetros, pero se asignan de acuerdo en donde se aplica.
			$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);  
			// Retorna el valor (El usuario encontrado) y es pasado a formato JSon.
			echo json_encode($respuesta); // Este valor es retornado al archivo "usuarios.js" cuando se ejecuta el "Ajax", oara ser asignado en las etiquetas de la forma.
		}
	}

	if (isset($_POST["idUsuario"]))
	{
		$editar = new AjaxUsuarios();
		$editar->idUsuario=$_POST["idUsuario"]; // Se asigna el valor del atributo que se requiere en la clase
		$editar->ajaxEditarUsuario(); 	
	}
	
?>