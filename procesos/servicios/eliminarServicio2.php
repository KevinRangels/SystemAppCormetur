<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Servicios.php";

	$obj= new servicios;

	echo $obj->eliminaServicio($_POST['idservicio']);

 ?>