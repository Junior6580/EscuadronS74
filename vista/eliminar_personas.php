<?php include 'navbar.php';

if ($rol == 1) {
    include_once '../modelo/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    if (isset($_GET['id'])) {
        $persona_id = $_GET['id'];

        $consulta = "DELETE FROM personas WHERE id = :persona_id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':persona_id', $persona_id);
        $resultado->execute();

        echo "<script> alert('Persona eliminada correctamente');
    location.href = 'personas.php';</script>";
    } else {
        echo "<script> alert('ID de persona no válido');
    location.href = 'personas.php';</script>";
    }
} else {
    echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
}
?>