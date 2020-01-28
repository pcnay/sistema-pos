<?php
  require_once "conexion.php";

  class ModeloUsuarios
  {
    // Mostrar usuarios.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarUsuarios($tabla,$item,$valor)
    {
      //print_r($tabla,$item,$valor);
      //exit;

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
      $stmt->bindParam(":".$item,$valor, PDO::PARAM_STR);
      $stmt->execute();

      return $stmt->fetch(); // Retorna solo una linea.
      $stmt->close();
      $stmt = null; 
    }

    // Registrar Usuario.
    static public function mdlIngresarUsuario($tabla,$datos)
    {
      //print_r($tabla,$item,$valor);
      //exit;

      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, clave, perfil,foto) VALUES (:nombre,:usuario,:password,:perfil,:ruta)");

      $stmt->bindParam(":nombre",$datos["nombre"], PDO::PARAM_STR);
      $stmt->bindParam(":usuario",$datos["usuario"], PDO::PARAM_STR);
      $stmt->bindParam(":password",$datos["password"], PDO::PARAM_STR);
      $stmt->bindParam(":perfil",$datos["perfil"], PDO::PARAM_STR);
      $stmt->bindParam(":ruta",$datos["ruta"], PDO::PARAM_STR);
      
      if ($stmt->execute())
      {
        return "ok";
      }
      else
      {
        return "error";
      }
      
      $stmt->close();
      $stmt = null; 
    }

  }
?>