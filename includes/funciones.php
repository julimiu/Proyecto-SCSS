<?php

function validarSession (){
    session_start();
    if (!isset($_SESSION['nombre'])) {
        header ("Location: ../login.php");
    }
}

function debug($arg){
    echo "<pre>";
    var_dump ($arg);
    echo "<pre>";
    exit;
}




// $idUser = $_GET['id'];
// $errores = [];
  
// $query = "SELECT * FROM usuarios"