<?php
    class sitios{
        //REGISTRO DE SITIOS TURISTICOS
		public function registroSitio($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="INSERT sitiost(nombre_s,
								direccion_s,
								telefono_s,
								correo_s,
								paginaw_s,
                                rif_s,
                                id_municipio,
                                id_parroquia,
								id_servicio,
								descrip
								)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]',
								'$datos[3]',
                                '$datos[4]',
                                '$datos[5]',
                                '$datos[6]',
								'$datos[7]',
								'$datos[8]',
								'$datos[9]')";
			return mysqli_query($conexion,$sql);
		}

		//OBTENER DATOS SITIOS
		public function obtenDatosSitio($idsitiot){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_sitiot,
						 nombre_s,
						 direccion_s,
						 telefono_s,
						 correo_s,
						 paginaw_s,
						 rif_s,
						 id_servicio,
						 descrip
					from sitiost 
					where id_sitiot='$idsitiot'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_sitiot' => $ver[0],
							'nombre_s' => $ver[1],
							'direccion_s' => $ver[2],
                            'telefono_s' => $ver[3],
                            'correo_s' => $ver[4],
							"paginaw_s" => $ver[5],
							"rif_s" => $ver[6],
							"id_servicio" => $ver[7],
							"descrip" => $ver[8]

						);

			return $datos;
		}
		public function actualizaSitio($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE sitiost set nombre_s='$datos[1]',
									direccion_s='$datos[2]',
									telefono_s='$datos[3]',
									correo_s='$datos[4]',
									paginaw_s='$datos[5]',
									rif_s='$datos[6]',
									descrip='$datos[7]'


						where id_sitiot='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}


		public function eliminaSitio($idsitio){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from sitiost 
					where id_sitiot='$idsitio'";
			return mysqli_query($conexion,$sql);
		}
    }
?>