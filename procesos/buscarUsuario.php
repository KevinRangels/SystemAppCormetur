<?php 
require_once "../config/conexion.php";
$c= new conectar();
$conexion=$c->conexion();

$salida = "";

$query = "SELECT id_usuario,
nombre,
apellido,
username,
password,
r.rol 
from usuarios as usu
inner join roles as r
on usu.id_rol=r.id_rol
Order By nombre";

if(isset($_POST['consulta'])){
    
    $q = $mysqli->real_escape_string($_POST['consulta']);
    $query = "SELECT id_usuario,
                     nombre,
                     apellido,
                     username,
                     password,
                     r.rol 
                     from usuarios as usu
		  inner join roles as r
		  on usu.id_rol=r.id_rol
    WHERE nombre LIKE '%".$q."%'  ";
}
$resultado = $mysqli->query($query);  
  /////////////////////////////

if($resultado->num_rows > 0){
    $salida.="<table class='table table-hover table-condensed table-bordered  text-center'>
    <caption><label>Usuarios</label></caption>
      <tr>
        <td>Nombre</td>
        <td>Apellido</td>		
        <td>Username</td>
        <td>Contraseña</td>
        <td>Tipo de Usuario</td>
        <td>Editar</td>
        <td>Eliminar</td>
        	
      </tr>
    
    ";
   
// while($fila = $resultado->fetch_assoc()){
    while($ver=mysqli_fetch_row($resultado)){
    
//   $prueba = $fila['id_usuario']; 
//     $_SESSION=$prueba;
    
    $salida.="<tr>
    
              <td>$ver[1]</td>
              <td>$ver[2]</td>
              <td>$ver[3]</td>
              <td>$ver[4]</td>
            
              <td>$ver[5]</td>
              
              <td>
			<span data-toggle='modal' data-target='#actualizaUsuarioModal' class='btn btn-warning btn-xs' onclick='agregaDatosUsuario($ver[0])'>
				<span class='glyphicon glyphicon-pencil'></span>
			</span>
		</td>
		<td>
			<span class='btn btn-danger btn-xs' onclick='eliminarUsuario($ver[0])'>
				<span class='glyphicon glyphicon-remove'></span>
			</span>
		</td'
              </tr>";
}
$salida.="</table>";

}else{
    $salida.="no hay datos";
}

    echo $salida;
    $mysqli->close();


?>
<script>

</script>