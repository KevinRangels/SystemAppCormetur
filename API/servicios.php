<?php

header('Content-Type: application/json'); //Transforma el archivo php 
                                            //en un formato json
                                            
header('Access-Control-Allow-Origin: *'); //Puede acceder cualquiera

if($_GET['moneda']== 'servicios'){
    include_once 'conexion.php';
    
    $sql = 'SELECT * FROM servicios';
    
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $datos = $sentencia->fetchAll();
    }
    echo  json_encode($datos);
 



?>