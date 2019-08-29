<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Funcionarios.php";

	$obj= new funcionarios();

	$datos=array(
		$_POST['expedienteF'],
		$_POST['nombreF'],
		$_POST['apellidoF'],
		$_POST['cedulaF'],
		$_POST['estadocF'],
		$_POST['fechaN'],
		$_POST['antiguedad'],
		$_POST['direccionF'],
		$_POST['telefonoF'],
        $_POST['fechaF'],
        $_POST['cargoF'],
        $_POST['tipoF'],
        $_POST['clasificacionF'],
        $_POST['departamentoF'],
        $_POST['profesionF'],
        $_POST['cbx_municipio'],
        $_POST['cbx_parroquia']
				);
	echo $obj->registroFuncionarioP($datos);

	
		
		
	
 ?>