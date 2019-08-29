<?php 
require_once "../config/conexion.php";
$c= new conectar();
$conexion=$c->conexion();

$salida = "";

$query = "SELECT fun.expediente,
fun.nombre,
fun.apellido,
fun.cedula,
fun.edocivil,
fun.fechaN,
fun.antiguedad,
fun.direccion,
fun.telefono,
fun.fechaIngreso,
fun.cargo,
tip.tipo,
cla.clasificacion,
dep.departamento,
fun.profesion,
muni.municipio,
parro.parroquia,

fun.id_funcionario

from funcionarios as fun
-- inner join imagenes as img
-- on fun.id_imagen=img.id_imagen
inner join tipopersonal as tip
on fun.id_tipoP=tip.id_tipoP
inner join clasificacion as cla
on fun.id_clasificacion=cla.id_clasificacion
inner join departamentos as dep
on fun.id_departamento=dep.id_departamento
inner join municipio as muni
on fun.id_municipio=muni.id_municipio
inner join parroquia as parro
on fun.id_parroquia=parro.id_parroquia
Order By expediente";

if(isset($_POST['consulta'])){
    $q = $mysqli->real_escape_string($_POST['consulta']);
    $query = "SELECT fun.expediente,
    fun.nombre,
    fun.apellido,
    fun.cedula,
    fun.edocivil,
    fun.fechaN,
    fun.antiguedad,
    fun.direccion,
    fun.telefono,
    fun.fechaIngreso,
    fun.cargo,
    tip.tipo,
    cla.clasificacion,
    dep.departamento,
    fun.profesion,
    muni.municipio,
    parro.parroquia,
    
    fun.id_funcionario

from funcionarios as fun
-- inner join imagenes as img
-- on fun.id_imagen=img.id_imagen
inner join tipopersonal as tip
on fun.id_tipoP=tip.id_tipoP
inner join clasificacion as cla
on fun.id_clasificacion=cla.id_clasificacion
inner join departamentos as dep
on fun.id_departamento=dep.id_departamento
inner join municipio as muni
on fun.id_municipio=muni.id_municipio
inner join parroquia as parro
on fun.id_parroquia=parro.id_parroquia
    WHERE cedula LIKE '%".$q."%'  ";
}
$resultado = $mysqli->query($query);  
 


//SEGUNDA CONSULTA
  
  /////////////////////////////

if($resultado->num_rows > 0){
    $salida.="<table id='tablaDinamicaLoad' class='table table-hover table-condensed table-bordered text-center'>
    <thead class='text-center'>
      <tr>
      <td>Entrar</td>
      <td>Expediente</td>
      <td>Nombre</td>
      <td>Apellido</td>
      <td>Cedula</td>
      <td>Estado Civil</td>
      <td>Fecha Nacimiento</td>
      <td>Antiguedad</td>
      <td>Direccion</td>
      <td>Telefono</td>
      <td>Fecha Ingreso</td>
      <td>Cargo</td>
      <td>Tipo de Empleado</td>
      <td>Clasificacion</td>
      <td>Departamento</td>
      <td>Profesion</td>
      <td>Municipio</td>
      <td>Parroquia</td>
      
      <td>Editar</td>
      <td>Eliminar</td>	
      	
      </tr>
    </thead>
    <br>
    <tbody>";
   
// while($fila = $resultado->fetch_assoc()){
    while($ver=mysqli_fetch_row($resultado)){


    
   //$prueba = $fila['id_funcionario']; 
    // $_SESSION=$prueba;
    // $imagen = $fila['id_imagen'];

    $_SESSION=$ver[17];
    
    $salida.="<tr>
    <td>
             <a href='perfil.php?id_funcionario=$_SESSION;'><span class='btn btn-success btn-xs glyphicon glyphicon-star'></span></a>
		    </td>
              <td>$ver[0]</td>
              <td>$ver[1]</td>
              <td>$ver[2]</td>
              <td>$ver[3]</td>
              <td>$ver[4]</td>
              <td>$ver[5]</td>
              <td>$ver[6]</td>
              <td>$ver[7]</td>
              <td>$ver[8]</td>
              <td>$ver[9]</td>
              <td>$ver[10]</td>
              <td>$ver[11]</td>
              <td>$ver[12]</td>
              <td>$ver[13]</td>
              <td>$ver[14]</td>
              <td>$ver[15]</td>
              <td>$ver[16]</td>
              
		
              
        

		<td>
			<span data-toggle='modal' data-target='#actualizaFuncionarioModal' class='btn btn-warning btn-xs' onclick='agregaDatosFuncionario($ver[17])'>
				<span class='glyphicon glyphicon-pencil'></span>
			</span>
		</td>
		<td>
			<span class='btn btn-danger btn-xs' onclick='eliminarFuncionario($ver[17])'>
				<span class='glyphicon glyphicon-remove'></span>
			</span>
        </td>
        
              </tr>";
};
$salida.="</tbody></table>";

}else{
    $salida.="no hay datos";
}

    echo $salida;
    $mysqli->close();


?>
        <script>
//         $(document).ready(function() {
//     $('#tablaDinamicaLoad').DataTable();
// } );

$(document).ready(function() {
    $('#tablaDinamicaLoad').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],language:{
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
    } );
} );
        </script>

