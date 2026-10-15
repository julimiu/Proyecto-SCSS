<?php
require  __DIR__ . '/../includes/socios/create.php';

// require __DIR__ ."../includes/funciones.php";

// require_once '../db/funciones.php';
// session_start();
$errores = "";
if (isset($_POST['agregar'])){
    $errores = create_socio();
}

$socios = obtener_socios();
// $addUser = create_user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de socios</title>
</head>
<body>
    <h2>Registro de Socios</h2>

    <?php

if($errores) {
    foreach ($errores as $error) {
        echo "<p>" . $error . "<p>";
    }
}
    ?>
    
    
    <form action="" method="post">

<label for="cedula">Cedula:</label>
<input type="text" name="cedula" id="cedula"> <br><br>

<label for= "name">Nombre:</label>
<input type="text" name="name" id="name"> <br><br>

<label for= "last_name">Apellido:</label>
<input type="text" name="last_name" id="last_name"> <br><br>

<label for="address">Direccion:</label>
<input type="text" name="address" id="address"> <br><br>

<label for="phone">Teléfono:</label>
<input type="text" name="phone" id="phone"> <br><br>



<button type="submit" name="agregar">Guardar Socio</button>
</form>

    
</body>
</html>