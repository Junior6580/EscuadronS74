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
    <title>Nueva Actividad</title>
</head>

<body>
    <br>
    <?php
    if ($rol == 1 || $rol == 2) {
        ?>
        <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row justify-content-center">
                    <div class="col-lg-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Registrar Actividad</h4>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input class="form-control" type="text" name="nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <input class="form-control" type="text" name="descripcion" required>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary" name="btn_guardar" type="submit">Agregar</button>
                                    <a href="actividades.php" class="btn btn-danger btn-xl">Cancelar</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include("../modelo/conexioncrud.php");
        if (isset($_POST['btn_guardar'])) {
            $Nombre = $_POST['nombre'];
            $Descripcion = $_POST['descripcion'];

            if ($Nombre == "" || $Descripcion == "") {
                echo "<script> alert('Todos los campos son obligatorios ')
              location.href = 'nueva_actividad.php';</script>";
            } else {

                $query = mysqli_query($conectar, "INSERT INTO actividads (nombre, descripcion)values('$Nombre', '$Descripcion')");
                if ($query) {
                    echo "<script> alert('Registro Exitoso!!!')
                location.href = 'nueva_actividad.php';</script>";
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