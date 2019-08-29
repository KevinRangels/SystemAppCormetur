<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Actividades.php";

	$obj= new actividad;

	$datos=array(
			$_POST['idActividad'],  
		    $_POST['act_tituloU'] , 
		    $_POST['act_fechaU'],  
			$_POST['act_horaU'],
			$_POST['act_lugarU'],
			$_POST['act_descripU']
	
				);  
	echo $obj->actualizaActividad($datos);


 ?>