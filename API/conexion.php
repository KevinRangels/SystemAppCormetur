<?php

$link = 'mysql:host=localhost;dbname=cormetur';
$usuario = 'root';
$pass = '';
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") ;


try{
    $pdo = new PDO($link,$usuario,$pass);
    $pdo->exec("set names utf8");


    // echo 'Conectado';


}catch (PDOException $e){
    print "ERROR : " . $e->getMessage() . "<br/>";
    die();
}

?>