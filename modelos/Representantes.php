<?php
    class representantes{
        //REGISTRO DE REPRESENTANTES
		public function registroRepresentante($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="INSERT representante(id_sitiot,
								nombre_r,
								cedula_r,
								celular_r
								)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]',	
								'$datos[3]')";
			return mysqli_query($conexion,$sql);
		}

		//OBTENER DATOS SITIOS
		public function obtenDatosRepresentante($idrepresentante){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_representante,
						 nombre_r,
						 cedula_r,
						 celular_r
					from representante 
					where id_representante='$idrepresentante'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_representante' => $ver[0],
							'nombre_r' => $ver[1],
							'cedula_r' => $ver[2],
                            'celular_r' => $ver[3]
						);

			return $datos;
		}
		public function actualizaRepresentante($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE representante set nombre_r='$datos[1]',
									cedula_r='$datos[2]',
									celular_r='$datos[3]'

						where id_representante='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}


		public function eliminaRepresentante($idrepresentante){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from representante 
					where id_representante='$idrepresentante'";
			return mysqli_query($conexion,$sql);
		}
    }
?>