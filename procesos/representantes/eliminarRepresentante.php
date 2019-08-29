<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Representantes.php";

	$obj= new representantes;

	echo $obj->eliminaRepresentante($_POST['idrepresentante']);

 ?>