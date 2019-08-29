<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Actividades.php";

	$obj= new actividad();

	// $pass=sha1($_POST['password']);
	$datos=array(
		$_POST['act_titulo'],
		$_POST['act_fecha'],
		$_POST['act_hora'],
		$_POST['act_lugar'],
		$_POST['act_descrip']
			
				);

	echo $obj->registroActividad($datos);

 ?>