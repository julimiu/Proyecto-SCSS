<?php

$addSocio= obtener_socios();

function obtener_socios (){

    try {
        //1. Importar la conexion a la DB
        require __DIR__ . '/../../db/conexion.php';

        //2. Consultar la DB
        $sql = "SELECT * FROM socios;";

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

function create_socio (){
    
     require __DIR__ . '/../../db/conexion.php';
    
     
    $errores = [];
    $cedula = "";
    $name = "";
    $last_name = "";
    $address = "";
    $phone = "";

    if (isset($_POST['agregar'])){
         
        
        $name = mysqli_real_escape_string($conex, $_POST['name']);
        $last_name = mysqli_real_escape_string($conex, $_POST['last_name']);
        $cedula = mysqli_real_escape_string($conex, $_POST['cedula']);
        $address = mysqli_real_escape_string($conex, $_POST['address']);
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
        if (!$address){
            $errores [] = "Ingrese una dirección";
        }
        if (!$phone){
            $errores [] = "Ingrese un numero de telefono";
        }
       

    
     $query = " SELECT * FROM socios WHERE cedula = '" . $cedula . "' ;";
     $resultado = mysqli_query($conex, $query);
    
    //  echo '<pre>';
    //  var_dump($resultado);
    //  echo '</pre>';
    //  exit;
     if ($resultado->num_rows) {
        $errores[] = "El socio ya existe";

     }
     if (!$errores) {
       $query = "INSERT INTO socios (cedula, nombre, apellido, direccion, telefono)
        VALUES ('".$cedula."', '".$name."', '".$last_name."', '".$address."', '".$phone."') "; 

      $resultado = mysqli_query($conex, $query);
      $message = ($resultado) ?  0 : 1;
    //   header("Location: users.php?state=$message");
      header("Location: ../pag/socios.php?state=$message");
      exit;
      
    
      } else{
    return $errores;
        }
     }
}
?>


