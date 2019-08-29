<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Servicios.php";

	$obj= new servicios;

	$datos=array(
			$_POST['idServicio'],  
		    $_POST['tipoSU'] , 
			$_POST['descripcionSU']
	
				);  
	echo $obj->actualizaServicio($datos);


 ?>