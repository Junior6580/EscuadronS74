<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT * FROM materias";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$materias = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT * FROM docentes";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$docentes = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consultaPersonas = "SELECT id, primer_nombre FROM personas";
$resultadoPersonas = $conexion->prepare($consultaPersonas);
$resultadoPersonas->execute();
$personas = $resultadoPersonas->fetchAll(PDO::FETCH_ASSOC);

$personasDic = array();
foreach ($personas as $persona) {
    $personasDic[$persona['id']] = $persona['primer_nombre'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias</title>
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
                        <div class="card-header">Materias</div>

                        <div class="card-body">
                            <table id="datatable" class="table table-sm table-striped">
                                <thead class="bg-danger text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Docente Id</th>
                                        <th style="width: 200px;"><a href="nueva_materia.php"
                                                class="btn btn-success btn-sm"><i class="fa-solid fa-circle-plus"
                                                    style="color: #050505;"></i></a></th>
                                </thead>
                                <tbody>


                                    <?php
                                    foreach ($materias as $materia) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $materia['id'] ?>
                                            </td>
                                            <td>
                                                <?php echo $materia['nombre'] ?>
                                            </td>
                                            <td>
                                                <?php echo $materia['descripcion'] ?>
                                            </td>

                                            <td>
                                                <?php echo $materia['docente_id'] ?>
                                                <?php $personaId = $materia['docente_id'];
                                                foreach ($personas as $persona) {
                                                    if ($persona['id'] == $personaId) {
                                                        echo $persona['primer_nombre'];
                                                        break;
                                                    }
                                                } ?>
                                            </td>
                                            <td>
                                                <a href="eliminar_materias.php?id=<?php echo $materia['id']; ?>"
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