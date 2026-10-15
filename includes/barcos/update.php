<?php
include __DIR__ . "/../../db/conexion.php";

$license = mysqli_real_escape_string($conex, $_GET['matricula']);
$errores = [];


// if (!isset($_GET['license'])) {
//     $errores[] = ("Error: no se recibió la matricula del barco.");
// }

$query = "SELECT * FROM barcos WHERE matricula = '$license'";
$resultado = mysqli_query($conex, $query);
$barco = mysqli_fetch_assoc($resultado);

// if (!$barco) {
//     $errores[] = "Error: no se encontró el barco.";
//     }

$socio = mysqli_query($conex, "SELECT cedula, nombre FROM socios;");

if (isset($_POST['editar'])) {

    //  $license= mysqli_real_escape_string($conex, $_POST['license']);
    $name = mysqli_real_escape_string($conex, $_POST['name']);  // Fulanito
    $number = mysqli_real_escape_string($conex, $_POST['number']); // 3
    $payment = mysqli_real_escape_string($conex, $_POST['payment']); // 200000
    $socio = mysqli_real_escape_string($conex, $_POST['socio']); // 1101682857


    if (!$name || !$number || !$payment || !$socio) {
        $errores[] = "Todos los campos son obligatorios";
    }
    if ($payment && !is_numeric($payment)) {
        $errores[] = "La cuota debe ser numerica";
    }

    if (!$errores) {
        $query = "UPDATE barcos SET nombre = '$name', n_amarre = '$number', cuota_amarre = '$payment', cedula_socio = '$socio' WHERE matricula = '$license';";

        //  echo "<pre>";
        //  var_dump($query);
        //  echo "</pre>";
        //  exit;


        // var_dump($query);
        // exit;

        $resultado = mysqli_query($conex, $query);
        $state = ($resultado) ? 2 : 3;
        header("Location: ../../pag/barcos.php?state=$state");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Editar barco</title>
</head>

<body>
    <h2>Editar Barco</h2>

    <?php
    foreach ($errores as $error) {
        echo "<p>" . $error . "</p>";
    }
    ?>

    <form action="" method="post">



        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="<?php echo $barco['nombre']; ?>"> <br><br>

        <label for="number">Numero de amarre:</label>
        <input type="text" name="number" id="number" value="<?php echo $barco['n_amarre']; ?>"> <br><br>

        <label for="payment">Cuota del amarre:</label>
        <input type="text" name="payment" id="payment" value="<?php echo $barco['cuota_amarre']; ?>"> <br><br>

        <label for="socio">Socio</label>
        <select name="socio" id="socio">
            <option value="">Seleccione un Socio</option>

            <?php while ($s = mysqli_fetch_assoc($socio)) { ?>
                <option value="<?php echo $s['cedula']; ?>">
                    <?php if ($s['cedula'] == $barco['cedula_socio']) echo '-->'; ?>

                    <?php echo $s['nombre']; ?>
                </option>
                <!-- <option value="" selected>sdfghj</option> -->
            <?php  } ?>
        </select><br><br>

        <button type="submit" name="editar">Guardar cambios</button><br><br>
    </form>

    <a href="../../pag/barcos.php">Volver a barcos</a>
</body>

</html>