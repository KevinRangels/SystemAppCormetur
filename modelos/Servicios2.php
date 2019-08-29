<?php
    class servicios{
        //REGISTRO DE SERVICIOS
		public function registroServicio($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="INSERT servicio (nombre,
								caracteristicas
								)
						values ('$datos[0]',
								'$datos[1]')";
			return mysqli_query($conexion,$sql);
		}

		//OBTENER DATOS SITIOS
		public function obtenDatosServicio($idservicio){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_servicio,
						 nombre,
						 caracteristicas
						 
					from servicio 
					where id_servicio='$idservicio'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_servicio' => $ver[0],
							'nombre' => $ver[1],
							'caracteristicas' => $ver[2]
						);

			return $datos;
		}
		public function actualizaServicio($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE servicio set nombre='$datos[1]',
									caracteristicas='$datos[2]'

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