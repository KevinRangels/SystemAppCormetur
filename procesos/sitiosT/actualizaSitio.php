<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/SitiosT.php";

	$obj= new sitios;

	$datos=array(
			$_POST['idSitio'],  
		    $_POST['nombreSU'] , 
		    $_POST['direccionSU'],  
			$_POST['telefonoSU'],
			$_POST['correoSU'],
            $_POST['paginaSU'],
			$_POST['rifSU'],
			$_POST['caracteristicasU']

	
				);  
	echo $obj->actualizaSitio($datos);


 ?>