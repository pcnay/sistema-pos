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
    }
  }
?>