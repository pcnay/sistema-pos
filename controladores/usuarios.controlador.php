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
          $tabla = 't_Usuario';
          $item = 'usuario'; // El campo a revisar, para este caso es "usuario"
          $valor = $_POST["ingUsuario"];
          // Esta forma es para obtener un valor directamente y se almacena en una variable.
          $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);
          if (($respuesta["usuario"] == $_POST["ingUsuario"]) && ($respuesta["clave"] == $_POST["ingPassword"]))
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
          $tabla = "t_Usuario";
          $datos = array("nombre"=>$_POST["nuevoNombre"],
                          "usuario"=>$_POST["nuevoUsuario"],
                        "password"=> $_POST["nuevoPassword"],
                        "perfil"=>$_POST["nuevoPerfil"] );
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
          /*
          echo '<script>
                  alert("NO Se cumple la condicion");
                  window.location = "categorias";
          </script>';
          */

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
