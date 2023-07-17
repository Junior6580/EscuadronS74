<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT * FROM actividads";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$actividades = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividades</title>
</head>

<body>

    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Actividades</div>

                    <div class="card-body">
                        <table id="datatable" class="table table-sm table-striped">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <?php
                                    if ($rol == 1 || $rol == 2) {
                                        ?>
                                        <th style="width: 200px;"><a href="nueva_actividad.php"
                                                class="btn btn-success btn-sm"><i class="fa-solid fa-circle-plus"
                                                    style="color: #050505;"></i></a></th>
                                        <?php
                                    }
                                    ?>
                            </thead>
                            <tbody>


                                <?php
                                foreach ($actividades as $actividad) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $actividad['id'] ?>
                                        </td>
                                        <td>
                                            <?php echo $actividad['nombre'] ?>
                                        </td>
                                        <td>
                                            <?php echo $actividad['descripcion'] ?>
                                        </td>
                                        <?php
                                        if ($rol == 1 || $rol == 2) {
                                            ?>
                                            <td>
                                                <a href="editar_actividades.php?id=<?php echo $actividad['id']; ?>"
                                                    class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="eliminar_actividades.php?id=<?php echo $actividad['id']; ?>"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
                                            <?php
                                        }
                                        ?>
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


</body>

</html>