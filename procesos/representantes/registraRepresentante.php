<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Representantes.php";

	$obj= new representantes();

	// $pass=sha1($_POST['password']);
	$datos=array(
		$_POST['cbx_sitioT'],
		$_POST['nombreR'],
		$_POST['cedulaR'],
        $_POST['celularR']			
				);

	echo $obj->registroRepresentante($datos);

 ?>