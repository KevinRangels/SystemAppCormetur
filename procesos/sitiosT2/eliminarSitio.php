<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/SitiosT.php";

	$obj= new sitios;

	echo $obj->eliminaSitio($_POST['idsitio']);

 ?>