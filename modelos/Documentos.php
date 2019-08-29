<?php 

	class documentos{
		// REGISTRO IMAGENES
		public function agregaImagen($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$fecha=date('Y-m-d');

			$sql="INSERT into cedulas (nombre,
										ruta,
										fechaSubida)
							values (
									'$datos[0]',
									'$datos[1]',
									'$fecha')";
			$result=mysqli_query($conexion,$sql);

			return mysqli_insert_id($conexion);
		}
		
		
		public function obtenIdImg($idFuncionario){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_cedula 
					from documentos 
					where id_documento='$idFuncionario'";
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obtenRutaImagen($idImg){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT ruta 
					from cedulas 
					where id_cedula='$idImg'";

			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}
		
		public function registroDocumento($datos){
			$c=new conectar();
			$conexion=$c->conexion();
			$fecha=date('Y-m-d');
			$sql="INSERT into documentos ( id_departamento,
										   id_funcionario,
								           id_cedula
										   )
								  values ('$datos[0]',
										 '$datos[1]',
										 '$datos[2]')";
			return mysqli_query($conexion,$sql);
		}	


		// partida Nacimiento
		// public function agregaPartidaN($datos){
		// 	$c=new conectar();
		// 	$conexion=$c->conexion();

		// 	$fecha=date('Y-m-d');

		// 	$sql="INSERT into partidasn (nombre,
		// 								ruta,
		// 								fechaSubida)
		// 					values (
		// 							'$datos[0]',
		// 							'$datos[1]',
		// 							'$fecha')";
		// 	$result=mysqli_query($conexion,$sql);

		// 	return mysqli_insert_id($conexion);
		// }
		// public function obtenIdPartidaN($idFuncionario){
		// 	$c= new conectar();
		// 	$conexion=$c->conexion();

		// 	$sql="SELECT id_partidasn
		// 			from funcionarios 
		// 			where id_funcionario='$idFuncionario'";
		// 	$result=mysqli_query($conexion,$sql);

		// 	return mysqli_fetch_row($result)[0];
		// }
		// public function obtenRutaPartidaN($idImg){
		// 	$c= new conectar();
		// 	$conexion=$c->conexion();

		// 	$sql="SELECT ruta 
		// 			from partidasn 
		// 			where id_partidasn='$idImg'";

		// 	$result=mysqli_query($conexion,$sql);

		// 	return mysqli_fetch_row($result)[0];
		// }
		// public function registroPartida($datos){
		// 	$c=new conectar();
		// 	$conexion=$c->conexion();
		// 	$fecha=date('Y-m-d');
		// 	$sql="UPDATE into funcionarios set id_departamento='$datos[0]',
											   
		// 								   id_partidasn='$datos[2]'
		// 								   where id_funcionario='$datos[1]'
		// 								   ";
		// 	return mysqli_query($conexion,$sql);
		// }

	
	}
		

        ?>