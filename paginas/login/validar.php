<?php
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

$conexion = mysqli_connect("localhost", "root", "", "instituto");
$consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' and contraseña='$contraseña'";
$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_num_rows($resultado);

if ($filas > 0) {
    session_start();
    $_SESSION['nombredelusuario'] = $usuario;
    header("location:../home.php");
} else {
    echo "Error en la autenticacion";
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>