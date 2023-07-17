<?php include 'navbar.php';

if ($rol == 1) {
    include_once '../modelo/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    if (isset($_GET['id'])) {
        $horario_id = $_GET['id'];

        $consulta = "DELETE FROM horarios WHERE id = :horario_id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':horario_id', $horario_id);
        $resultado->execute();

        echo "<script> alert('Horario eliminado correctamente');
    location.href = 'horario.php';</script>";
    } else {
        echo "<script> alert('ID de horario no válido');
    location.href = 'horario.php';</script>";
    }
} else {
    echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
}
?>