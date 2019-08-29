<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/CargaFamiliar.php";

	$obj= new cargas();
	// $datos=array(
	// 	$datos[0]=$_POST['cbx_persona'],
	// 	$datos[1]=$_POST['cargaF'],
	// 	$datos[2]=$_POST['menores_uno'],
	// 	$datos[3]=$_POST['menores_dos'],
	// 	$datos[4]=$_POST['esposoF'],
	// 	$datos[5]=$_POST['utilesF'],
	// 	$datos[6]=$_POST['guarderiaF'],
	// 	$datos[7]=$_POST['becasF'],
	// 	$datos[8]=$_POST['juguetesF']);

	// 	echo $obj->registroCargaF($datos);
				

	// $pass=sha1($_POST['password']);
	$datos=array(
		$_POST['cbx_departamento'],
		$_POST['cbx_persona'],
		$_POST['cargaF'],
		$_POST['menores_uno'],
		$_POST['menores_dos'],
		$_POST['esposoF'],
		$_POST['utilesF'],
		$_POST['guarderiaF'],
		$_POST['becasF'],
		$_POST['juguetesF']
				);
	echo $obj->registroCargaF($datos);

 ?>