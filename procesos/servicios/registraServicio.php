<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Servicios.php";

	$obj= new servicios();

	// $pass=sha1($_POST['password']);
	$datos=array(
		$_POST['cbx_sitioT'],
		$_POST['tipoS'],
		$_POST['descripcionS']		
				);

	echo $obj->registroServicio($datos);

 ?>