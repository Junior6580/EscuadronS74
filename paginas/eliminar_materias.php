<?php include 'navbar.php';

if ($rol == 1) {
    include_once '../modelo/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    if (isset($_GET['id'])) {
        $materia_id = $_GET['id'];

        $consulta = "DELETE FROM materias WHERE id = :materia_id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':materia_id', $materia_id);
        $resultado->execute();

        echo "<script> alert('Materia eliminado correctamente');
    location.href = 'materias.php';</script>";
    } else {
        echo "<script> alert('ID de materia no válido');
    location.href = 'materias.php';</script>";
    }
} else {
    echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
}
?>