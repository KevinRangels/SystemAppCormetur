<?php

require_once "../../config/conexion.php";
	$c= new conectar();
    $conexion=$c->conexion();
    
    
    $id = $_REQUEST['id'];
	
	$query = "DELETE FROM cedulahijos WHERE id_cedulah = '$id'";
	$resultado = $conexion->query($query);
	
	if($resultado){
        $url = $_SERVER['HTTP_REFERER'];
		header("LOCATION:$url");
	}else{
		echo "no se elimino";
	}
?>