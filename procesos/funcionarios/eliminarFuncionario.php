<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Funcionarios.php";

	$obj= new funcionarios;

	echo $obj->eliminaFuncionario($_POST['idfuncionario']);

 ?>