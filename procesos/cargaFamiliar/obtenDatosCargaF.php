<?php 
	require_once "../../config/conexion.php";
	require_once "../../modelos/CargaFamiliar.php";

	$obj= new cargas;

	echo json_encode($obj->obtenDatosCargaF($_POST['idcargaf']));
 ?>