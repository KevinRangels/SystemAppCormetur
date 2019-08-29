<?php 
	require_once "../../config/conexion.php";
	require_once "../../modelos/CargaFamiliar.php";

	$obj= new cargas;

	$datos=array(
			$_POST['idCargaF'],  
		    $_POST['cargaFU'], 
		    $_POST['menores_unoU'],  
			$_POST['menores_dosU'],
			$_POST['esposoFU'],
			$_POST['utilesFU'],
			$_POST['guarderiaFU'],
			$_POST['becasFU'],
			$_POST['juguetesFU']
			
				);  
	echo $obj->actualizaCargaF($datos);


 ?>