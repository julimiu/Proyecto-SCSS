<?php
require  __DIR__ . '/../includes/salidas/create.php';
require __DIR__ . '/../db/conexion.php';

// require __DIR__ ."../includes/funciones.php";

// require_once '../db/funciones.php';
// session_start();
$errores = "";
if (isset($_POST['agregar'])) {
    $errores = create_salida();
}

$salidas = obtener_salidas();

$barco = mysqli_query($conex, "SELECT matricula, nombre FROM barcos;");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de salidas</title>
</head>

<body>
    <h2>Registro de Salidas</h2>

    <?php

    if ($errores) {
        foreach ($errores as $error) {
            echo "<p>" . $error . "<p>";
        }
    }
    ?>


    <form action="" method="post">

        <label for="date">Fecha:</label>
        <input type="date" name="date" id="date"> <br><br>

        <label for="time">Hora:</label>
        <input type="time" name="time" id="time"> <br><br>

        <label for="destination">Destino:</label>
        <input type="text" name="destination" id="destination"> <br><br>

        <label for="barco">Barco:</label>
        <select name="barco" id="barco">
            <option value="">Seleccione un Barco</option>
            <?php while ($s = mysqli_fetch_assoc($barco)) { ?>
            <option value="<?php echo $s['matricula']; ?>">
                <?php echo $s['nombre']; ?>
            </option>
            <?php } ?>
        </select><br><br>

        <button type="submit" name="agregar">Guardar Salida</button>
    </form>


</body>

</html>