
<?php
    header("Content-Type: text/html;charset=utf-8");
	require_once "../config/conexion.php";
	
	$id_parroquia = $_POST['id_parroquia'];
	
	$queryM = "SELECT id_sitiot, nombre_s FROM sitiost WHERE id_parroquia = '$id_parroquia' ORDER BY nombre_s";
	$resultadoM = $mysqli->query($queryM);

	$resultadoF = $mysqli->query($queryM);
	
	$html= "<option value='0'>Seleccionar Sitio Turistico</option>";
	
	
	while($rowF = $resultadoF->fetch_assoc())
	{
		$html2.= "<option value='".$rowF['id_sitiot']."'>".$rowF['nombre_s']."</option>";
	}
	
	echo $html2;

	
?>