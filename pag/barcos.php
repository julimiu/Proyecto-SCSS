<?php
require __DIR__ . '/../includes/funciones.php';
require __DIR__ . '/../includes/barcos/create.php'; 


session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: ../login.php");
    exit; 
}

$barcos = obtener_barcos();

// debug($barcos);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcos</title>

    <h1>Barcos</h1>

    <a href="../form/formBarcos.php">Nuevo barco</a>

    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>

<tbody>
<table>
    <thead>
        <tr>
        <th>Matricula</th>
        <th>Nombre</th>
        <th>N_amarre</th>
        <th>Cuota_amarre</th>
        <th>Socio</th>
        <th>Opciones</th>
    </tr>
</thead>
       
</tbody>


<?php
while ($barco = $barcos->fetch_assoc()) {

?>

<tr>
    <td><?php echo $barco['matricula']; ?></td>
    <td><?php echo $barco['nombre']; ?></td>
    <td><?php echo $barco['n_amarre']; ?></td>
    <td><?php echo $barco['cuota_amarre']; ?></td>
    <td><?php echo $barco['socio_nombre']; ?></td>
    
    <td>
        <a href="../includes/barcos/update.php?matricula=<?php echo $barco['matricula']; ?>">Actualizar</a>
        <a href="../includes/barcos/delete.php?matricula=<?php echo $barco['matricula']; ?>"onclick = "return confirmar()">Eliminar</a>
    </td>
</tr>

<?php
}
?>


</tbody>
</table>
<br>
<?php
echo '<a href = "dashboard.php">Volver al panel principal</a>';
?>
<script> 
function  confirmar(){
    return confirm('Seguro de eliminar los datos?');
}
</script>
</body>

</html>