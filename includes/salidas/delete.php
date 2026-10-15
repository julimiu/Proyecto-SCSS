<?php
 include "../../db/conexion.php";
 
// $license = mysqli_real_escape_string($conex, $_GET['matricula']);
 $idSalida = $_GET ['id'];
 $query = "DELETE FROM salidas WHERE id_salida = " . $idSalida . ";";

//  var_dump($query);
//  exit;
 $resultado = mysqli_query($conex, $query);
//  var_dump($resultado);
//  foreach ( $resultado as $data) {
//     var_dump($data);
//  }

$state = ($resultado) ? 4 : 5 ;
header ("Location: ../../pag/salidas.php?state=$state");
exit;