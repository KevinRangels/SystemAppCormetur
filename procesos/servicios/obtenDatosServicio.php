<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Servicios.php";

	$obj= new servicios;

	echo json_encode($obj->obtenDatosServicio($_POST['idservicio']));

 ?>