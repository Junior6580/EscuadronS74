<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT * FROM personas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Nuevo Docente</title>
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
                        <div class="card-header bg-warning">Agregar Docentes</div>
                        <div class="card-body">
                            <form action="" method="post">

                                <label for="persona_id">Selecciona Persona Id:</label>
                                <select class="form-control" name="persona_id" id="persona_id">
                                    <option value="">Seleccione Persona Id:</option>
                                    <?php
                                    foreach ($usuarios as $filtro) {
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
                                <label for="jornada_id">Selecciona Jornada Id:</label>
                                <select class="form-control" name="jornada_id" id="jornada_id">
                                    <option value="">Seleccione Jornada Id:</option>
                                    <?php
                                    foreach ($jornadas as $filtro) {
                                        ?>
                                        <option>
                                            <?php echo $filtro['id'] ?>
                                            <?php echo $filtro['nombre'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select><br>

                                <button class="btn btn-primary" name="btn_guardar" type="submit">Agregar</button>
                                <a href="docentes.php" class="btn btn-danger btn-xl">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include("../modelo/conexioncrud.php");
        if (isset($_POST['btn_guardar'])) {
            $Idpersona = $_POST['persona_id'];
            $Idjornada = $_POST['jornada_id'];

            if ($Idpersona == "" || $Idjornada == "") {
                echo "<script> alert('Todos los campos son obligatorios ')
              location.href = 'nuevo_alumno.php';</script>";
            } else {

                $query = mysqli_query($conectar, "INSERT INTO docentes (persona_id, jornada_id)values('$Idpersona', '$Idjornada')");
                if ($query) {
                    echo "<script> alert('Registro Exitoso!!!')
                location.href = 'nuevo_docente.php';</script>";
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