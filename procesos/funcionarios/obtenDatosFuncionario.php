<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Funcionarios.php";

	$obj= new funcionarios;

	echo json_encode($obj->obtenDatosFuncionario($_POST['idfuncionario']));

 ?>