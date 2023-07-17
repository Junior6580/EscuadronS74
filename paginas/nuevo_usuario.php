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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Alumno</title>

</head>

<body>
    <br>
    <?php
    if ($rol == 1) {
        ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-success">Nuevo Usuario</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <label for="persona_id">Selecciona Persona Id:</label>
                            <select class="form-control" name="persona_id" id="persona_id">
                                <option value="">Seleccione Persona Id:</option>
                                <?php
                                    foreach ($personas as $filtro) {
                                        ?>
                                <option>
                                    <?php echo $filtro['id'] ?>
                                    <?php echo $filtro['primer_nombre'] ?>
                                    <?php echo $filtro['primer_apellido'] ?>
                                </option>
                                <?php
                                    }
                                    ?>
                            </select><br>
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
                            <br>
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena"
                                placeholder="Contraseña">
                            <label class"form-control" type="button" id="togglePassword">Mostrar
                                contraseña</label><br>
                            <br>
                            <label for="rol_id">Selecciona Rol Id:</label>
                            <select class="form-control" name="rol_id" id="rol_id">
                                <option value="">Seleccione Rol Id:</option>
                                <?php
                                    foreach ($roles as $rol) {
                                        ?>
                                <option>
                                    <?php echo $rol['id'] ?>
                                    <?php echo $rol['nombre'] ?>
                                </option>
                                <?php
                                    }
                                    ?>
                            </select><br>

                            <button class="btn btn-primary" name="btn_guardar" type="submit">Agregar</button>
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
                echo "<script> alert('Todos los campos son obligatorios ')
              location.href = 'nuevo_usuario.php';</script>";
            } else {
                $consultaExistencia = "SELECT COUNT(*) as total FROM usuarios WHERE persona_id = '$Idpersona'";
                $resultadoExistencia = $conexion->prepare($consultaExistencia);
                $resultadoExistencia->execute();
                $existePersona = $resultadoExistencia->fetch(PDO::FETCH_ASSOC)['total'];

                if ($existePersona > 0) {
                    echo "<script> alert('El persona_id ya existe en la tabla usuarios.');
                    location.href = 'nuevo_usuario.php';</script>";
                } else {
                    $ContraseñaEncriptada = password_hash($Contraseña, PASSWORD_DEFAULT);
                    $query = mysqli_query($conectar, "INSERT INTO usuarios (persona_id, usuario, contrasena, rol_id) VALUES ('$Idpersona', '$Usuario', '$ContraseñaEncriptada', '$Rol')");

                    if ($query) {
                        echo "<script> alert('Registro Exitoso!!!')
                            location.href = 'nuevo_usuario.php';</script>";
                    }
                }
            }
        }
        ?>
    </form>
    <?php
    } else {
        echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
    }
    ?>

</body>

</html>