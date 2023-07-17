<?php include 'navbar.php';

if ($rol == 1 || $rol == 2) {
    include_once '../modelo/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    if (isset($_GET['id'])) {
        $calificacion_id = $_GET['id'];


        $consulta = "DELETE FROM calificacions WHERE id = :calificacion_id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':calificacion_id', $calificacion_id);
        $resultado->execute();


        echo "<script> alert('Calificacion eliminada correctamente');
    location.href = 'calificaciones.php';</script>";
    } else {

        echo "<script> alert('ID de calificacion no válido');
    location.href = 'calificaciones.php';</script>";
    }
} else {
    echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
}
?>