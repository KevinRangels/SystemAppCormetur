<?php

    require_once "../config/conexion.php";
//     $salida = "";

//     $query = "SELECT * FROM funcionarios Order By expediente";

// if(isset($_POST['consulta'])){
//     $q = $mysqli->real_scape_string($_POST['txtnom']);
//     $query = "SELECT cedula FROM funcionarios
//     WHERE cedula LIKE '%".$q."%'";
// }
// $resultado = $mysqli->query($query);
// if($resultado->num_rows > 0){
//     $salida.="<table class='table table-hover table-condensed table-bordered' style='text-align: center;'>
// 	<caption><label>Usuarios</label></caption>
// 	<tr>
// 		<td>Cedula</td>
// 		<td>Editar</td>
// 		<td>Eliminar</td>
//     </tr>";

// while($fila = $resultado->fetch_assoc()){
//     $salida.="<tr>
//               <td>".$fila[cedula]."</td>
//               </tr>";
// }

// }else{
//     $salida.="no hay datos";
// }

// echo $salida;
// $mysqli->close();

    $sql="select id_funcionario,CONCAT(nombre,'',apellido) as nombre, apellido, cedula from funcionarios";

    if($_POST["texto"] !=""){

        $sql="select id_funcionario,CONCAT(nombre,' ',apellido) as nombre, apellido, cedula
         from funcionarios
         where CONCAT(nombre,' ',apellido) LIKE '".$_POST["texto"]."%'";
    }

    $tmp="<table class='table table-hover'>
            <tr style='color:Skyblue'>
            <td>ID</td>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>Cedula</td>
            </tr>";
    $res=mysql_query($sql);
    while($row=mysql_fetch_array($res)){
        $tmp.="<tr style='color:Skyblue'>
                <td>".$row["id_funcionario"]."</td>
                <td>".$row["nombre"]."</td>
                <td>".$row["apellido"]."</td>
                <td>".$row["cedula"]."</td>
              </tr>";
    }

    $tmp.="</table>";
    echo $tmp;
?>