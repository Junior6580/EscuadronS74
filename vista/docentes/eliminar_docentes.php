<?php
include_once '../../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if (isset($_GET['id'])) {
    $docente_id = $_GET['id'];

    $consulta = "DELETE FROM docentes WHERE id = :docente_id";
    $resultado = $conexion->prepare($consulta);
    $resultado->bindParam(':docente_id', $docente_id);
    $resultado->execute();

    echo "<script> alert('Docente eliminado correctamente');
    location.href = 'docentes.php';</script>";
} else {
    echo "<script> alert('ID de docente no válido');
    location.href = 'docentes.php';</script>";
}
?>