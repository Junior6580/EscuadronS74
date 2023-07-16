<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT * FROM docentes";
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

$consultaJornadas = "SELECT id, nombre FROM jornadas";
$resultadoJornadas = $conexion->prepare($consultaJornadas);
$resultadoJornadas->execute();
$jornadas = $resultadoJornadas->fetchAll(PDO::FETCH_ASSOC);

$jornadasDic = array();
foreach ($jornadas as $jornada) {
    $jornadasDic[$jornada['id']] = $jornada['nombre'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docentes</title>
</head>

<body>

    <br>
    <?php
    if ($rol == 1 || $rol == 2) {
        ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Docentes</div>

                        <div class="card-body">
                            <table id="datatable" class="table table-sm table-striped">
                                <thead class="bg-danger text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Jornada</th>
                                        <?php
                                        if ($rol == 1) {
                                            ?>
                                            <th style="width: 200px;"><a href="nuevo_docente.php"
                                                    class="btn btn-success btn-sm"><i class="fa-solid fa-circle-plus"
                                                        style="color: #050505;"></i></a></th>
                                            <?php
                                        }
                                        ?>
                                </thead>
                                <tbody>


                                    <?php
                                    foreach ($usuarios as $filtro) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $filtro['id'] ?>
                                            </td>
                                            <td>
                                                <?php echo $filtro['persona_id'] ?>
                                                <?php $personaId = $filtro['persona_id'];
                                                foreach ($personas as $persona) {
                                                    if ($persona['id'] == $personaId) {
                                                        echo $persona['primer_nombre'];
                                                        break;
                                                    }
                                                } ?>
                                            </td>
                                            <td>
                                                <?php echo $filtro['jornada_id'] ?>
                                                <?php $jornadaId = $filtro['jornada_id'];
                                                foreach ($jornadas as $jornada) {
                                                    if ($jornada['id'] == $jornadaId) {
                                                        echo $jornada['nombre'];
                                                        break;
                                                    }
                                                } ?>
                                            </td>
                                            <?php
                                            if ($rol == 1) {
                                                ?>
                                                <td><a href="editar_docentes.php?id=<?php echo $filtro['id']; ?>"
                                                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                    <a href="eliminar_docentes.php?id=<?php echo $filtro['id']; ?>"
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


        <br>
        <footer class="footer">

            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2023 Copyright:
                <a class="text-dark" href="../home.php">EscuadronS74.com</a>
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