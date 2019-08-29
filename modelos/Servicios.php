<?php
    class servicios{
        //REGISTRO DE SERVICIOS
		public function registroServicio($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="INSERT servicios (id_sitiot,
								id_tiposervicio,
								descripcion
								)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]')";
			return mysqli_query($conexion,$sql);
		}

		//OBTENER DATOS SITIOS
		public function obtenDatosServicio($idservicio){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_servicio,
						 id_tiposervicio,
						 descripcion
						 
					from servicios 
					where id_servicio='$idservicio'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_servicio' => $ver[0],
							'id_tiposervicio' => $ver[1],
							'descripcion' => $ver[2]
						);

			return $datos;
		}
		public function actualizaServicio($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE servicios set id_tiposervicio='$datos[1]',
									descripcion='$datos[2]'

						where id_servicio='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}


		public function eliminaServicio($idservicio){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from servicio
					where id_servicio='$idservicio'";
			return mysqli_query($conexion,$sql);
		}
    }
?>