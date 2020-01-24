<?php
  // Valida el "Ingreso del usuario al Sistema"
  class  ControladorUsuarios
  {
    public function ctrIngresoUsuario()
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

  } // class  ControladorUsuarios
?>
