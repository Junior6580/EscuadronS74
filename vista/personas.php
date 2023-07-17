<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT * FROM personas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$personas = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consultaeps = "SELECT id, nombre FROM eps";
$resultadoeps = $conexion->prepare($consultaeps);
$resultadoeps->execute();
$epss = $resultadoeps->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <br>
    <?php
    if ($rol == 1) {
        ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-14">
                <div class="card">
                    <div class="card-header">Personas Registradas</div>

                    <div class="card-body">
                        <table id="datatable" class="table table-sm table-striped">
                            <thead class="bg-danger text-white">
                                <tr>

                                    <th>Id</th>
                                    <th>Tipo De Documento</th>
                                    <th>Numero De Documento</th>
                                    <th>Primer Nombre</th>
                                    <th>Segundo Nombre</th>
                                    <th>Primer Apellido</th>
                                    <th>Segundo Apellido</th>
                                    <th>Fecha De Nacimiento</th>
                                    <th>Tipo De Sangre</th>
                                    <th>Genero</th>
                                    <th>Estrato SocioEconomico</th>
                                    <th>Estado Marital</th>
                                    <th>Eps_Id</th>
                                    <th>Dirección</th>
                                    <th>Ciudad</th>
                                    <th>Correo</th>
                                    <th>Telefono 1</th>
                                    <th>Telefono 2</th>
                                    <th style="width: 200px;"><a href="nueva_persona.php"
                                            class="btn btn-success btn-sm"><i class="fa-solid fa-circle-plus"
                                                style="color: #050505;"></i></a></th>

                            </thead>
                            <tbody>
                                <?php
                                    foreach ($personas as $persona) {
                                        ?>
                                <tr>
                                    <td>
                                        <?php echo $persona['id'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['tipo_de_documento'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['numero_de_documento'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['primer_nombre'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['segundo_nombre'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['primer_apellido'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['segundo_apellido'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['fecha_de_nacimiento'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['tipo_de_sangre'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['genero'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['estrato_socioeconomico'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['estado_marital'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['eps_id'] ?>
                                        <?php $epsId = $persona['eps_id'];
                                                foreach ($epss as $eps) {
                                                    if ($eps['id'] == $epsId) {
                                                        echo $eps['nombre'];
                                                        break;
                                                    }
                                                } ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['direccion'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['ciudad'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['correo'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['telefono_1'] ?>
                                    </td>
                                    <td>
                                        <?php echo $persona['telefono_2'] ?>
                                    </td>
                                    <td><a href="editar_persona.php?id=<?php echo $persona['id']; ?>"
                                            class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="eliminar_personas.php?id=<?php echo $persona['id']; ?>"
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

    <?php
    } else {
        echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
    }
    ?>

</body>

</html>