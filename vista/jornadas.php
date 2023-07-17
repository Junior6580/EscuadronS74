<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT * FROM jornadas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$jornadas = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jornadas</title>
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
                        <div class="card-header">Jornadas</div>

                        <div class="card-body">
                            <table id="datatable" class="table table-sm table-striped">
                                <thead class="bg-danger text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th style="width: 200px;"><a href="nueva_jornada.php"
                                                class="btn btn-success btn-sm"><i class="fa-solid fa-circle-plus"
                                                    style="color: #050505;"></i></a></th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($jornadas as $jornada) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $jornada['id'] ?>
                                            </td>
                                            <td>
                                                <?php echo $jornada['nombre'] ?>
                                            </td>
                                            <td>
                                                <a href="eliminar_jornadas.php?id=<?php echo $jornada['id']; ?>"
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
        <?php
    } else {
        echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
    }
    ?>

</body>

</html>