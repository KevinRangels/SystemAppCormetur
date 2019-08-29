<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Representantes.php";

	$obj= new representantes;

	echo json_encode($obj->obtenDatosRepresentante($_POST['idrepresentante']));

 ?>