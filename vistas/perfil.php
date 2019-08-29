<?php
    session_start();
    
    if(!isset($_SESSION['rol'])){
        header('location: ../index.php');
    }else{
        if($_SESSION['rol'] != 1 and 2){
            header('location: ../index.php');
        }
    }
  require_once("menu.php");
  
  require_once "../config/conexion.php";
	$c= new conectar();
    $conexion=$c->conexion();
    (isset($_GET['id_funcionario']));
        // $query = $mysqli->query("SELECT * FROM funcionarios WHERE id_funcionario =  '".$_GET['id_funcionario']."'");
        // $row = $query->fetch_array();
        $sql="SELECT fun.expediente,
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
        img.ruta,
        fun.id_funcionario
from funcionarios as fun
inner join imagenes as img
on fun.id_imagen=img.id_imagen
-- inner join documentos as doc
-- on fun.id_documento=doc.id_documento
-- inner join cedulas as ced
-- on ced.id_cedula=doc.id_documento
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
WHERE id_funcionario = '".$_GET['id_funcionario']."'";
$result=mysqli_query($conexion,$sql);

// CONSULTA DE CARGAS FAMILIARES
$sql1="SELECT fami.cargaF,
                fami.menores_uno,
                fami.menores_dos,
                fami.esposo,
                fami.beneficioUtiles,
                fami.guarderia,
                fami.becas,
                fami.juquetes,
                fami.id_cargaFamilia
                from cargafamilia as fami
                WHERE id_funcionario = '".$_GET['id_funcionario']."'";
$result1=mysqli_query($conexion,$sql1);

     // CONSULTA PARA OBTENER FOTO
$doc0="SELECT id_funcionario,
userPic,
id_foto
from foto
WHERE id_funcionario = '".$_GET['id_funcionario']."'";
$documento0=mysqli_query($conexion,$doc0);

// CONSULTA PARA OBTENER CEDULA
$doc1="SELECT id_funcionario,
              userPic,
              id_cedula
              from cedulas
WHERE id_funcionario = '".$_GET['id_funcionario']."'";
$documento1=mysqli_query($conexion,$doc1);

    // CONSULTA PARA OBTENER PARTIDA DE NACIMIENTO
$doc2="SELECT id_funcionario,
              userPic,
              id_partidasn
              from partidasn
WHERE id_funcionario = '".$_GET['id_funcionario']."'";
$documento2=mysqli_query($conexion,$doc2);

// CONSULTA PARA OBTENER ACTA DE MATRIMONIO
$doc3="SELECT id_funcionario,
              userPic,
              id_actaM
              from actam
WHERE id_funcionario = '".$_GET['id_funcionario']."'";
$documento3=mysqli_query($conexion,$doc3);

// CONSULTA PARA OBTENER CEDULA DE LOS HIJOS
$doc4="SELECT id_funcionario,
              userPic,
              id_cedulah
              from cedulahijos
WHERE id_funcionario = '".$_GET['id_funcionario']."'";
$documento4=mysqli_query($conexion,$doc4);

// CONSULTA PARA OBTENER CONSTANCIA DE ESTUDIO
$doc5="SELECT id_funcionario,
              userPic,
              id_constanciae
              from constanciae
WHERE id_funcionario = '".$_GET['id_funcionario']."'";
$documento5=mysqli_query($conexion,$doc5);

// CONSULTA PARA OBTENER CONSTANCIA DE SOLTERIA
$doc6="SELECT id_funcionario,
              userPic,
              id_constanciasol
              from constanciasol
WHERE id_funcionario = '".$_GET['id_funcionario']."'";
$documento6=mysqli_query($conexion,$doc6);

// CONSULTA PARA OBTENER CURRICULO VITAE
$doc7="SELECT id_funcionario,
              userPic,
              id_curriculum
              from curriculum
WHERE id_funcionario = '".$_GET['id_funcionario']."'";
$documento7=mysqli_query($conexion,$doc7);

// CONSULTA PARA OBTENER FONDO NEGRO
$doc8="SELECT id_funcionario,
              userPic,
              id_fondonegro
              from fondonegro
WHERE id_funcionario = '".$_GET['id_funcionario']."'";
$documento8=mysqli_query($conexion,$doc8);

