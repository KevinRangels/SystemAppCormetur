<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Representantes.php";

	$obj= new representantes;

	$datos=array(
			$_POST['idRepresentante'],  
		    $_POST['nombreRU'] , 
		    $_POST['cedulaRU'],  
			$_POST['celularRU']
	
				);  
	echo $obj->actualizaRepresentante($datos);


 ?>