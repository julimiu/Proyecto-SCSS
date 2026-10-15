    <?php
    
    require './includes/users/create.php';
    require './db/conexion.php';
    // require './db/obtenerUsuarios.php';

    $usuarios = obtener_usuarios();
  
    if (isset($_POST['agregar'])){
        $userForm = $_POST['name-form'];
        $pwForm =$_POST['pw-form'];
        $userDB = "";
        $pwDB = "";

    
        $query = "SELECT * FROM usuarios WHERE nombre = '" . mysqli_real_escape_string($conex, $userForm) . "';";
        $resultado = mysqli_query($conex, $query); 

        if ($resultado->num_rows > 0) {
            foreach ( $resultado as $usuario) {
                $userDB = $usuario['nombre'];
                $pwDB = $usuario['contrasena'];
            }
            $autenticado = password_verify($pwForm, $pwDB);
            // var_dump($pwForm, $pwDB, $autenticado);
            if ($userForm === $userDB && $autenticado) {
                session_start();
                $_SESSION['nombre'] = $userDB;
                header ("location: pag/dashboard.php");
                exit;
            
            }else {
                echo"Usuario o contraseña errada";
            }

        }
    
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="build/css/app.css">
        <title>Proyecto</title>
    </head>
    <body>

    <main class="login">

        
    <form class="formulario" action="" method="post">
        <h1 class="login-titulo">Login</h1>

    <div class="campo">
        <label for = "name-form">Nombre de Usuario</label>
        <input type="text" name="name-form">
    </div>

    <div class="campo">
        <label for = "pw-form">Contraseña</label>
        <input type="password" name="pw-form">
    </div>

    <input class="boton" type="submit" value="Enviar" name="agregar"> 
        <!-- <h1>Conexion con My SQL</h1> -->

</form>
</main>
        <!-- <table>
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                </tr>
          </thead>

        <tbody>
           
        </tbody>
    </table> -->

</body>
</html>