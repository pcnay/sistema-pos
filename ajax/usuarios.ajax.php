<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

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

		// Activar Usuarios, Cambiarlo de color Rojo a Verde.
		public $activarUsuario;
		public $activarId;
		
		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxActivarUsuario()
		{
			// Accesa directamente al modelo, para actualizar el "estado" del usuario.
			$tabla = 't_Usuario';
			$item1 = "estado";
			$valor1 = $this->activarUsuario; // esta valor lo obtiene al instanciar la clase.
			$item2 = 'id';
			$valor2 = $this->activarId;		

			$repuesta = ModeloUsuarios::mdlActualizarUsuario($tabla,$item1,$valor1,$item2,$valor2);

		}

		public $validarUsuario;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarUsuario()
		{
			$item = "usuario";
			$valor = $this->validarUsuario;

			$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);
			echo json_encode($respuesta);

		}

	} // class AjaxUsuarios


	if (isset($_POST["idUsuario"]))
	{
		$editar = new AjaxUsuarios();
		$editar->idUsuario=$_POST["idUsuario"]; // Se asigna el valor del atributo que se requiere en la clase
		$editar->ajaxEditarUsuario(); 	
	}
	
	// Activar el Usuario:, esta variable $_POST["activarUsuario"] viene desde "usuarios.js"
	if (isset($_POST["activarUsuario"]))
	{
		$activarUsuario = new AjaxUsuarios();
		$activarUsuario->activarUsuario=$_POST["activarUsuario"]; // esta variable viene desde "usuarios.js"
		$activarUsuario->activarId=$_POST["activarId"]; // esta variable viene desde "usuarios.js"
		$activarUsuario->ajaxActivarUsuario();
		 
		 
	}

	// Validar que NO se repita usuario.
	if (isset($_POST["validarUsuario"]))
	{
		$valUsuario = new AjaxUsuarios();
		$valUsuario->validarUsuario = $_POST["validarUsuario"];
		$valUsuario->ajaxValidarUsuario();
	}

?>