<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Servicios2.php";

	$obj= new servicios();

	// $pass=sha1($_POST['password']);
	$datos=array(
		$_POST['nombreSer'],
		$_POST['caracteristicasSer']	
				);

	echo $obj->registroServicio($datos);

 ?>