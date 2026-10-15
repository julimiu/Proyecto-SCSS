<?php
 include "../../db/conexion.php";
 

 $cedula = $_GET ['cedula'];
 $query = "DELETE FROM socios WHERE cedula = " . $cedula . ";";
 $resultado = mysqli_query($conex, $query);
//  var_dump($resultado);
//  foreach ( $resultado as $data) {
//     var_dump($data);
//  }

$state = ($resultado) ? 4 : 5 ;
header ("Location: ../../pag/socios.php?state=$state");
exit;