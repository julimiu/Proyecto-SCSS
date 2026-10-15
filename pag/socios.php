<?php
require __DIR__ . '/../includes/funciones.php';
require __DIR__ . '/../includes/socios/create.php'; 

session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: ../index.php");
    exit; 
}

$socios = obtener_socios();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socios</title>

    <h1>Socios</h1>

    <a href="../form/formSocios.php">Nuevo socio</a>

    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>

<tbody>
<table>
    <thead>
        <tr>
        <th>Cedula</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Opciones</th>
    </tr>
</thead>
       
</tbody>


<?php
while ($socio = $socios->fetch_assoc()) {

?>

<tr>
    <td><?php echo $socio['cedula']; ?></td>
    <td><?php echo $socio['nombre']; ?></td>
    <td><?php echo $socio['apellido']; ?></td>
    <td><?php echo $socio['direccion']; ?></td>
    <td><?php echo $socio['telefono']; ?></td>
    
    <td>
        <a href="../includes/socios/update.php?cedula=<?php echo $socio['cedula']; ?>">Actualizar</a>
        <a href="../includes/socios/delete.php?cedula=<?php echo $socio['cedula']; ?>"onclick = "return confirmar()">Eliminar</a>
    </td>
</tr>

<?php
}
?>


</tbody>
</table>
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