<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/SitiosT.php";

	$obj= new sitios;

	echo json_encode($obj->obtenDatosSitio($_POST['idsitiot']));

 ?>