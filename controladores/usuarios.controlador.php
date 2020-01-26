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
          $desencriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

          $tabla = 't_Usuario';
          $item = 'usuario'; // El campo a revisar, para este caso es "usuario"
          $valor = $_POST["ingUsuario"];
          // Esta forma es para obtener un valor directamente y se almacena en una variable.
          
          $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);
          if (($respuesta["usuario"] == $_POST["ingUsuario"]) && ($respuesta["clave"] == $desencriptar))
          {
            // Inicia Session .
            //echo '<br><div class="alert alert-success">Bienvenido al Sistema</div>';
            $_SESSION["iniciarSesion"] = "ok";
            echo '<script>
                  window.location ="inicio";
                  </script>';
          }
          else
          {
            echo '<br><div class="alert alert-danger">Error Al Ingresar.</div>';
            
          }


        }

      }

    } // public function ctrIngresoUsuario()

    // Registro Usuarios
    static public function ctrCrearUsuario()
    {
      // Valida si esta creada la variable POST "nuevoUsuario", cuando se oprime el boton Submit

      if (isset($_POST["nuevoUsuario"]))
      {
        
        // preg_match('/^[a-zA-ZO-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoNombre"]) && preg_match('/^[a-zA-ZO-9]+$/',$_POST["nuevoUsuario"]) &&
             //preg_match('/^[a-zA-Z0-9]+$/',$_POST["nuevoNombre"])
        if ( preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoNombre"]) && preg_match('/^[a-zA-Z0-9]+$/',$_POST["nuevoUsuario"]) && preg_match('/^[a-zA-Z0-9]+$/',$_POST["nuevoPassword"]))
        {
          /* Para guardar las fotos, sera de la siguiente manera: 
          1.- En una carpeta del servidor se subira la foto
          2.- En la base de datos solo se guardara la ruta donde esta almacenada la foto en el servidor.

          */
          $ruta ="";
          
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
            mkdir ($directorio,0755);

            // De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
            if ($_FILES["nuevaFoto"]["type"] == "image/jpeg")
            {
              $aleatorio = mt_rand(100,999);
              $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";
              $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
              // Cuando se define el nuevo tamaño de al foto, mantenga los colores.
              $destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
              // Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
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
              imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
              // Guardar la foto en la computadora.
              imagejpeg($destino,$ruta);
            }
            
          }
          // '$2a$07$usesomesillystringforsalt$ = Este valor es el sig. parametro de la función es un nivel de encriptacion
          // Se le llama Capsula, envuelve lo que se quiere encriptar.
          $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
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
              alert ("Usuario grabado correctamente ..");
              window.location="usuarios";
              
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
          
        }
        else
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
                  window.location="categorias";
                }

                });
        
          </script>';          
          


        } // if ( preg_match('/^[a-zA-Z0-9ñÑáé....

      } // if (isset($_POST["nuevoUsuario"]))

    } // static public function ctrCrearUsuario()

  } // class  ControladorUsuarios
?>
