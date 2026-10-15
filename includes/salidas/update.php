<?php
include __DIR__ . "/../../db/conexion.php";

$idSalida = $_GET['id'];
$errores = [];


// if (!isset($_GET['license'])) {
//     $errores[] = ("Error: no se recibió la matricula del barco.");
// }

$query = "SELECT * FROM salidas WHERE id_salida = '$idSalida'";
$resultado = mysqli_query($conex, $query);
$salida = mysqli_fetch_assoc($resultado);

// if (!$barco) {
//     $errores[] = "Error: no se encontró el barco.";
//     }

$barco = mysqli_query($conex, "SELECT matricula, nombre FROM barcos;");

if (isset($_POST['editar'])) {


    $date = mysqli_real_escape_string($conex, $_POST['date']);  
    $time = mysqli_real_escape_string($conex, $_POST['time']); 
    $destination = mysqli_real_escape_string($conex, $_POST['destination']); 
    $barco = mysqli_real_escape_string($conex, $_POST['barco']); 


    if (!$date || !$time || !$destination || !$barco) {
        $errores[] = "Todos los campos son obligatorios";
    }

    if (!$errores) {
        $query = "UPDATE salidas SET fecha = '$date', hora = '$time', destino = '$destination', barcos_matricula = '$barco' WHERE id_salida = '$idSalida';";

        //  echo "<pre>";
        //  var_dump($query);
        //  echo "</pre>";
        //  exit;


        // var_dump($query);
        // exit;

        $resultado = mysqli_query($conex, $query);
        $state = ($resultado) ? 2 : 3;
        header("Location: ../../pag/salidas.php?state=$state");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Editar salida</title>
</head>

<body>
    <h2>Editar Salida</h2>

    <?php
    foreach ($errores as $error) {
        echo "<p>" . $error . "</p>";
    }
    ?>

    <form action="" method="post">



        <label for="date">Fecha:</label>
        <input type="date" name="date" id="date" value="<?php echo $salida['fecha']; ?>"> <br><br>

        <label for="time">Hora:</label>
        <input type="time" name="time" id="time" value="<?php echo $salida['hora']; ?>"> <br><br>

        <label for="destination">Destino:</label>
        <input type="text" name="destination" id="destination" value="<?php echo $salida['destino']; ?>"> <br><br>

        <label for="barco">Barco:</label>
        <select name="barco" id="barco">
            <option value="">Seleccione un Barco</option>

            <?php while ($s = mysqli_fetch_assoc($barco)) { ?>
                <option value="<?php echo $s['matricula']; ?>">
                    <?php if ($s['matricula'] == $salida['barcos_matricula']) echo '-->'; ?>

                    <?php echo $s['nombre']; ?>
                </option>
                <!-- <option value="" selected>sdfghj</option> -->
            <?php  } ?>
        </select><br><br>

        <button type="submit" name="editar">Guardar cambios</button><br><br>
    </form>

    <a href="../../pag/salidas.php">Volver a salidas</a>
</body>

</html>