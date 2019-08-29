<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/CargaFamiliar.php";

	$obj= new cargas;

	echo $obj->eliminaCargaF($_POST['idcargaf']);

 ?>