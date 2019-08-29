<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Funcionarios.php";

	$obj= new funcionarios;

	$datos=array(
			$_POST['idFuncionario'],  
		    $_POST['expedienteFU'], 
		    $_POST['nombreFU'],  
			$_POST['apellidoFU'],
			$_POST['cedulaFU'],
			$_POST['estadocFU'],
			$_POST['fechaNU'],
			$_POST['antiguedadU'],
			$_POST['direccionFU'],
			$_POST['telefonoFU'],
			$_POST['fechaFU'],
			$_POST['cargoFU'],
			$_POST['tipoFU'],
			$_POST['clasificacionFU'],
			$_POST['departamentoFU'],
			$_POST['profesionFU']
			
			
				);  
	echo $obj->actualizaFuncionario($datos);


 ?>