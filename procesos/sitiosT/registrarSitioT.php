<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/SitiosT.php";

	$obj= new sitios();

	// $pass=sha1($_POST['password']);
	$datos=array(
		$_POST['nombreS'],
		$_POST['direccionS'],
		$_POST['telefonoS'],
        $_POST['correoS'],
        $_POST['paginaS'],
        $_POST['rifS'],
        $_POST['cbx_municipio'],
		$_POST['cbx_parroquia'],
		$_POST['tipoS'],
		$_POST['caracteristicas']


			
				);

	echo $obj->registroSitio($datos);

 ?>