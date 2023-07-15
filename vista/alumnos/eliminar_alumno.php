<?php
include_once '../../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if (isset($_GET['id'])) {
    $alumno_id = $_GET['id'];

    // Eliminar el alumno de la base de datos
    $consulta = "DELETE FROM alumnos WHERE id = :alumno_id";
    $resultado = $conexion->prepare($consulta);
    $resultado->bindParam(':alumno_id', $alumno_id);
    $resultado->execute();

    // Realizar cualquier otra acción necesaria, como mostrar un mensaje de éxito o redireccionar a otra página
    echo "<script> alert('Alumno eliminado correctamente');
    location.href = 'alumnos.php';</script>";
} else {
    // Si no se proporciona un ID válido, puedes redireccionar a una página de error o tomar otra acción
    echo "<script> alert('ID de alumno no válido');
    location.href = 'alumnos.php';</script>";
}
?>