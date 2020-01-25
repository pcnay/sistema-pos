<?php
  class Conexion
  {
    static public function conectar()
    {
      $link = new PDO("mysql:host=localhost;dbname=pos",
                      "ventas-pos",
                      "pcnay2003");
      $link->exec("set names utf8"); // Para caracteres en español
      return $link;
    }
  }
?>