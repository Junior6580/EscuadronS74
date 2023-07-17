<?php include 'navbar.php';

if ($rol == 1) {
    include_once '../modelo/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    if (isset($_GET['id'])) {
        $usuario_id = $_GET['id'];

        $consulta = "DELETE FROM usuarios WHERE id = :usuario_id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':usuario_id', $usuario_id);
        $resultado->execute();

        echo "<script> alert('Usuario eliminado correctamente');
    location.href = 'usuarios.php';</script>";
    } else {
        echo "<script> alert('ID de usuario no válido');
    location.href = 'usuarios.php';</script>";
    }
} else {
    echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
}
?>