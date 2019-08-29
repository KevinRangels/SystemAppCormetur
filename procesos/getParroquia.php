
<?php
    header("Content-Type: text/html;charset=utf-8");
	require_once "../config/conexion.php";
	
	$id_municipio = $_POST['id_municipio'];
	
	$queryM = "SELECT id_parroquia, parroquia FROM parroquia WHERE id_municipio = '$id_municipio' ORDER BY parroquia";
	$resultadoM = $mysqli->query($queryM);
	
	$html= "<option value='0'>Seleccionar Parroquia</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['id_parroquia']."'>".$rowM['parroquia']."</option>";
	}
	
	echo $html;

	
?>