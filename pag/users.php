<?php
require __DIR__ . '/../includes/funciones.php';
require __DIR__ . '/../includes/users/create.php'; 

session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: ../login.php");
    exit; 
}

$usuarios = obtener_usuarios();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>

    <h1>Usuarios </h1>

    <a href="../form/formUsuarios.php">Nuevo usuario</a>

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
        <th>Email</th>
        <th>Telefono</th>
        <th>Opciones</th>
    </tr>
</thead>
       
</tbody>


<?php
while ($user = $usuarios->fetch_assoc()) {

?>

<tr>
    <td><?php echo $user['cedula']; ?></td>
    <td><?php echo $user['nombre']; ?></td>
    <td><?php echo $user['apellido']; ?></td>
    <td><?php echo $user['email']; ?></td>
    <td><?php echo $user['telefono']; ?></td>
    
    <td>
        <a href="../includes/users/update.php?id=<?php echo $user['id_usuario']; ?>">Actualizar</a>
        <a href="../includes/users/delete.php?id=<?php echo $user['id_usuario']; ?>"onclick = "return confirmar()">Eliminar</a>
    </td>
</tr>

<?php
}
?>


</tbody>
</table>
<br>
<?php
echo '<a href = "dashboard.php">Ir al panel principal</a>';
?>
<script> 
function  confirmar(){
    return confirm('Seguro de eliminar los datos?');
}
</script>
</body>

</html>