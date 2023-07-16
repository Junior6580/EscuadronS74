<?php
class Conexion
{
  public static function Conectar()
  {
    define('servidor', 'sql307.byethost31.com');
    define('nombre_bd', 'b31_34602506_instituto');
    define('usuario', 'b31_34602506');
    define('password', 'Medina890#');
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    try {
      $conexion = new PDO("mysql:host=" . servidor . "; dbname=" . nombre_bd, usuario, password, $opciones);

      return $conexion;
    } catch (Exception $e) {
      die("Error de Conexion es: " . $e->getMessage());
    }
  }
}
?>