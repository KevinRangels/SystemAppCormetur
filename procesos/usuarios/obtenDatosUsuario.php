<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Usuarios.php";

	$obj= new usuarios;

	echo json_encode($obj->obtenDatosUsuario($_POST['idusuario']));

 ?>