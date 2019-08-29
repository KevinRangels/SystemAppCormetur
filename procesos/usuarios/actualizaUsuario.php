<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Usuarios.php";

	$obj= new usuarios;

	$datos=array(
			$_POST['idUsuario'],  
		    $_POST['nombreU'] , 
		    $_POST['apellidoU'],  
			$_POST['usuarioU'],
			$_POST['passwordU'],
			$_POST['rolUsuarioU']
	
				);  
	echo $obj->actualizaUsuario($datos);


 ?>