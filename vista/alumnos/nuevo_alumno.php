<?php
require_once '../../controlador/css.php';
require_once '../../controlador/js.php';
?>
<?php
include_once '../../modelo/conexion.php';
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

$consulta = "SELECT * FROM grados";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$grados = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Alumno</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container">
            <a class="navbar-brand" href="../home.php"><i class="fa-solid fa-graduation-cap  fa-xs"
                    style="color: #000000;">

                </i> Escuela Cultural</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../home.php"><i
                                class="fa-solid fa-house fa-2xs" style="color: #000000;"> </i> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="alumnos.php"><i
                                class="fa-sharp fa-solid fa-school fa-2xs" style="color: #000000;"> </i> Alumnos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../docentes/docentes.php"><i
                                class="fa-solid fa-chalkboard-user fa-2xs" style="color: #000000;"> </i> Docentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../calificaciones/calificaciones.php"><i
                                class="fa-sharp fa-solid fa-arrow-down-1-9 fa-2xs" style="color: #000000;">
                            </i> Calificaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><i
                                class="fa-sharp fa-solid fa-clock  fa-2xs" style="color: #000000;"> </i> Horarios</a>
                    </li>
                    <li class="nav-item">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-puzzle-piece fa-2xs" style="color: #04070c;">
                            </i> Registros</a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="">
                                <i class="fa-solid fa-book-journal-whills fa-2xs" style="color: #000000;">
                                </i>Materias</a>
                            <a class="dropdown-item" href="">
                                <i class="fa-solid fa-stopwatch-20 fa-2xs" style="color: #06090f;"> </i>Jornadas</a>

                            <a class="dropdown-item" href="">
                                <i class="fa-solid fa-arrow-down-1-9 fa-2xs" style="color: #04070c;"> </i>Grados</a>

                            <a class="dropdown-item" href="">
                                <i class="fa-solid fa-chart-line fa-2xs" style="color: #000000;"> </i>Actividades</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-user-tie fa-2xs" style="color: #000000;">
                            </i>
                            Perfiles
                        </a>


                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="">
                                <i class="fa-solid fa-user fa-2xs" style="color: #000000;"> </i>Usuarios</a>
                            <a class="dropdown-item" href="">
                                <i class="fa-solid fa-person fa-2xs" style="color: #000000;"> </i>Personas</a>


                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-warning">Agregar Alumnos</div>
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
                            <label for="grado_id">Selecciona Grado Id:</label>
                            <select class="form-control" name="grado_id" id="grado_id">
                                <option value="">Seleccione Grado Id:</option>
                                <?php
                                foreach ($grados as $filtro) {
                                    ?>
                                    <option>
                                        <?php echo $filtro['id'] ?>
                                        <?php echo $filtro['nombre'] ?>
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
                            <a href="alumnos.php" class="btn btn-danger btn-xl">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include("../../modelo/conexioncrud.php");
    if (isset($_POST['btn_guardar'])) {
        $Idpersona = $_POST['persona_id'];
        $Idgrado = $_POST['grado_id'];
        $Idjornada = $_POST['jornada_id'];

        if ($Idpersona == "" || $Idgrado == "" || $Idjornada == "") {
            echo "<script> alert('Todos los campos son obligatorios ')
              location.href = 'nuevo_alumno.php';</script>";
        } else {

            $query = mysqli_query($conectar, "INSERT INTO alumnos (persona_id, grado_id, jornada_id)values('$Idpersona', '$Idgrado', '$Idjornada')");
            if ($query) {
                echo "<script> alert('Registro Exitoso!!!')
                location.href = 'nuevo_alumno.php';</script>";
            }
        }
    }
    ?>
    </form>

</body>

</html>