<?php 
require_once "../config/conexion.php";
$c= new conectar();
$conexion=$c->conexion();

$salida = "";

$query = "SELECT sit.nombre_s,
                 rep.nombre_r,
                 rep.cedula_r,
                 rep.celular_r,
                 rep.id_representante
from representante as rep
inner join sitiost as sit
on rep.id_sitiot=sit.id_sitiot
Order By nombre_r";
$resultado = $mysqli->query($query); 

 


//SEGUNDA CONSULTA
  
  /////////////////////////////

if($resultado->num_rows > 0){
    $salida.="<table id='tablaDinamicaLoad' class='table table-hover table-condensed table-bordered text-center'>
    <thead class='text-center'>
      <tr>
      <td>Sitio Turistico</td>
      <td>Nombre</td>
      <td>Cedula</td>
      <td>Celular</td>
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

    $_SESSION=$ver[4];
    
    $salida.="<tr>
    
              <td>$ver[0]</td>
              <td>$ver[1]</td>
              <td>$ver[2]</td>
              <td>$ver[3]</td>
		<td>
			<span data-toggle='modal' data-target='#actualizaRepresentanteModal' class='btn btn-warning btn-xs' onclick='agregaDatosRepresentante($ver[4])'>
				<span class='glyphicon glyphicon-pencil'></span>
			</span>
		</td>
		<td>
			<span class='btn btn-danger btn-xs' onclick='eliminarRepresentante($ver[4])'>
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
