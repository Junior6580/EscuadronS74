<?php include 'navbar.php';

if ($rol == 1) {
    include_once '../modelo/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    if (isset($_GET['id'])) {
        $jornada_id = $_GET['id'];

        $consulta = "DELETE FROM jornadas WHERE id = :jornada_id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':jornada_id', $jornada_id);
        $resultado->execute();

        echo "<script> alert('Jornada eliminado correctamente');
    location.href = 'jornadas.php';</script>";
    } else {
        echo "<script> alert('ID de jornada no válido');
    location.href = 'jornadas.php';</script>";
    }
} else {
    echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
}
?>