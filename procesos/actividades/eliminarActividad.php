<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Actividades.php";

	$obj= new actividad;

	echo $obj->eliminaActividad($_POST['idactividad']);

 ?>