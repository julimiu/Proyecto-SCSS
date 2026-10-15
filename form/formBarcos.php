<?php
require  __DIR__ . '/../includes/barcos/create.php';
require __DIR__ . '/../db/conexion.php';

// require __DIR__ ."../includes/funciones.php";

// require_once '../db/funciones.php';
// session_start();
$errores = "";
if (isset($_POST['agregar'])) {
    $errores = create_barco();
}

$barcos = obtener_barcos();

$socio = mysqli_query($conex, "SELECT cedula, nombre FROM socios;");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de barcos</title>
</head>

<body>
    <h2>Registro de Barcos</h2>

    <?php

    if ($errores) {
        foreach ($errores as $error) {
            echo "<p>" . $error . "<p>";
        }
    }
    ?>


    <form action="" method="post">

        <label for="license">Matricula:</label>
        <input type="text" name="license" id="license"> <br><br>

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name"> <br><br>

        <label for="number">N_amarre:</label>
        <input type="text" name="number" id="number"> <br><br>

        <label for="payment">Cuota de amarre:</label>
        <input type="text" name="payment" id="payment"> <br><br>

        <label for="socio">Socio:</label>
        <select name="socio" id="socio">
            <option value="">Seleccione un Socio</option>
            <?php while ($s = mysqli_fetch_assoc($socio)) { ?>
            <option value="<?php echo $s['cedula']; ?>">
                <?php echo $s['nombre']; ?>
            </option>
            <?php } ?>
        </select><br><br>

        <button type="submit" name="agregar">Guardar Barco</button>
    </form>


</body>

</html>