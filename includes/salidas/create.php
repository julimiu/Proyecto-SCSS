<?php

$addSalida= obtener_salidas();

function obtener_salidas (){

    try {
        //1. Importar la conexion a la DB
        require __DIR__ . '/../../db/conexion.php';

        //2. Consultar la DB
        $sql = "SELECT s.*, b.matricula, b.nombre FROM salidas s INNER JOIN barcos b ON s.barcos_matricula = b.matricula;";

        //3. Ejecutar la consulta con mysqli
        $query = mysqli_query($conex, $sql);
        

        return $query;
    } catch (\Throwable $th) {
        var_dump($th); 
    }
    
}

function create_salida (){
    
     require __DIR__ . '/../../db/conexion.php';
    
     
    $errores = [];
    $date = "";
    $time = "";
    $destination = "";
    $barco = "";

    
    if (isset($_POST['agregar'])){
         
        
        $date = mysqli_real_escape_string($conex, $_POST['date']);
        $time = mysqli_real_escape_string($conex, $_POST['time']);
        $destination = mysqli_real_escape_string($conex, $_POST['destination']);
        $barco = mysqli_real_escape_string($conex, $_POST['barco']);
        
        
        if(!$date){
            $errores []= " Ingrese la fecha";
        }
        if (!$time){
            $errores [] = "Ingrese la hora";
        }
        if (!$destination){
            $errores [] = "Ingrese el destino";
        }
        if (!$barco) {
        $errores []= "Seleccione un barco";
        } else {
        $query = " SELECT * FROM barcos WHERE matricula = '".$barco."'; ";
        $resultado = mysqli_query($conex, $query);
        if (!$resultado->num_rows){
        $errores[] = "El barco no existe";
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
       $query = "INSERT INTO salidas (fecha, hora, destino, barcos_matricula)
        VALUES ('".$date."', '".$time."', '".$destination."', '".$barco."') "; 

      $resultado = mysqli_query($conex, $query);
      $message = ($resultado) ?  0 : 1;
    //   header("Location: users.php?state=$message");
      header("Location: ../pag/salidas.php?state=$message");
      exit;
      
    
      } else{
    return $errores;
        }
     }
}
?>


