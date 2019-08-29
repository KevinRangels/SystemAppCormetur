<?php 

	class actividad{

		//REGISTRO DE USUARIOS
		public function registroActividad($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="INSERT into actividades (titulo,
								fecha,
								hora,
								lugar,
								descrip
								)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]',
								'$datos[3]',
								'$datos[4]')";
			return mysqli_query($conexion,$sql);
		}
		//OBTENER DATOS USUARIOS
		public function obtenDatosActividad($idactividades){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_actividades,
							titulo,
							fecha,
							hora,
                            lugar,
                            descrip
					from actividades 
					where id_actividades='$idactividades'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_actividades' => $ver[0],
							'titulo' => $ver[1],
							'fecha' => $ver[2],
                            'hora' => $ver[3],
                            'lugar' => $ver[4],
                            "descrip" => $ver[5]
						);

			return $datos;
		}

		public function actualizaActividad($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE actividades set titulo='$datos[1]',
									fecha='$datos[2]',
									hora='$datos[3]',
									lugar='$datos[4]',
									descrip='$datos[5]'

						where id_actividades='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}


		public function eliminaActividad($idactividad){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from actividades 
					where id_actividades='$idactividad'";
			return mysqli_query($conexion,$sql);
		}
    }