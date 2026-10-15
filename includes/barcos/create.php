<?php

$addBarco= obtener_barcos();

function obtener_barcos (){

    try {
        //1. Importar la conexion a la DB
        require __DIR__ . '/../../db/conexion.php';

        //2. Consultar la DB
        $sql = "SELECT b.*, s.nombre as 'socio_nombre' FROM barcos b INNER JOIN socios s ON b.cedula_socio = s.cedula;";

        //3. Ejecutar la consulta con mysqli
        $query = mysqli_query($conex, $sql);

        return $query;
    } catch (\Throwable $th) {
        var_dump($th); 
    }
    
}

function create_barco (){
    
     require __DIR__ . '/../../db/conexion.php';
    
     
    $errores = [];
    $license = "";
    $name = "";
    $number = "";
    $payment = "";
    $socio = "";

    
    if (isset($_POST['agregar'])){
         
        
        $license = mysqli_real_escape_string($conex, $_POST['license']);
        $name = mysqli_real_escape_string($conex, $_POST['name']);
        $number = mysqli_real_escape_string($conex, $_POST['number']);
        $payment = mysqli_real_escape_string($conex, $_POST['payment']);
        $socio = mysqli_real_escape_string($conex,$_POST['socio']);
        
        
        if(!$license){
            $errores []= " Ingrese la matricula";
        }
        if (!$name){
            $errores [] = "Ingrese un nombre";
        }
        if (!$number){
            $errores [] = "Ingrese un número de amarre";
        }
        if (!ctype_digit($number)){
            $errores [] = "El campo del amarre debe ser numerico";
        }
        if (!$payment){
            $errores [] = "Ingrese una cuota de amarre";
        }
        if (!ctype_digit($payment)){
            $errores [] = "El campo de la cuota debe ser numerico";
        }
        if (!$socio) {
        $errores []= "Seleccione un socio";
        } else {
        $query = " SELECT * FROM socios WHERE cedula = '".$socio."'; ";
        $resultado = mysqli_query($conex, $query);
        if (!$resultado->num_rows){
        $errores[] = "El socio no existe";
        }
        }
       
    
    //  $query = " SELECT * FROM barcos WHERE matricula = '" . $license . "' ;";
    //  $resultado = mysqli_query($conex, $query);
    
    //  echo '<pre>';
    //  var_dump($resultado);
    //  echo '</pre>';
    //  exit;
    //  if ($resultado->num_rows) {
    //     $errores[] = "El barco ya existe";
    //     }

     if (!$errores) {
       $query = "INSERT INTO barcos (matricula, nombre, n_amarre, cuota_amarre, cedula_socio)
        VALUES ('".$license."', '".$name."', '".$number."', '".$payment."', '".$socio."') "; 

      $resultado = mysqli_query($conex, $query);
      $message = ($resultado) ?  0 : 1;
    //   header("Location: users.php?state=$message");
      header("Location: ../pag/barcos.php?state=$message");
      exit;
      
    
      } else{
    return $errores;
        }
     }
}
?>


