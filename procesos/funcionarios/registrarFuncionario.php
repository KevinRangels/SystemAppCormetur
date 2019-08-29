<?php 

	require_once "../../config/conexion.php";
	require_once "../../modelos/Funcionarios.php";

	$obj= new funcionarios();

	$datos=array();

	$nombreImg=$_FILES['imagen']['name'];
	$rutaAlmacenamiento=$_FILES['imagen']['tmp_name'];
	$carpeta='../../archivos/';
	$rutaFinal=$carpeta.$nombreImg;
	$fecha=$_POST['fechaF'];
	$fechaN=$_POST['fechaN'];

	$datosImg=array(
		$nombreImg,
		$rutaFinal
					);
		if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
			$idimagen=$obj->agregaImagen($datosImg);
		
			if($idimagen > 0){
		
				$datos[0]=$_POST['expedienteF'];
				$datos[1]=$idimagen;
				$datos[2]=$_POST['nombreF'];
				$datos[3]=$_POST['apellidoF'];
				$datos[4]=$_POST['cedulaF'];
				$datos[5]=$_POST['estadocF'];
				$datos[6]=$_POST['fechaN'];
				$datos[7]=$_POST['antiguedad'];
				$datos[8]=$_POST['direccionF'];
				$datos[9]=$_POST['telefonoF'];
				$datos[10]=$_POST['fechaF'];
				$datos[11]=$_POST['cargoF'];
				$datos[12]=$_POST['tipoF'];
				
				$datos[13]=$_POST['clasificacionF'];
				$datos[14]=$_POST['departamentoF'];
				$datos[15]=$_POST['profesionF'];
				$datos[16]=$_POST['cbx_municipio'];
				$datos[17]=$_POST['cbx_parroquia'];
				
				echo $obj->registroFuncionario($datos);
			}else{
				echo 0;
			}
	}
	
 ?>