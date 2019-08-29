<?php
    session_start();
    
    if(!isset($_SESSION['rol'])){
        header('location: ../index.php');
    }else{
        if($_SESSION['rol'] != 1){
            header('location: ../index.php');
        }
    }
  require_once("menu.php");
  require_once("dependenciasTD.php");

  require_once "../config/conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

    $sql="SELECT id_municipio,
                 id_parroquia,
                 id_sitiot,
                 nombre_r,
                 cedula_r,
                 celular_r,
                 id_representante
                 
            from representante as fami
            ";
    $result=mysqli_query($conexion,$sql);
  
    
    // $query = "SELECT id_departamento, departamento FROM departamentos ORDER BY departamento";
    // $resultado=$mysqli->query($query);

    $query = "SELECT id_municipio, municipio FROM municipio ORDER BY municipio";
    $resultado=$mysqli->query($query);
    
    $query2 = "SELECT id_parroquia, parroquia FROM parroquia ORDER BY parroquia";
	$resultado2=$mysqli->query($query2);
    
  
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
                          <h1 class="box-title">Servicios
						   <button class="btn btn-success" data-toggle="modal" data-target="#registrarCargaFModal" id="btnagregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                        <!-- <div class="box-header pull-right form-1-2">
                        <input type="text" name="caja_busqueda"  id="caja_busqueda" placeholder="Nombre de Usuario" >

                        </div> -->
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive">
                    <div id="datos"></div>
                    </div>

                   
                    </div>
                  
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
	</div>
  <!--Fin-Contenido-->

  <!-- Modal Agregar Usuari -->
  <div class="modal fade" id="registrarCargaFModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Registrar Servicio</h4>
					</div>
					<div class="modal-body">
                    <div class="col-md-6">
						<form id="frmRegistroServicio" enctype="multipart/form-data">

                       <label>Selecciona Municpio : </label>
                               <select name="cbx_municipio" id="cbx_municipio" class="form-control input-sm">
				                    <option value="0">Seleccionar Municipio</option>
				                      <?php while($row = $resultado->fetch_assoc()) { ?>
					                <option value="<?php echo $row['id_municipio']; ?>"><?php echo $row['municipio']; ?></option>
				                     <?php } ?>
			                    </select>
			
			                <label>  Selecciona Parroquia : </label>
                            <select name="cbx_parroquia" id="cbx_parroquia" class="form-control input-sm">
                            <option value="0">Seleccionar Parroquia</option>
				                      <?php while($row2 = $resultado2->fetch_assoc()) { ?>
					                <option value="<?php echo $row2['id_parroquia']; ?>"><?php echo $row2['parroquia']; ?></option>
				                     <?php } ?>
                            
                            </select>

                            <label>  Selecciona Sitio Turistico : </label>
                            <select name="cbx_sitioT" id="cbx_sitioT" class="form-control input-sm"></select>
                            
                            <label>Tipo de Servicio</label>
                            <select class="form-control "  id="tipoS" name="tipoS" >
                                <option value="A">Selecciona Tipo de Servicio</option>
                                    <?php
                                        $sql="SELECT id_tiposervicio,servicio
                                             from tiposervicio";
                                        $result=mysqli_query($conexion,$sql);
                                     ?>
                                    <?php while($ver=mysqli_fetch_row($result)): ?>
                                <option value="<?php echo $ver[0] ?>">
                                 <?php echo $ver[1]; ?>
                                </option>
                                <?php endwhile; ?>
                                </select>

                            <label>Descripcion</label>
                            <TEXTAREA name="descripcionS" id="descripcionS" class="form-control input-sm" placeholder=""  COLS=20 ROWS=10 ></TEXTAREA>                            

                            </div>

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnRegistraServicio" type="button" class="btn btn-success form-control input-sm" data-dismiss="modal">Actualiza Servicio</button>

					</div>
				</div>
			</div>
        </div>
<div>
        
                                    <!-- MODAL ACTULIZAR -->
