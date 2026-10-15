<?php

$addUser= obtener_usuarios();

function obtener_usuarios (){

    try {
        //1. Importar la conexion a la DB
        require __DIR__ . '/../../db/conexion.php';

        //2. Consultar la DB
        $sql = "SELECT * FROM usuarios;";

        //3. Ejecutar la consulta con mysqli
        $query = mysqli_query($conex, $sql);

        //4. Acceder a los resultados

          // echo '<pre>';
        // var_dump(mysqli_fetch_assoc($query));
        // echo '</pre>';

        // //5. Cierre de conexion
        // $cierre = mysqli_close($conex);
        // var_dump($cierre);
        return $query;
    } catch (\Throwable $th) {
        var_dump($th); 
    }
    
}

function create_user (){
    
     require __DIR__ . '/../../db/conexion.php';
    
     
    $errores = [];
    $cedula = "";
    $name = "";
    $last_name = "";
    $password = "";
    $c_password = "";
    $phone = "";

    if (isset($_POST['agregar'])){
         
        
        $name = mysqli_real_escape_string($conex, $_POST['name']);
        $last_name = mysqli_real_escape_string($conex, $_POST['last_name']);
        $cedula = mysqli_real_escape_string($conex, $_POST['cedula']);
        $email = mysqli_real_escape_string($conex, $_POST['email']);
        $password = $_POST['password'];
        $c_password =  $_POST['c_password'];
        $phone = mysqli_real_escape_string($conex, $_POST['phone']);
        
        
        if(!$cedula){
            $errores []= " Ingrese el numero de cedula";
        }
        if (!ctype_digit($cedula)){
            $errores [] = "El campo del documento debe ser numerico";
        }
        if (!$name){
            $errores [] = "Ingrese un nombre";
        }
        if (!$last_name){
            $errores [] = "Ingrese un apellido";
        }
        if (!$email){
            $errores [] = "Ingrese un numero de correo";
        }
        if (!$password){
            $errores [] = "Ingrese una contraseña";
        }
        if ($password != $c_password){
            $errores[] = " Las contraseñas no coinciden ";
        } else{
            $password = password_hash($password, PASSWORD_BCRYPT);
        }
        if (!$phone){
            $errores [] = "Ingrese un numero de telefono";
        }
       

    
     $query = " SELECT * FROM usuarios WHERE cedula = '" . $cedula . "' ;";
     $resultado = mysqli_query($conex, $query);
    
    //  echo '<pre>';
    //  var_dump($resultado);
    //  echo '</pre>';
    //  exit;
     if ($resultado->num_rows) {
        $errores[] = "El usuario ya existe";

     }
     if (!$errores) {
       $query = "INSERT INTO usuarios (cedula, nombre, apellido, email, telefono, contrasena)
        VALUES ('".$cedula."', '".$name."', '".$last_name."', '".$email."', '".$phone."', '".$password."') "; 

      $resultado = mysqli_query($conex, $query);
      $message = ($resultado) ?  0 : 1;
    //   header("Location: users.php?state=$message");
      header("Location: ../pag/users.php?state=$message");
      exit;
      
    
      } else{
    return $errores;
        }
     }
}
?>


