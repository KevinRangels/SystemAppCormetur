<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Actividades.php";

	$obj= new actividad;

	echo json_encode($obj->obtenDatosActividad($_POST['idactividades']));

 ?>