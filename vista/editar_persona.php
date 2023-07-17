<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consultaeps = "SELECT id, nombre FROM eps";
$resultadoeps = $conexion->prepare($consultaeps);
$resultadoeps->execute();
$epss = $resultadoeps->fetchAll(PDO::FETCH_ASSOC);

$personaId = $_GET['id'] ?? null;
$editMode = !is_null($personaId);

if ($editMode) {
    $consulta = "SELECT * FROM personas WHERE id = :id";
    $resultado = $conexion->prepare($consulta);
    $resultado->bindParam(':id', $personaId, PDO::PARAM_INT);
    $resultado->execute();
    $persona = $resultado->fetch(PDO::FETCH_ASSOC);
}
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
                            <div class="card-header bg-success">Editar persona</div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <?php if ($editMode): ?>
                                        <input type="hidden" name="id" value="<?php echo $persona['id']; ?>">
                                    <?php endif; ?>
                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="tipo_de_documento">Tipo de Documento:</label>
                                            <select class="form-control" id="tipo_de_documento" name="tipo_de_documento"
                                                required>
                                                <option value="">Seleccione Documento</option>
                                                <?php
                                                $tipos_documento = ['Cédula de ciudadanía', 'Tarjeta de identidad', 'Registro civil', 'Cédula de extranjería'];
                                                foreach ($tipos_documento as $tipo) {
                                                    $selected = ($editMode && $tipo == $persona['tipo_de_documento']) ? 'selected' : '';
                                                    echo "<option value=\"$tipo\" $selected>$tipo</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="col">
                                            <label for="numero_documento">Número de Documento:</label>
                                            <input class="form-control" type="number" id="numero_de_documento"
                                                name="numero_de_documento" required
                                                value="<?php echo $editMode ? $persona['numero_de_documento'] : ''; ?>">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="primer_nombre">Primer Nombre:</label>
                                            <input class="form-control" type="text" id="primer_nombre" name="primer_nombre"
                                                required value="<?php echo $editMode ? $persona['primer_nombre'] : ''; ?>">
                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="segundo_nombre">Segundo Nombre:</label>
                                            <input class="form-control" type="text" id="segundo_nombre"
                                                name="segundo_nombre"
                                                value="<?php echo $editMode ? $persona['segundo_nombre'] : ''; ?>">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="primer_apellido">Primer Apellido:</label>
                                            <input class="form-control" type="text" id="primer_apellido"
                                                name="primer_apellido" required
                                                value="<?php echo $editMode ? $persona['primer_apellido'] : ''; ?>">
                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="segundo_apellido">Segundo Apellido:</label>
                                            <input class="form-control" type="text" id="segundo_apellido"
                                                name="segundo_apellido"
                                                value="<?php echo $editMode ? $persona['segundo_apellido'] : ''; ?>">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="fecha_de_nacimiento">Fecha de Nacimiento:</label>
                                            <input class="form-control" type="date" id="fecha_de_nacimiento"
                                                name="fecha_de_nacimiento" required
                                                value="<?php echo $editMode ? $persona['fecha_de_nacimiento'] : ''; ?>">
                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="tipo_de_sangre">Tipo de Sangre:</label>
                                            <select class="form-control" id="tipo_de_sangre" name="tipo_de_sangre" required>

                                                <option value="">Seleccione Tipo de Sangre</option>
                                                <?php
                                                $tipos_sangre = ['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
                                                foreach ($tipos_sangre as $sangre) {
                                                    $selected = ($editMode && $sangre == $persona['tipo_de_sangre']) ? 'selected' : '';
                                                    echo "<option value=\"$sangre\" $selected>$sangre</option>";
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
                                                    $selected = ($editMode && $genero == $persona['genero']) ? 'selected' : '';
                                                    echo "<option value=\"$genero\" $selected>$genero</option>";
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="estrato_socioeconomico">Estrato Socioeconómico:</label>
                                            <select class="form-control" id="estrato_socioeconomico"
                                                name="estrato_socioeconomico" required>

                                                <option value="">Seleccione Estrato</option>
                                                <?php
                                                $estratos = ['No registra', '1', '2', '3', '4', '5', '6'];
                                                foreach ($estratos as $estrato) {
                                                    $selected = ($editMode && $estrato == $persona['estrato_socioeconomico']) ? 'selected' : '';
                                                    echo "<option value=\"$estrato\" $selected>$estrato</option>";
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
                                                    $selected = ($editMode && $maritales == $persona['estado_marital']) ? 'selected' : '';
                                                    echo "<option value=\"$maritales\" $selected>$maritales</option>";
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="eps_id">EPS:</label>
                                            <select class="form-control" id="eps_id" name="eps_id" required>
                                                <option value="">Seleccione EPS</option>
                                                <?php foreach ($epss as $eps) {
                                                    $selected = ($editMode && $eps['id'] == $persona['eps_id']) ? 'selected' : '';
                                                    echo '<option value="' . $eps['id'] . '" ' . $selected . '>' . $eps['nombre'] . '</option>';
                                                } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="direccion">Dirección:</label>
                                            <input class="form-control" type="text" id="direccion" name="direccion" required
                                                value="<?php echo $editMode ? $persona['direccion'] : ''; ?>">
                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="ciudad">Ciudad:</label>
                                            <input class="form-control" type="text" id="ciudad" name="ciudad" required
                                                value="<?php echo $editMode ? $persona['ciudad'] : ''; ?>">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="correo">Correo:</label>
                                            <input class="form-control" type="email" id="correo" name="correo"
                                                value="<?php echo $editMode ? $persona['correo'] : ''; ?>">
                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="telefono_1">Teléfono 1:</label>
                                            <input class="form-control" type="number" id="telefono_1" name="telefono_1"
                                                required value="<?php echo $editMode ? $persona['telefono_1'] : ''; ?>">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="telefono_2">Teléfono 2:</label>
                                            <input class="form-control" type="number" id="telefono_2" name="telefono_2"
                                                value="<?php echo $editMode ? $persona['telefono_2'] : ''; ?>">
                                        </div>
                                    </div><br>

                                    <div class="form-group row">
                                        <div class="col">
                                            <button class="btn btn-primary" name="btn_guardar" type="submit">
                                                Actualizar</button>


                                            <a href="personas.php" class="btn btn-danger btn-xl">Cancelar</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <?php
        include("../modelo/conexioncrud.php");
        if (isset($_POST['btn_guardar'])) {
            $Tipo_documento = $_POST['tipo_de_documento'];
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
            $Direccion = $_POST['direccion'];
            $Ciudad = $_POST['ciudad'];
            $Correo = $_POST['correo'];
            $Telefonouno = $_POST['telefono_1'];
            $Telefonodos = $_POST['telefono_2'];

            if ($Documento == "" || $Primer_nombre == "" || $Primer_apellido == "") {
                echo "<script> alert('Todos los campos son obligatorios');
                    location.href = 'nueva_persona.php';</script>";
            } else {
                $query = mysqli_query($conectar, "UPDATE personas SET tipo_de_documento = '$Tipo_documento', numero_de_documento = '$Documento', primer_nombre = '$Primer_nombre', segundo_nombre = '$Segundo_nombre', primer_apellido = '$Primer_apellido', segundo_apellido = '$Segundo_apellido', fecha_de_nacimiento = '$Fecha_nacimiento', tipo_de_sangre = '$Tipo_sangre', genero = '$Genero', estrato_socioeconomico = '$Estrato', estado_marital = '$Estado_marital', eps_id = '$Eps_Id', direccion = '$Direccion', ciudad = '$Ciudad', correo = '$Correo', telefono_1 = '$Telefonouno', telefono_2 = '$Telefonodos' WHERE id = '$personaId'");

                if ($query) {
                    echo "<script> alert('Persona actualizada correctamente');
                            location.href = 'personas.php';</script>";
                }
            }

        }
        ?>

    </body>

    </html>

    <?php
    } else {
        echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
    }
    ?>