<div class="modal fade" id="actualizaServicioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Registrar Servicio</h4>
	  </div>
	<div class="modal-body">
    <div class="col-md-6">
	  <form id="frmRegistroServicioU" enctype="multipart/form-data">           
        <input type="text" hidden="" id="idServicio" name="idServicio">
        
                            
                            <label>Tipo de Servicio</label>
                            <select class="form-control "  id="tipoSU" name="tipoSU" >
                                <option value="A">Selecciona Tipo de Servicio</option>
                                    <?php
                                        $sql="SELECT id_tiposervicio,servicio
                                             from tiposervicio";
                                        $result=mysqli_query($conexion,$sql);
                                     ?>
                                    <?php while($ver=mysqli_fetch_row($result)): ?>
                                <option value="<?php echo $ver[0] ?>">
                                 <?php echo $ver[1]; ?>
                                </option>
                                <?php endwhile; ?>
                                </select>

                            <label>Descripcion</label>
                            <TEXTAREA name="descripcionSU" id="descripcionSU" class="form-control input-sm" placeholder=""  COLS=20 ROWS=10 ></TEXTAREA>                            

                            </div>
  
    </form>
	<div class="modal-footer">
		<button id="btnActualizaServicio" type="button" class="btn btn-warning form-control input-sm" data-dismiss="modal">Actualiza Carga Familiar</button>
	</div>
	</div>
</div>
     </div>
   
        <!-- <script src="../public/plugins/jquery-3.2.1.min.js"></script> -->

<script>

$(buscar_datos());
function buscar_datos(consulta){
    $.ajax({
        url: "../procesos/buscarServicio.php",
        type: "POST",
        dataType: "html",
        data: {consulta: consulta},
    })
    .done(function(respuesta){
        $("#datos").html(respuesta);
    })
    .fail(function() {
        console.log("error");
    })
}

$(document).on('keyup', '#caja_busqueda', function(){
    var valor = $(this).val();
    if(valor != ""){
        buscar_datos(valor);
    }else{
        buscar_datos();
    }
} )


			$(document).ready(function(){
				$("#cbx_municipio").change(function () {

					// $('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					
					$("#cbx_municipio option:selected").each(function () {
						id_municipio = $(this).val();
						$.post("../procesos/getParroquia.php", { id_municipio: id_municipio }, function(data){
							$("#cbx_parroquia").html(data);
						});            
					});
				})
			});

            $(document).ready(function(){
				$("#cbx_parroquia").change(function () {

					// $('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					
					$("#cbx_parroquia option:selected").each(function () {
						id_parroquia = $(this).val();
						$.post("../procesos/getPersona.php", { id_parroquia: id_parroquia }, function(data){
							$("#cbx_sitioT").html(data);
						});            
					});
				})
			});

			


$(document).ready(function(){
    // $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
    $('#btnRegistraServicio').click(function(){

        var formData = new FormData(document.getElementById("frmRegistroServicio"));
        var frmRegistro = document.getElementById("frmRegistroServicio");

        $.ajax({
            url: "../procesos/servicios/registraServicio.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(r){
                if(r == 1){
                    $('#datos').load('../procesos/buscarServicio.php');
                    alertify.success("Agregado con exito");
                    
                }else{
                    
                    alertify.error("Fallo al subir el archivo");
                }
            }
        });
        
    });
});

function agregaDatosServicio(idservicio){
    $.ajax({
        type:"POST",
        data:"idservicio=" + idservicio,
        url:"../procesos/servicios/obtenDatosServicio.php",
        success:function(r){
            dato=jQuery.parseJSON(r);
            $('#idServicio').val(dato['id_servicio']);
            $('#tipoSU').val(dato['id_tiposervicio']);
            $('#descripcionSU').val(dato['descripcion']);
        }
    });
}


$(document).ready(function(){
    // $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
    $('#btnActualizaServicio').click(function(){
        var formData = new FormData(document.getElementById("frmRegistroServicioU"));
        $.ajax({
            url: "../procesos/servicios/actualizaServicio.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(r){
                if(r == 1){  
                    $('#datos').load('../procesos/buscarServicio.php');
 
                    alertify.success("Actualizado con exito ");
                    console.log(r);
                }else{
                    console.log(r);
                    alertify.error("Fallo al Actualizar");
                }
            }
        });
        
    });
});

function eliminarServicio(idrepresentante){
    alertify.confirm('¿Desea eliminar este Servicio?', function(){ 
        $.ajax({
            type:"POST",
            data:"idrepresentante=" + idrepresentante,
            url:"../procesos/servicios/eliminarServicio.php",
            success:function(r){
                if(r==1){
                    $('#datos').load('../procesos/buscarServicio.php');
                    alertify.success("Eliminado con exito");
                }else{
                    alertify.error("No se pudo eliminar");
                }
            }
        });
    }, function(){ 
        alertify.error('Cancelo')
    });
}
</script>
        
