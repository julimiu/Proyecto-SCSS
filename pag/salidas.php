<?php
require __DIR__ . '/../includes/funciones.php';
require __DIR__ . '/../includes/salidas/create.php'; 

session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: ../login.php");
    exit; 
}

$salidas = obtener_salidas();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salidas</title>

    <h1>Salidas</h1>

    <a href="../form/formSalidas.php">Nueva salida</a>

    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>

<tbody>
<table>
    <thead>
        <tr>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Destino</th>
        <th>Barco</th>
        <th>Opciones</th>
    </tr>
</thead>
       
</tbody>


<?php
while ($salida = $salidas->fetch_assoc()) {

?>

<tr>
    <td><?php echo $salida['fecha']; ?></td>
    <td><?php echo $salida['hora']; ?></td>
    <td><?php echo $salida['destino']; ?></td>
    <td><?php echo $salida['nombre']; ?></td>
    
    <td>
        <a href="../includes/salidas/update.php?id=<?php echo $salida['id_salida']; ?>">Actualizar</a>
        <a href="../includes/salidas/delete.php?id=<?php echo $salida['id_salida']; ?>"onclick = "return confirmar()">Eliminar</a>
    </td>
</tr>

<?php
}
?>


</tbody>
</table><br>
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