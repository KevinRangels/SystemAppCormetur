<?php 

	class usuarios{

		//REGISTRO DE USUARIOS
		public function registroUsuario($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="INSERT into usuarios (nombre,
								apellido,
								username,
								password,
								id_rol
								)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]',
								'$datos[3]',
								'$datos[4]')";
			return mysqli_query($conexion,$sql);
		}
		//OBTENER DATOS USUARIOS
		public function obtenDatosUsuario($idusuario){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_usuario,
							nombre,
							apellido,
							username,
                            password,
                            id_rol
					from usuarios 
					where id_usuario='$idusuario'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_usuario' => $ver[0],
							'nombre' => $ver[1],
							'apellido' => $ver[2],
                            'username' => $ver[3],
                            'password' => $ver[4],
                            "id_rol" => $ver[5]
						);

			return $datos;
		}

		public function actualizaUsuario($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE usuarios set nombre='$datos[1]',
									apellido='$datos[2]',
									username='$datos[3]',
									password='$datos[4]',
									id_rol='$datos[5]'

						where id_usuario='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}


		public function eliminaUsuario($idusuario){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from usuarios 
					where id_usuario='$idusuario'";
			return mysqli_query($conexion,$sql);
		}
    }