?>



  <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->

	<div>
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                   
                    <?php while($ver=mysqli_fetch_row($result)): ?>

                    <div class="row">
                    <div class="col-md-3">
                    <div class="card-foto">
                        <h4>FOTO</h4>
                        <?php while($doc0=mysqli_fetch_row($documento0)): ?>
                        <img src="../archivos/fotos/<?php echo $doc0[1]; ?>" class="img-fluid" height="200" style="width:100%; alt="...">
                        <a href="../archivos/fotos/<?php echo $doc0[1]; ?>" class="btn btn-primary">Ver </a>
                        <a class="btn btn-danger" href="../procesos/documentos/eliminarFoto.php?id=<?php echo $doc0[2];?>">Eliminar</a>
                        
                        <?php endwhile; ?>    
                    </div>
                    </div>
                    <div class="col-md-3">
                    <h4 style="color:blue;">Nro de Expediente :<p style="color:black;"><?php echo $ver[0];?></p></h4>
                    <h4 style="color:blue;">Nombres : <p style="color:black;"><?php echo $ver[1];?></p></h4>
                    <h4 style="color:blue;">Apellidos : <p style="color:black;"><?php echo $ver[2];?></p></h4>
                    <h4 style="color:blue;">Cedula : <p style="color:black;"><?php echo $ver[3];?></p></h4>
                    
                    </div>
                    <div class="col-md-3">
                    <h4 style="color:blue;">Estado Civil :<p style="color:black;"><?php echo $ver[4];?></p></h4>
                    <h4 style="color:blue;">Profesion : <p style="color:black;"><?php echo $ver[14];?></p></h4>
                    <h4 style="color:blue;">Antiguedad : <p style="color:black;"><?php echo $ver[6];?> años</p></h4>
                    <h4 style="color:blue;">Fecha de Ingrego : <p style="color:black;"><?php echo $ver[5];?></p></h4>
                    </div>
                    <div class="col-md-3">
                    <h4 style="color:blue;">Cargo :<p style="color:black;"><?php echo $ver[10];?></p></h4>
                    <h4 style="color:blue;">Tipo de empleado : <p style="color:black;"><?php echo $ver[11];?></p></h4>
                    <h4 style="color:blue;">Clasificacion : <p style="color:black;"><?php echo $ver[12];?></p></h4>
                    <h4 style="color:blue;">Departamento : <p style="color:black;"><?php echo $ver[13];?></p></h4>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container">
                             <h3>Dirección</h3>
                            </div>
                         </div>
                    </div>
                    <div class="row">
                    <br>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-3">
                    <h4 style="color:blue;">Municipio : <p style="color:black;"><?php echo $ver[15];?></p></h4>
                    </div>
                    <div class="col-md-4">
                    <h4 style="color:blue;">Parroquia : <p style="color:black;"><?php echo $ver[16];?></p></h4>
                    </div>
                    <div class="col-md-3">
                    <h4 style="color:blue;">Direccion : <p style="color:black;"><?php echo $ver[7];?></p></h4>
                    </div>
                    </div>
                    <?php endwhile; ?>  <!-- FIN DEL WHILE 1 -->
                    <?php while($ver1=mysqli_fetch_row($result1)): ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="container">
                             <h3>Cargas Familiares</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                    <div class="col-md-3 ">
                    <h4 style="color:blue;  margin-bottom:50px;">Cargas Familiares <p style="color:black;"><?php echo $ver1[0];?></p></h4>
                    <h4 style="color:blue;">Hijos menores de 18 años <p style="color:black;"><?php echo $ver1[1];?></p></h4>
                    </div>
                    <div class="col-md-3">
                    <h4 class="mb-4" style="color:blue; margin-bottom:50px;">Hijos menores de 25 años <p style="color:black;"><?php echo $ver1[2];?></p></h4>

                    <h4 style="color:blue;">Espos@-Nombre y Apellidos <p style="color:black;"><?php echo $ver1[3];?></p></h4>
                    
                    </div>
                    <div class="col-md-3">
                    <h4 style="color:blue; margin-bottom:50px;">Beneficio de Utiles Escolares<p style="color:black;"><?php echo $ver1[4];?></p></h4>
                     <h4 style="color:blue;">Guarderia hasta 4 años <p style="color:black;"><?php echo $ver1[5];?></p></h4>
                   

                    </div>
                    <div class="col-md-3">
                    <h4 style="color:blue; margin-bottom:50px;">Becas 25 años <p style="color:black;"><?php echo $ver1[6];?></p></h4>
                    <h4 style="color:blue;">Juguetes <p style="color:black;"><?php echo $ver1[7];?></p></h4>                    
                    </div>   
                             </div>
                             
                    <?php endwhile; ?>

                    <!--      DOCUMENTOS               -->
                    <section class="miembros">
                        <h3 class="members_title">Documentos</h3>
                    <div class="cards">
                        <div class="card">
                        <h4>CEDULA</h4>

                        <?php while($doc1=mysqli_fetch_row($documento1)): ?>

                        <img src="../archivos/cedulas/<?php echo $doc1[1]; ?>" style="width:100%; alt="...">
                        <a href="../archivos/cedulas/<?php echo $doc1[1]; ?>" class="btn btn-primary">Ver </a>
                        <a class="btn btn-danger" href="../procesos/documentos/eliminarCedula.php?id=<?php echo $doc1[2];?>">Eliminar</a>


                        <?php endwhile; ?>

                     </div>
                        <div class="card">
                        <h4>PARTIDA DE NACIMIENTO</h4>

                        <?php while($doc2=mysqli_fetch_row($documento2)): ?>

                        <img src="../archivos/partidasNacimiento/<?php echo $doc2[1]; ?>" style="width:100%; alt="...">
                        <a href="../archivos/partidasNacimiento/<?php echo $doc2[1]; ?>" class="btn btn-primary">Ver </a>
                        <a class="btn btn-danger" href="../procesos/documentos/eliminarPartidaN.php?id=<?php echo $doc2[2];?>">Eliminar</a>
                        

                        <?php endwhile; ?>

                        </div>


                        <div class="card">
                        <h4>ACTA MATRIMONIO</h4>
                        <?php while($doc3=mysqli_fetch_row($documento3)): ?>

                        <img src="../archivos/actasMatrimonio/<?php echo $doc3[1]; ?>" style="width:100%; alt="...">  
                        <a href="../archivos/actasMatrimonio/<?php echo $doc3[1]; ?>" class="btn btn-primary">Ver </a>
                        <a class="btn btn-danger" href="../procesos/documentos/eliminarActaM.php?id=<?php echo $doc3[2];?>">Eliminar</a>
                        <?php endwhile; ?>
                        </div>


                        <div class="card">
                        <h4>CEDULA DE HIJOS</h4>

                        <?php while($doc4=mysqli_fetch_row($documento4)): ?>

                        <img src="../archivos/cedulaHijo/<?php echo $doc4[1]; ?>" style="width:100%; alt="...">
                        <a href="../archivos/cedulaHijo/<?php echo $doc4[1]; ?>" class="btn btn-primary" target="_blank">Ver </a>
                        <a class="btn btn-danger" href="../procesos/documentos/eliminarCedulaHijo.php?id=<?php echo $doc4[2];?>">Eliminar</a>

                        
                        <?php endwhile; ?>

                        </div>
                    </div>
                    <div class="cards">
                        <div class="card">
                        <h4>CONSTANCIA DE ESTUDIO</h4>
                        <?php while($doc5=mysqli_fetch_row($documento5)): ?>

                        <img src="../archivos/constanciaEstudio/<?php echo $doc5[1]; ?>" style="width:100%; alt="...">
                        <a href="../archivos/constanciaEstudio/<?php echo $doc5[1]; ?>" class="btn btn-primary">Ver </a>
                        <a class="btn btn-danger" href="../procesos/documentos/eliminarConstanciaE.php?id=<?php echo $doc5[2];?>">Eliminar</a>

                        <?php endwhile; ?>

                     </div>

                    <div class="card">
                    <h4>CONSTANCIA DE SOLTERIA</h4>
                    <?php while($doc6=mysqli_fetch_row($documento6)): ?>

                          <img src="../archivos/constanciaSoltero/<?php echo $doc6[1]; ?>" style="width:100%; alt="...">
                          <a href="../archivos/constanciaSoltero/<?php echo $doc6[1]; ?>" class="btn btn-primary">Ver </a>
                          <a class="btn btn-danger" href="../procesos/documentos/eliminarSolteria.php?id=<?php echo $doc6[2];?>">Eliminar</a>

                          <?php endwhile; ?>

                    </div>

                    <div class="card">
                    <h4>CURRICULUM VITAE</h4>
                    <?php while($doc7=mysqli_fetch_row($documento7)): ?>
                    <img src="../archivos/curriculo/<?php echo $doc7[1]; ?>" style="width:100%; alt="...">
                    <a href="../archivos/curriculo/<?php echo $doc7[1]; ?>" class="btn btn-primary">Ver </a>
                    <a class="btn btn-danger" href="../procesos/documentos/eliminarCurriculo.php?id=<?php echo $doc7[2];?>">Eliminar</a>

                    
                    <?php endwhile; ?>

                    </div>
                        <div class="card">
                        <h4>FONDO NEGRO</h4>
                        <?php while($doc8=mysqli_fetch_row($documento8)): ?>
                        <img src="../archivos/fondoNegro/<?php echo $doc8[1]; ?>" style="width:100%; alt="...">
                        <a href="../archivos/fondoNegro/<?php echo $doc8[1]; ?>" class="btn btn-primary">Ver </a>
                        <a class="btn btn-danger" href="../procesos/documentos/eliminarFondoN.php?id=<?php echo $doc8[2];?>">Eliminar</a>
                        
                        <?php endwhile; ?>    
                    </div>
                    </div>
            </div>
    </section>
                    
                    
                    

                    


                    



  
  
 
 

                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
	</div>
  <!--Fin-Contenido-->


		


  
                      
					</div>
					<div class="modal-footer">

					</div>
				</div>
			</div>
        </div>
        
        <?php

if(isset($_GET['delete_id']))
{
    require_once "../config/conexion2.php";

 // select image from db to delete
 $stmt_select = $DB_con->prepare('SELECT userPic FROM cedulas WHERE id_funcionario =:uid');
 $stmt_select->execute(array(':uid'=>$_GET['delete_id']));
 $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
 unlink("../archivos/cedulas/".$imgRow['userPic']);
 
 // it will delete an actual record from db
 $stmt_delete = $DB_con->prepare('DELETE FROM cedulas WHERE id_funcionario =:uid');
 $stmt_delete->bindParam(':uid',$_GET['delete_id']);
 $stmt_delete->execute();
 
}?>
  <!-- header("Location: perfil.php?id_funcionario=)");}?> -->

  <!-- header("Location: perfil.php?id_funcionario=$_GET[id_funcionario])");}?> -->


