<?php include 'navbar.php';

if ($rol == 1 || $rol == 2) {
    include_once '../modelo/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    if (isset($_GET['id'])) {
        $actividad_id = $_GET['id'];


        $consulta = "DELETE FROM actividads WHERE id = :actividad_id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':actividad_id', $actividad_id);
        $resultado->execute();


        echo "<script> alert('Actividad eliminada correctamente');
    location.href = 'actividades.php';</script>";
    } else {

        echo "<script> alert('ID de actividad no válido');
    location.href = 'actividades.php';</script>";
    }
} else {
    echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
}
?>