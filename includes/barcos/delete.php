<?php
 include "../../db/conexion.php";
 
// $license = mysqli_real_escape_string($conex, $_GET['matricula']);
 $license = $_GET ['matricula'];
 $query = "DELETE FROM barcos WHERE matricula = '" . $license . "';";

//  var_dump($query);
//  exit;
 $resultado = mysqli_query($conex, $query);
//  var_dump($resultado);
//  foreach ( $resultado as $data) {
//     var_dump($data);
//  }

$state = ($resultado) ? 4 : 5 ;
header ("Location: ../../pag/barcos.php?state=$state");
exit;