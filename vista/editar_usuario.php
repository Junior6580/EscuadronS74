<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM personas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$personas = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT * FROM rol";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$roles = $resultado->fetchAll(PDO::FETCH_ASSOC);

$usuario_id = $_GET['id']; // Obtener el ID del usuario a editar desde la URL

$consulta_usuario = "SELECT * FROM usuarios WHERE id = :usuario_id"; // Consulta para obtener los datos del usuario según su ID
$resultado_usuario = $conexion->prepare($consulta_usuario);
$resultado_usuario->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
$resultado_usuario->execute();
$usuario = $resultado_usuario->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<script> alert('Usuario no encontrado');
          location.href = 'home.php';</script>";
    exit;
}

if ($rol == 1) {
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>

<body>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-success">Editar Usuario</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <label for="persona_id">Selecciona Persona Id:</label>
                            <select class="form-control" name="persona_id" id="persona_id">
                                <option value="">Seleccione Persona Id:</option>
                                <?php
                                    foreach ($personas as $filtro) {
                                        $selected = ($filtro['id'] == $usuario['persona_id']) ? 'selected' : '';
                                        echo '<option value="' . $filtro['id'] . '" ' . $selected . '>' . $filtro['id'] . ' ' . $filtro['primer_nombre'] . ' ' . $filtro['primer_apellido'] . '</option>';
                                    }
                                    ?>
                            </select><br>
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario"
                                value="<?php echo $usuario['usuario']; ?>">
                            <br>
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena"
                                placeholder="Contraseña" value="<?php echo $usuario['contrasena']; ?>">
                            <label class"form-control" type="button" id="togglePassword">Mostrar contraseña</label><br>
                            <br>
                            <label for="rol_id">Selecciona Rol Id:</label>
                            <select class="form-control" name="rol_id" id="rol_id">
                                <option value="">Seleccione Rol Id:</option>
                                <?php
                                    foreach ($roles as $rol) {
                                        $selected = ($rol['id'] == $usuario['rol_id']) ? 'selected' : '';
                                        echo '<option value="' . $rol['id'] . '" ' . $selected . '>' . $rol['id'] . ' ' . $rol['nombre'] . '</option>';
                                    }
                                    ?>
                            </select><br>

                            <button class="btn btn-primary" name="btn_guardar" type="submit">Actualizar</button>
                            <a href="usuarios.php" class="btn btn-danger btn-xl">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('contrasena');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.textContent = type === 'password' ? 'Mostrar contraseña' : 'Ocultar contraseña';
    });
    </script>

    <?php
        include("../modelo/conexioncrud.php");
        if (isset($_POST['btn_guardar'])) {
            $Idpersona = $_POST['persona_id'];
            $Usuario = $_POST['usuario'];
            $Contraseña = $_POST['contrasena'];
            $Rol = $_POST['rol_id'];

            if ($Idpersona == "" || $Usuario == "" || $Contraseña == "" || $Rol == "") {
                echo "<script> alert('Todos los campos son obligatorios');
              location.href = 'editar_usuario.php';</script>";
            } else {
                $ContraseñaEncriptada = password_hash($Contraseña, PASSWORD_DEFAULT);
                $query = mysqli_query($conectar, "UPDATE usuarios SET persona_id = '$Idpersona', usuario = '$Usuario', contrasena = '$ContraseñaEncriptada', rol_id = '$Rol' WHERE id = '$usuario_id'");

                if ($query) {
                    echo "<script> alert('Usuario actualizado correctamente');
                            location.href = 'usuarios.php';</script>";
                }
            }

        }
        ?>

</body>

</html>

<?php
} else {
    echo "<script> alert('No autorizado');
          location.href = 'home.php';</script>";
}
?>