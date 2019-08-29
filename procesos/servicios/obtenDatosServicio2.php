<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Servicios2.php";

	$obj= new servicios;

	echo json_encode($obj->obtenDatosServicio($_POST['idservicio']));

 ?>