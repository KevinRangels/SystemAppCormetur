<?php 
require_once "../config/conexion.php";
$c= new conectar();
$conexion=$c->conexion();

$salida = "";

$query = "SELECT sit.nombre_s,
                 sit.direccion_s,
                 sit.telefono_s,
                 sit.correo_s,
                 sit.paginaw_s,
                 sit.rif_s,
                 muni.municipio,
                 parro.parroquia,
                 serv.nombre,
                 sit.descrip,
                 sit.id_sitiot,
                 img.nombre

                from sitiost as sit
                inner join municipio as muni
                on sit.id_municipio=muni.id_municipio
                inner join parroquia as parro
                on sit.id_parroquia=parro.id_parroquia
                inner join servicio as serv
                on sit.id_servicio=serv.id_servicio
                inner join imagenes as img
		        on sit.id_imagen=img.id_imagen
                Order By nombre_s";
                $resultado = $mysqli->query($query); 

 


//SEGUNDA CONSULTA
  
  /////////////////////////////

if($resultado->num_rows > 0){
    $salida.="<table id='tablaDinamicaLoad' class='table table-hover table-condensed table-bordered text-center'>
    <thead class='text-center'>
      <tr>
      <td>Nombre</td>
      <td>Direccion</td>
      <td>Telefono</td>
      <td>Correo</td>
      <td>Pagina Web</td>
      <td>RIF</td>
      <td>Municipio</td>
      <td>Parroquia</td>
      <td>Servicio</td>
      <td>Descripcion</td>
      <td>FOTO</td>
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

    // $_SESSION=$ver[10];
    
    $salida.="<tr>
    
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
              <td>
              <img  width='80' height='80' src='http://localhost/CORMETUR/archivos/user_images/$ver[11]'>
             



    
                  

		<td>
			<span data-toggle='modal' data-target='#actualizaSitioModal' class='btn btn-warning btn-xs' onclick='agregaDatosSitio($ver[10])'>
				<span class='glyphicon glyphicon-pencil'></span>
			</span>
		</td>
		<td>
			<span class='btn btn-danger btn-xs' onclick='eliminarSitio($ver[10])'>
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

