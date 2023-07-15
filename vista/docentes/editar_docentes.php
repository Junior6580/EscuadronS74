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

$docente_id = $_GET['id'];

$consulta = "SELECT * FROM docentes WHERE id = :docente_id";
$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':docente_id', $docente_id);
$resultado->execute();
$docente = $resultado->fetch(PDO::FETCH_ASSOC);

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
                        <a class="nav-link active" aria-current="page" href="../alumnos/alumnos.php"><i
                                class="fa-sharp fa-solid fa-school fa-2xs" style="color: #000000;"> </i> Alumnos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="docentes.php"><i
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
                    <div class="card-header bg-warning">Editar Docentes</div>
                    <div class="card-body">
                        <form action="" method="post">

                            <label for="persona_id">Selecciona Persona Id:</label>
                            <select class="form-control" name="persona_id" id="persona_id">
                                <option value="">Seleccione Persona Id:</option>
                                <?php
                                foreach ($usuarios as $filtro) {
                                    $selected = ($filtro['id'] == $docente['persona_id']) ? 'selected' : '';
                                    echo "<option value='" . $filtro['id'] . "' $selected>" . $filtro['id'] . ' ' . $filtro['primer_nombre'] . ' ' . $filtro['primer_apellido'] . "</option>";
                                }
                                ?>
                            </select><br>

                            <label for="jornada_id">Selecciona Jornada Id:</label>
                            <select class="form-control" name="jornada_id" id="jornada_id">
                                <option value="">Seleccione Jornada Id:</option>
                                <?php
                                foreach ($jornadas as $filtro) {
                                    $selected = ($filtro['id'] == $docente['jornada_id']) ? 'selected' : '';
                                    echo "<option value='" . $filtro['id'] . "' $selected>" . $filtro['id'] . ' ' . $filtro['nombre'] . "</option>";
                                }
                                ?>
                            </select><br>

                            <button class="btn btn-primary" name="btn_guardar" type="submit">Editar</button>
                            <a href="docentes.php" class="btn btn-danger btn-xl">Cancelar</a>
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
        $Idjornada = $_POST['jornada_id'];

        // Realiza la actualización en la base de datos
        $consulta = "UPDATE docentes SET persona_id = :persona_id, jornada_id = :jornada_id WHERE id = :docente_id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':persona_id', $Idpersona);
        $resultado->bindParam(':jornada_id', $Idjornada);
        $resultado->bindParam(':docente_id', $docente_id);
        $resultado->execute();

        // Realiza cualquier otra acción necesaria, como mostrar un mensaje de éxito o redireccionar a otra página
        echo "<script> alert('Docente actualizado correctamente');
        location.href = 'docentes.php';</script>";
    }
    ?>
    </form>

</body>

</html>