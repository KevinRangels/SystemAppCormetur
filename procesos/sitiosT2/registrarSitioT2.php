<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/SitiosT2.php";

	$obj= new sitios();

	// $pass=sha1($_POST['password']);
	$datos=array();

	$nombreImg=$_FILES['imagen']['name'];
	$rutaAlmacenamiento=$_FILES['imagen']['tmp_name'];
	$carpeta='../../archivos/user_images/';
	$rutaFinal=$carpeta.$nombreImg;

	$datosImg=array(
		$_POST['tipoS'],
		$nombreImg,
		$rutaFinal
	);
	if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
		$idimagen=$obj->agregaImagen($datosImg);
		if($idimagen > 0){
			$datos[0]=$_POST['tipoS'];
			$datos[1]=$idimagen;
			$datos[2]=$_POST['nombreS'];
			$datos[3]=$_POST['direccionS'];
			$datos[4]=$_POST['telefonoS'];
			$datos[5]=$_POST['correoS'];
			$datos[6]=$_POST['paginaS'];
			$datos[7]=$_POST['rifS'];
			$datos[8]=$_POST['cbx_municipio'];
			$datos[9]=$_POST['cbx_parroquia'];
			$datos[10]=$_POST['caracteristicas'];
			echo $obj->registroSitio($datos);
		}else{
			echo 0;
		}
	}
 ?>