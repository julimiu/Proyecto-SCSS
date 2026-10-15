<?php
include __DIR__ . "/../../db/conexion.php";

$errores = [];

// Recibir la cédula desde la URL
if (!isset($_GET['cedula'])) {
    $errores[] = ("Error: no se recibió la cédula del socio.");
}

$cedula = mysqli_real_escape_string($conex, $_GET['cedula']);

// Buscar al socio
$query = "SELECT * FROM socios WHERE cedula = '$cedula'";
$resultado = mysqli_query($conex, $query);
$socio = mysqli_fetch_assoc($resultado);

if (!$socio) {
    $errores[] = "Error: no se encontró el socio.";
}

if (isset($_POST['editar'])){
//  $cedula= mysqli_real_escape_string($conex, $_POST['cedula']);
 $name= mysqli_real_escape_string($conex, $_POST['name']);
 $last_name= mysqli_real_escape_string($conex, $_POST['last_name']);
 $address= mysqli_real_escape_string($conex, $_POST['address']);
 $phone= mysqli_real_escape_string($conex, $_POST['phone']);


  if (!$cedula || !$name || !$last_name || !$address || !$phone){
        $errores[] = "Todos los campos son obligatorios";
    }
 
    if (!$errores){
        $query = "UPDATE socios SET cedula = '$cedula', nombre = '$name', apellido = '$last_name', direccion = '$address', telefono = '$phone'";
       
        $query .= " WHERE cedula = " . $cedula . ";";
 
        $resultado = mysqli_query($conex, $query);
        $state = ($resultado) ? 2 : 3;
        header("Location: ../../pag/socios.php?state=$state");
        exit;
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar socio</title>
</head>
<body>
    <h2>Editar Socio</h2>
 
    <?php
    foreach ($errores as $error) {
        echo "<p>" . $error . "</p>";
    }
    ?>
 
    <form action="" method="post">

        <!-- <label for="cedula">Cedula:</label>
        <input type="text" name="cedula" id="cedula" value="<?php echo $socio['cedula']; ?>"> <br><br> -->

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="<?php echo $socio['nombre']; ?>"> <br><br>
 
        <label for="last_name">Apellido:</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $socio['apellido']; ?>"> <br><br>
 
        <label for="address">Direccion:</label>
        <input type="text" name="address" id="address" value="<?php echo $socio['direccion']; ?>"> <br><br>
 
        <label for="phone">Telefono:</label>
        <input type="text" name="phone" id="phone" value="<?php echo $socio['telefono']; ?>"> <br><br>
 
        <button type="submit" name="editar">Guardar cambios</button><br><br>
    </form>

    <a href="../../pag/socios.php">Volver a socios</a>
</body>
</html>