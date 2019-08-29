<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Usuarios.php";

	$obj= new usuarios();

	// $pass=sha1($_POST['password']);
	$datos=array(
		$_POST['nombre'],
		$_POST['apellido'],
		$_POST['username'],
		$_POST['password'],
		$_POST['rolUsuario']
			
				);

	echo $obj->registroUsuario($datos);

 ?>