<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT * FROM usuarios";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consultaPersonas = "SELECT id, primer_nombre FROM personas";
$resultadoPersonas = $conexion->prepare($consultaPersonas);
$resultadoPersonas->execute();
$personas = $resultadoPersonas->fetchAll(PDO::FETCH_ASSOC);

$personasDic = array();
foreach ($personas as $persona) {
    $personasDic[$persona['id']] = $persona['primer_nombre'];
}

$consultaRol = "SELECT id, nombre FROM rol";
$resultadoRol = $conexion->prepare($consultaRol);
$resultadoRol->execute();
$roles = $resultadoRol->fetchAll(PDO::FETCH_ASSOC);

$rolDic = array();
foreach ($roles as $role) {
    $rolDic[$role['id']] = $role['nombre'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <br>
    <?php
    if ($rol == 1) {
        ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Usuario Registrados</div>

                    <div class="card-body">
                        <table id="datatable" class="table table-sm table-striped">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th>Id</th>
                                    <th>Persona Id</th>
                                    <th>Usuario</th>
                                    <th>Contraseña</th>
                                    <th>Rol Id</th>
                                    <th style="width: 200px;"><a href="nuevo_usuario.php"
                                            class="btn btn-success btn-sm"><i class="fa-solid fa-circle-plus"
                                                style="color: #050505;"></i></a></th>
                            </thead>
                            <tbody>


                                <?php
                                    foreach ($usuarios as $usuario) {
                                        ?>
                                <tr>
                                    <td>
                                        <?php echo $usuario['id'] ?>
                                    </td>
                                    <td>
                                        <?php echo $usuario['persona_id'] ?>
                                        <?php $personaId = $usuario['persona_id'];
                                                foreach ($personas as $persona) {
                                                    if ($persona['id'] == $personaId) {
                                                        echo $persona['primer_nombre'];
                                                        break;
                                                    }
                                                } ?>
                                    </td>
                                    <td>
                                        <?php echo $usuario['usuario'] ?>
                                    </td>
                                    <td>
                                        <?php echo $usuario['contrasena'] ?>
                                    </td>
                                    <td>
                                        <?php echo $usuario['rol_id'] ?>
                                        <?php $roleId = $usuario['rol_id'];
                                                foreach ($roles as $role) {
                                                    if ($role['id'] == $roleId) {
                                                        echo $role['nombre'];
                                                        break;
                                                    }
                                                } ?>
                                    </td>
                                    <td><a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>"
                                            class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="eliminar_usuario.php?id=<?php echo $usuario['id']; ?>"
                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>

                                </tr>
                                <?php
                                    }
                                    ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <br>
    <footer class="footer">

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 Copyright:
            <a class="text-dark" href="home.php">EscuadronS74.com</a>
        </div>
    </footer>
    <?php
    } else {
        echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
    }
    ?>

</body>

</html>