<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Servicios2.php";

	$obj= new servicios;

	$datos=array(
			$_POST['idServicio'],  
		    $_POST['nombreSerU'], 
			$_POST['caracteristicasSerU']
	
				);  
	echo $obj->actualizaServicio($datos);


 ?>