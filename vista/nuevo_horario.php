<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT * FROM grados";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$grados = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT * FROM materias";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$materias = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Horario</title>
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
                        <div class="card-header bg-success">Nuevo Horario</div>
                        <div class="card-body">
                            <form action="" method="post">

                                <div class="form-group">
                                    <label for="dia_de_la_semana">Dia de la semana:</label>
                                    <select class="form-control" id="dia_de_la_semana" name="dia_de_la_semana">

                                        <option value="">Seleccione dia</option>
                                        <option value="Lunes">Lunes</option>
                                        <option value="Martes">Martes</option>
                                        <option value="Miercoles">Miercoles</option>
                                        <option value="Jueves">Jueves</option>
                                        <option value="Viernes">Viernes</option>

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="hora_inicio">Hora de inicio:</label>
                                    <input class="form-control" type="time" name="hora_inicio" required>
                                </div>

                                <div class="form-group">
                                    <label for="hora_fin">Hora de fin:</label>
                                    <input class="form-control" type="time" name="hora_fin" required>

                                </div>
                                <div class="form-group">
                                    <label for="materia_id">Materia:</label>
                                    <select class="form-control" name="materia_id" required>
                                        <option value="">Seleccione Materia:</option>
                                        <?php
                                        foreach ($materias as $materia) {
                                            ?>
                                            <option>
                                                <?php echo $materia['id'] ?>
                                                <?php echo $materia['nombre'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="grado_id">Grado:</label>
                                    <select class="form-control" name="grado_id" required>
                                        <option value="0">Seleccione grado</option>
                                        <?php
                                        foreach ($grados as $grado) {
                                            ?>
                                            <option>
                                                <?php echo $grado['id'] ?>
                                                <?php echo $grado['nombre'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div><br>

                                <button class="btn btn-primary" name="btn_guardar" type="submit">Agregar</button>
                                <a href="horario.php" class="btn btn-danger btn-xl">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include("../modelo/conexioncrud.php");
        if (isset($_POST['btn_guardar'])) {
            $Dia = $_POST['dia_de_la_semana'];
            $Inicio = $_POST['hora_inicio'];
            $Fin = $_POST['hora_fin'];
            $Materia = $_POST['materia_id'];
            $Grado = $_POST['grado_id'];

            if ($Dia == "" || $Inicio == "" || $Fin == "" || $Materia == "" || $Grado == "") {
                echo "<script> alert('Todos los campos son obligatorios ')
              location.href = 'nuevo_horario.php';</script>";
            } else {

                $query = mysqli_query($conectar, "INSERT INTO horarios (dia_de_la_semana, hora_inicio, hora_fin, materia_id, grado_id)values('$Dia', '$Inicio', '$Fin', '$Materia', '$Grado')");
                if ($query) {
                    echo "<script> alert('Registro Exitoso!!!')
                location.href = 'nuevo_horario.php';</script>";
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