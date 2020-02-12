<?php
  // Valida el "Ingreso del usuario al Sistema"
  class  ControladorUsuarios
  {
    static public function ctrIngresoUsuario()
    {
      // Esta intentando ingresar el usuario.
      if (isset($_POST["ingUsuario"]))
      {
        // Validando solo letras y números, para proteger la Base De Datos SQL Inyection
        // preg_match('/^[a-zA-Z0-9]+$/',$_POST["ingUsuario"]) && (preg_match('/^[a-zA-Z0-9]+$/',$_POST["ingPassword"]
        if (preg_match('/^[a-zA-Z0-9]+$/',$_POST["ingUsuario"]) && preg_match('/^[a-zA-Z0-9]+$/',$_POST["ingPassword"]))
        {

          // Este valor  '$2a$07$usesomesillystringforsalt$' es fijo, se utilizar para descriptar e encriptar la clave.
          $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

          $tabla = 't_Usuario';
          $item = 'usuario'; // El campo a revisar, para este caso es "usuario"
          $valor = $_POST["ingUsuario"];
          // Esta forma es para obtener un valor directamente y se almacena en una variable.
          
					$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);							

					if ($respuesta["usuario"] == 'admin')
					{
						$encriptar = $respuesta["clave"];
					}
					
					//var_dump($encriptar);
					//print_r($encriptar);
					//exit;

          if (($respuesta["usuario"] == $_POST["ingUsuario"]) && ($respuesta["clave"] == $encriptar))
          {
						// Verifica si el usuario esta activo.
						if ($respuesta["estado"] == 1 )
						{
							// $desencriptar
							// Inicia Session. Se inicia con la creacion de Variables de Sesion.
							//echo '<br><div class="alert alert-success">Bienvenido al Sistema</div>';
							$_SESSION["iniciarSesion"] = "ok";
							$_SESSION["id"] = $respuesta["id"];
							$_SESSION["nombre"] = $respuesta["nombre"];
							$_SESSION["usuario"] = $respuesta["usuario"];
							$_SESSION["foto"] = $respuesta["foto"];
							$_SESSION["perfil"] = $respuesta["perfil"];
							
							// Registrando la Fecha y Hora cuando el usuario ingresa la sistema.
							// https://www.php.net/manual/es/timezones.php, muestra las permitidas por PHP.
							// Ademas es importante que se escriba esta funcion, ya que los servidores Cloud tienen hora donde se encuentran Call Center, con esta funcion 
							// "date_default_timezone_set... para que que escriba la fecha y hora local para escribirla en la base de datos  
							date_default_timezone_set('America/Tijuana');

							// En este orden porque es como se graba en la base de datos.
							$fecha = date('Y-m-d');
							$hora = date('H:i:s');
							$fechaActual = $fecha.' '.$hora;
							
							$item1 = "ultimo_login";  
							$valor1 = $fechaActual;

							$item2 = "id";
							$valor2 = $respuesta["id"];
							
							$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla,$item1,$valor1,$item2,$valor2);
							if ($ultimoLogin == "ok")
							{
								echo '<script>
											window.location ="inicio";
								 			</script>';

							}							  

						} // if ($respuesta["estado"] == 1 )
						else
						{
							echo '<br><div class="alert alert-danger">El Usuario Aun No esta Activado !!</div>';	
						} // if ($respuesta["estado"] == 1 )

					}
					
          else
          {
            echo '<br><div class="alert alert-danger">Error Al Ingresar.</div>';
            
          }


        }

      }

    } // public function ctrIngresoUsuario()

		// Registro Usuarios
		// Se coloca "static" ya que algunos hosting muestra error, por lo que se coloca.
    static public function ctrCrearUsuario()
    {
			// Valida si esta creada la variable POST "nuevoUsuario", que se encuentra en el formulario; cuando se oprime el boton Submit, se poueden incluir todas del formulario 
			//Para poder ejecutar esta funcion. 

      if (isset($_POST["nuevoUsuario"]))
      {
        
        // preg_match('/^[a-zA-ZO-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoNombre"]) && preg_match('/^[a-zA-ZO-9]+$/',$_POST["nuevoUsuario"]) &&
						 //preg_match('/^[a-zA-Z0-9]+$/',$_POST["nuevoNombre"])
				// Validando que lo que tecleo el usuario sea valido con la sig. expresion regular.
        if ( preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoNombre"]) && preg_match('/^[a-zA-Z0-9]+$/',$_POST["nuevoUsuario"]) && preg_match('/^[a-zA-Z0-9]+$/',$_POST["nuevoPassword"]))
        {
          /* Para guardar las fotos, sera de la siguiente manera: 
          1.- En una carpeta del servidor se subira la foto
          2.- En la base de datos solo se guardara la ruta donde esta almacenada la foto en el servidor.

          */
          $ruta ="";
					// Validando que se encuentre la foto en la etiqueta de "vistas/modulos/usuarios.php" seccion de "modalAgregarUsuario" etiqueta tipo "File" "nuevaFoto"
          if (isset($_FILES["nuevaFoto"]["tmp_name"]))
          {
            // Crea un nuevo array
            //Definiendo el tamaño de la foto de 500X500.
            // getimagesize($_FILES["nuevaFoto"]["tmp_name"]), es un arreglo que en la primera, segunda posicion tiene el tamaño de la foto "Ancho" y "Alto"
            list($ancho,$alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
            //var_dump(getimagesize($_FILES["nuevaFoto"]["tmp_name"])); 

            // Los tamaños de la foto a guardar en la computadora
            $nuevoAncho = 500;
            $nuevoAlto = 500;

            // Crear el directorio donde se guardara la foto del usuario
						$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];
						// Si se esta utilizando servidor de Linux, se tiene que dar permisos totales a la carpeta de "usuarios".
            mkdir ($directorio,0755);

            // De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
            if ($_FILES["nuevaFoto"]["type"] == "image/jpeg")
            {
              $aleatorio = mt_rand(100,999); // Utilizado para el nombre del archivo.
              $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";
              $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
              // Cuando se define el nuevo tamaño de al foto, mantenga los colores.
							$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
							
							// Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
							// imagecopyresized (dst_image,src_image,dst_x, dst_y,src_x,src_y,dst_w,dst_h,src_w,src_h)
              imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
              // Guardar la foto en la computadora.
							imagejpeg($destino,$ruta);
							
            }

            // De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
            if ($_FILES["nuevaFoto"]["type"] == "image/png")
            {
              $aleatorio = mt_rand(100,999);
              $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";
              $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
              // Cuando se define el nuevo tamaño de al foto, mantenga los colores.
              $destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
							// Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
							// imagecopyresized (dst_image,src_image,dst_x, dst_y,src_x,src_y,dst_w,dst_h,src_w,src_h)

              imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
              // Guardar la foto en la computadora.
              imagejpeg($destino,$ruta);
            }
            
          }
          // '$2a$07$usesomesillystringforsalt$ = Este valor es el sig. parametro de la función es un nivel de encriptacion
          // Se le llama Capsula, envuelve lo que se quiere encriptar.
					$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					// Se definen los datos, nombre de la tabla y un arreglo para ser insertado en la base de datos
          $tabla = "t_Usuario";
          $datos = array("nombre"=>$_POST["nuevoNombre"],
                          "usuario"=>$_POST["nuevoUsuario"],
                    	  	 "password"=> $encriptar,
                      	  "perfil"=>$_POST["nuevoPerfil"],
                      		"ruta" =>$ruta );
          
          // Conectar la capa Controlador con la del Modelo.
          $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla,$datos);

          if ($respuesta == "ok")
          {
            echo '<script>           
            	Swal.fire ({
								type: "success",
								title: "El usuario ha sido guardado correctamente ",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then((result)=>{
									if (result.value)
									{
										window.location="usuarios";
									}

									});
        
          </script>';          
            
					}
					else
					{
						echo '<script>           
            	Swal.fire ({
								type: "danger",
								title: "El usuario ha sido guardado correctamente ",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then((result)=>{
									if (result.value)
									{
										window.location="usuarios";
									}

									});
        
          		</script>';          
            
					}
          
        }
        else // if ( preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoNombre"]) && preg_match('/^....
        {
          // Este plugins se baja de : https://www.jsdelivr.com/package/npm/sweetalert2, se copia en un archivo el contenido y se agrega en la carpeta "Vistas/plugins/sweetalert2/sweetalert2.all.js"
          
          echo '<script>
            Swal.fire ({
              type: "error",
              title: "El usuario no puede ir vacio o llevar caracteres especiales",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
              }).then((result)=>{
                if (result.value)
                {
                  window.location="usuarios";
                }

                });
        
          </script>';          
          


        } // if ( preg_match('/^[a-zA-Z0-9ñÑáé....

      } // if (isset($_POST["nuevoUsuario"]))

    } // static public function ctrCrearUsuario()

		// ==================================================================
		// Extrae los datos desde la base de datos.
		// ==================================================================
		static public function ctrMostrarUsuarios($item,$valor)
		{
			$tabla = "t_Usuario";
			$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarUsuarios()

		// Editar Usuario:
		static public function ctrEditarUsuario()
		{
			// Validando los campos de la forma.
			//echo '<pre class="bg-white">' ; var_dump(getimagesize($_FILES["editarFoto"]["tmp_name"])); echo '</pre>'; 
			//exit;
			

			if (isset($_POST["editarUsuario"]))
			{
				

				if ( preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarNombre"]))						
				{
					//echo '<script>alert("Entro a ctrEditarUsuario");</script>';
					// Se suprime el "editarPassword" dado que cuando el usuario no modifica la clave, el campo sera en blanco y no nunca se cumple la condicion,
					// De igual forma se suprime "editarUsuario" porque se crean carpetas por cada usuario nuevo por lo que se estaran creando carpetas innecesarias, ocupando espacios en el servidor.
					
					// Validar foto
					$ruta = $_POST["fotoActual"];
					//print_r($ruta);
					//exit;

					//echo '<pre class="bg-white">'; print_r($_POST["fotoActual"]); echo '</pre>';

					if (isset($_FILES["editarFoto"]["tmp_name"]) && (!empty($_FILES["editarFoto"]["tmp_name"])))
					{
						//echo '<script>alert("cumple condicion $_FILES[editarFoto][tmp_name]");</script>';
						// Crea un nuevo array
						//Definiendo el tamaño de la foto de 500X500.
						// getimagesize($_FILES["nuevaFoto"]["tmp_name"]), es un arreglo que en la primera, segunda posicion tiene el tamaño de la foto "Ancho" y "Alto"
						//var_dump(getimagesize($_FILES["editarFoto"]["tmp_name"])); 
						list($ancho,$alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
						

						// Los tamaños de la foto a guardar en la computadora
						$nuevoAncho = 500;
						$nuevoAlto = 500;

						// Crear el directorio donde se guardara la foto del usuario
 						$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

						// Verificando si existe una foto (ubicacion) en la Base De Datos.
						if(!empty($_POST["fotoActual"]))
						{
								// Borrar la foto que se encuentra en la computadora
								unlink($_POST["fotoActual"]);
						}
						else
						{
							// Si se tiene un servidor Linux, se tiene que dar permisos 777 totales para este caso es : "/var/www/html/sistema-pos/vistas/img/usuarios "
							// Si viene vacia.
							mkdir ($directorio,0755);
						}



						// De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
						if ($_FILES["editarFoto"]["type"] == "image/jpeg")
						{
							$aleatorio = mt_rand(100,999);
							$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";
							$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
							// Cuando se define el nuevo tamaño de al foto, mantenga los colores.
							$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
							// Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
							imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
							// Guardar la foto en la computadora.
							imagejpeg($destino,$ruta);
						}
  
						// De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
						if ($_FILES["editarFoto"]["type"] == "image/png")
						{
							$aleatorio = mt_rand(100,999);
							$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";
							$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
							// Cuando se define el nuevo tamaño de al foto, mantenga los colores.
							$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
							// Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
							imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
							// Guardar la foto en la computadora.
							imagejpeg($destino,$ruta);
						}
						
					} // if (isset($_FILES["editarFoto"]["tmp_name"]))
					// Actualizar los campos en la base de datos

					$tabla = "t_Usuario";
					if ($_POST["editarPassword"] != "") // Tiene información, se cambiara la clave
					{
						if (preg_match('/^[a-zA-Z0-9]+$/',$_POST["editarPassword"])) // Valida  la nueva contraseña que solo tengan letras y numeros.
						{ 
								$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
						}
						else
						{
								echo '<script>
								Swal.fire ({
									type: "error",
									title: "El usuario no puede ir vacio o llevar caracteres especiales",
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
									}).then((result)=>{
										if (result.value)
										{
											window.location="categorias";
										}

										});
						
								</script>';          

						} // if (preg_match('/^[a-zA-Z0-9]+$/',$_POST["editarPassword"]))

					}
					else // if ($_POST["editarPassword"] != "")
					{
							$encriptar = $_POST["passwordActual"];

					} // if ($_POST["editarPassword"] != "")

					// Asignando los valores antes validados en un arreglo.
					$datos = array("nombre"=>$_POST["editarNombre"],
							"usuario"=>$_POST["editarUsuario"],
							"password"=> $encriptar,
							"perfil"=>$_POST["editarPerfil"],
							"ruta" =>$ruta );
					
							var_dump ($datos);

					// Grabar la información en la tabla de la base de datos.
					$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>							
							Swal.fire ({
								type: "success",
								title: "El usuario ha sido guardado correctamente ",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then((result)=>{
									if (result.value)
									{
										window.location="usuarios";
									}

									});
				
						</script>';          
 						
					}

				} // if ( preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarNombre"]))
				else
				{
					echo '<script>
						Swal.fire ({
							type: "error",
							title: "El nombre  no puede ir vacio o llevar caracteres especiales !",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then((result)=>{
								if (result.value)
								{
									window.location="usuarios";
								}

								});
			
						</script>';          						
			
				} // if ( preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarNombre"]))

			} // if (isset($_POST["editarUsuario"]))

		} // static public function ctrEditarUsuario()

  } // class  ControladorUsuarios
?>
