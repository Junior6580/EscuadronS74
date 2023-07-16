<?php include 'navbar.php';

if ($rol == 1) {
    include_once '../modelo/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    if (isset($_GET['id'])) {
        $alumno_id = $_GET['id'];

        $consulta = "DELETE FROM alumnos WHERE id = :alumno_id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':alumno_id', $alumno_id);
        $resultado->execute();

        echo "<script> alert('Alumno eliminado correctamente');
    location.href = 'alumnos.php';</script>";
    } else {
        echo "<script> alert('ID de alumno no válido');
    location.href = 'alumnos.php';</script>";
    }

} else {
    echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
}
?>