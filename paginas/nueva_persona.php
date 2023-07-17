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
    <title>Registro Personas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <br>
    <?php
    if ($rol == 1) {
        ?>
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row justify-content-center">
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header bg-success">Registro de persona</div>

                            <form action="" method="POST">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="tipo_documento">Tipo de Documento:</label>
                                        <select class="form-control" id="tipo_documento" name="tipo_documento" required>

                                            <option value="">Seleccione Documento</option>
                                            <?php
                                                $tipos_documento = ['Cédula de ciudadanía', 'Tarjeta de identidad', 'Registro civil', 'Cédula de extranjería']; // Valores permitidos del enum
                                                foreach ($tipos_documento as $tipo) {
                                                    echo "<option value=\"$tipo\">$tipo</option>";
                                                }
                                                ?>

                                        </select>
                                    </div>
                                    <br>
                                    <div class="col">
                                        <label for="numero_documento">Número de Documento:</label>
                                        <input class="form-control" type="number" name="numero_documento" required>
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <div class="col">
                                        <label for="primer_nombre">Primer Nombre:</label>
                                        <input class="form-control" type="text" name="primer_nombre" required>
                                    </div>
                                    <br>

                                    <div class="col">
                                        <label for="segundo_nombre">Segundo Nombre:</label>
                                        <input class="form-control" type="text" name="segundo_nombre">
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <div class="col">
                                        <label for="primer_apellido">Primer Apellido:</label>
                                        <input class="form-control" type="text" name="primer_apellido" required>
                                    </div>
                                    <br>

                                    <div class="col">
                                        <label for="segundo_apellido">Segundo Apellido:</label>
                                        <input class="form-control" type="text" name="segundo_apellido">
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <div class="col">
                                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                                        <input class="form-control" type="date" name="fecha_nacimiento" required>
                                    </div>
                                    <br>

                                    <div class="col">
                                        <label for="tipo_sangre">Tipo de Sangre:</label>
                                        <select class="form-control" id="tipo_sangre" name="tipo_sangre" required>

                                            <option value="">Seleccione Tipo de Sangre</option>
                                            <?php
                                                $tipos_sangre = ['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
                                                foreach ($tipos_sangre as $sangre) {
                                                    echo "<option value=\"$sangre\">$sangre</option>";
                                                }
                                                ?>

                                        </select>
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <div class="col">
                                        <label for="genero">Género:</label>
                                        <select class="form-control" id="genero" name="genero" required>

                                            <option value="">Seleccione Genero</option>
                                            <?php
                                                $generos = ['No registra', 'Masculino', 'Femenino'];
                                                foreach ($generos as $genero) {
                                                    echo "<option value=\"$genero\">$genero</option>";
                                                }
                                                ?>

                                        </select>
                                    </div>
                                    <br>

                                    <div class="col">
                                        <label for="estrato">Estrato Socioeconómico:</label>
                                        <select class="form-control" id="estrato" name="estrato" required>

                                            <option value="">Seleccione Estrato</option>
                                            <?php
                                                $estratos = ['No registra', '1', '2', '3', '4', '5', '6'];
                                                foreach ($estratos as $estrato) {
                                                    echo "<option value=\"$estrato\">$estrato</option>";
                                                }
                                                ?>

                                        </select>
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <div class="col">
                                        <label for="estado_marital">Estado Marital:</label>
                                        <select class="form-control" id="estado_marital" name="estado_marital" required>

                                            <option value="">Seleccione Estado Marital</option>
                                            <?php
                                                $maritales = ['No registra', 'Soltero(a)', 'Casado(a)', 'Separado(a)'];
                                                foreach ($maritales as $maritales) {
                                                    echo "<option value=\"$maritales\">$maritales</option>";
                                                }
                                                ?>

                                        </select>
                                    </div>
                                    <br>

                                    <div class="col">
                                        <label for="eps_id">EPS:</label>
                                        <select class="form-control" name="eps_id" required>
                                            <option value="">Seleccione Eps</option>
                                            <?php foreach ($epss as $eps) { ?>
                                            <option value="<?php echo $eps['id']; ?>"><?php echo $eps['nombre']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <div class="col">
                                        <label for="direccion">Dirección:</label>
                                        <input class="form-control" type="text" name="direccion" required>
                                    </div>
                                    <br>

                                    <div class="col">
                                        <label for="ciudad">Ciudad:</label>
                                        <input class="form-control" type="text" name="ciudad" required>
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <div class="col">
                                        <label for="correo">Correo:</label>
                                        <input class="form-control" type="email" name="correo">
                                    </div>
                                    <br>

                                    <div class="col">
                                        <label for="telefono1">Teléfono 1:</label>
                                        <input class="form-control" type="number" name="telefono1" required>
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <div class="col">
                                        <label for="telefono2">Teléfono 2:</label>
                                        <input class="form-control" type="number" name="telefono2">
                                    </div>
                                </div><br>

                                <div class="form-group row">
                                    <div class="col">
                                        <button class="btn btn-primary" name="btn_guardar" type="submit">
                                            Agregar</button>


                                        <a href="personas.php" class="btn btn-danger btn-xl">Cancelar</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php
        include("../modelo/conexioncrud.php");
        if (isset($_POST['btn_guardar'])) {
            $Tipo_documento = $_POST['tipo_documento'];
            $Documento = $_POST['numero_de_documento'];
            $Primer_nombre = $_POST['primer_nombre'];
            $Segundo_nombre = $_POST['segundo_nombre'];
            $Primer_apellido = $_POST['primer_apellido'];
            $Segundo_apellido = $_POST['segundo_apellido'];
            $Fecha_nacimiento = $_POST['fecha_de_nacimiento'];
            $Tipo_sangre = $_POST['tipo_de_sangre'];
            $Genero = $_POST['genero'];
            $Estrato = $_POST['estrato_socioeconomico'];
            $Estado_marital = $_POST['estado_marital'];
            $Eps_Id = $_POST['eps_id'];
            $Direccion = $_POST['dirrecion'];
            $Ciudad = $_POST['ciudad'];
            $Correo = $_POST['correo'];
            $Telefonouno = $_POST['telefono_1'];
            $Telefonodos = $_POST['telefono_2'];

            if ($Documento == "" || $Primer_nombre == "" || $Primer_apellido == "") {
                echo "<script> alert('Todos los campos son obligatorios ')
              location.href = 'nueva_persona.php';</script>";
            } else {
                $consultaExistencia = "SELECT COUNT(*) as total FROM personas WHERE numero_de_documento = '$Documento'";
                $resultadoExistencia = $conexion->prepare($consultaExistencia);
                $resultadoExistencia->execute();
                $existePersona = $resultadoExistencia->fetch(PDO::FETCH_ASSOC)['total'];

                if ($existePersona > 0) {
                    echo "<script> alert('Esta personas ya existe en la base de datos');
                    location.href = 'nueva_persona.php';</script>";
                } else {
                    $query = mysqli_query($conectar, "INSERT INTO personas (tipo_documento, numero_de_documento, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_de_nacimiento, tipo_de_sangre, genero, estrato_socioeconomico, estado_marital, eps_id, dirrecion, ciudad, telefono_1, telefono_2) 
                    VALUES ('$Tipo_documento', '$Documento', '$Primer_nombre', '$Segundo_nombre', '$Primer_apellido', '$Segundo_apellido', '$Fecha_nacimiento', '$Tipo_sangre', '$Genero', '$Estrato', '$Estado_marital', '$Eps_Id', '$Direccion', '$Ciudad', '$Correo', '$Telefonouno', '$Telefonodos')");

                    if ($query) {
                        echo "<script> alert('Registro Exitoso!!!')
                            location.href = 'nueva_persona.php';</script>";
                    }
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