<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Usuarios.php";

	$obj= new usuarios;

	echo $obj->eliminaUsuario($_POST['idusuario']);

 ?>