<?php include 'navbar.php';

if ($rol == 1) {
    include_once '../modelo/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    if (isset($_GET['id'])) {
        $grado_id = $_GET['id'];


        $consulta = "DELETE FROM grados WHERE id = :grado_id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':grado_id', $grado_id);
        $resultado->execute();


        echo "<script> alert('Grado eliminado correctamente');
    location.href = 'grados.php';</script>";
    } else {

        echo "<script> alert('ID de grado no válido');
    location.href = 'grado.php';</script>";
    }
} else {
    echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
}
?>