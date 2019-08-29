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
            inner join tipopersonal as tip
            on fun.id_tipoP=tip.id_tipoP
            inner join clasificacion as cla
            on fun.id_clasificacion=cla.id_clasificacion
            inner join departamentos as dep
            on fun.id_departamento=dep.id_departamento
            inner join municipio as muni
            on fun.id_municipio=muni.id_municipio
            inner join parroquia as parro
            on fun.id_parroquia=parro.id_parroquia";
    $result=mysqli_query($conexion,$sql);

    
	$query = "SELECT id_municipio, municipio FROM municipio ORDER BY municipio";
	$resultado=$mysqli->query($query);
    
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
                          <h1 class="box-title">Sitios Turisticos
						   <button class="btn btn-success" data-toggle="modal" data-target="#registrarSitioModal" id="btnagregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                        
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive">
                    <div id="datos"></div>
                    </div>
                    
                    <!-- <div id="tablaFuncionariosLoad"></div> -->
                    <!-- <div class="panel-body table-responsive">
                    
                    </div> -->
                  
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
	</div>
  <!--Fin-Contenido-->

  <!-- Modal Agregar SITIO TURISTICO -->
  <div class="modal fade" id="registrarSitioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Registra Sitio</h4>
					</div>
					<div class="modal-body" >
						<form id="frmRegistroSitioT" enctype="multipart/form-data">
                        <div class="col-md-6">
                            
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreS" id="nombreS">
							<label>Direccion</label>
							<input type="text" class="form-control input-sm" name="direccionS" id="direccionS">
							<label>Telefono</label>
                            <input type="text" class="form-control input-sm" name="telefonoS" id="telefonoS">
                            <label>Correo</label>
                            <input type="text" class="form-control input-sm" name="correoS" id="correoS">
                            <label>Pagina</label>
                            <input type="text" class="form-control input-sm" name="paginaS" id="paginaS">
                            <label>RIF</label>
                            <input type="text" class="form-control input-sm" name="rifS" id="rifS">
                            </div>
                            
                           
                           
                            <div class="col-md-6">
                            <label>Tipo de Servicio</label>
                            <select class="form-control "  id="tipoS" name="tipoS" >
                                <option value="A">Selecciona Tipo de Servicio</option>
                                    <?php
                                        $sql="SELECT id_servicio,nombre
                                             from servicio";
                                        $result=mysqli_query($conexion,$sql);
                                     ?>
                                    <?php while($ver=mysqli_fetch_row($result)): ?>
                                <option value="<?php echo $ver[0] ?>">
                                 <?php echo $ver[1]; ?>
                                </option>
                                <?php endwhile; ?>
                                </select>

                            <label>Selecciona Municpio : </label>
                               <select name="cbx_municipio" id="cbx_municipio" class="form-control input-sm">
				                    <option value="0">Seleccionar Municipio</option>
				                      <?php while($row = $resultado->fetch_assoc()) { ?>
					                <option value="<?php echo $row['id_municipio']; ?>"><?php echo $row['municipio']; ?></option>
				                     <?php } ?>
			                    </select>
			
			                <label>  Selecciona Parroquia : </label>
                            <select name="cbx_parroquia" id="cbx_parroquia" class="form-control input-sm"></select>
                            
                            <label>Caracteristicas</label>
                            <TEXTAREA name="caracteristicas" id="caracteristicas" class="form-control input-sm" placeholder=""  COLS=20 ROWS=10 ></TEXTAREA>                            
  
                            <label>Imagen</label>
						    <input type="file" id="imagen" name="imagen">
						    <p></p>
                           
                            </div>
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnRegistraSitioT" type="button"  class="btn btn-success form-control input-sm" data-dismiss="modal">Registra Sitio</button>

					</div>
				</div>
			</div>
        </div>

  <!-- Modal Editar -->
  <div class="modal fade" id="actualizaSitioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-ms" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Sitio Turistico</h4>
					</div>
					<div class="modal-body">
						<form id="frmRegistroSitioTU" enctype="multipart/form-data">
                        
							<input type="text" hidden="" id="idSitio" name="idSitio">
                            <div class="col-md-6">
                            
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreSU" id="nombreSU">
							<label>Direccion</label>
							<input type="text" class="form-control input-sm" name="direccionSU" id="direccionSU">
							<label>Telefono</label>
                            <input type="text" class="form-control input-sm" name="telefonoSU" id="telefonoSU">
                            <label>Correo</label>
                            <input type="text" class="form-control input-sm" name="correoSU" id="correoSU">
                            <label>Pagina</label>
                            <input type="text" class="form-control input-sm" name="paginaSU" id="paginaSU">
                            <label>RIF</label>
                            <input type="text" class="form-control input-sm" name="rifSU" id="rifSU">
                            </div>
                            <div class="col-md-6">

                           

                            <label>Caracteristicas</label>
                            <TEXTAREA name="caracteristicasU" id="caracteristicasU" class="form-control input-sm" placeholder=""  COLS=20 ROWS=10 ></TEXTAREA>                            
                            </div>

                           
                        </form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaSitio" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Sitio</button>

					</div>
				</div>
			</div>
        </div>

       
       
       
                      
				
				</div>
			</div>
        </div>
        <!-- <script src="../public/plugins/jquery-3.2.1.min.js"></script> -->

        

        <script language="javascript">
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

			
		</script>

        <script>
      $(document).ready(function(){
        $('#datos').load('../procesos/buscarSitio.php');
    $('#btnRegistraSitioT').click(function(){

        var formData = new FormData(document.getElementById("frmRegistroSitioT"));
        var frmRegistro = document.getElementById("frmRegistroSitioT");

        $.ajax({
            url: "../procesos/sitiosT2/registrarSitioT2.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(r){
                
                if(r == 1){
                    
                    $('#datos').load('../procesos/buscarSitio.php');
                    alertify.success("Agregado con exito");
                
                }else{
                
                    alertify.error("Fallo al subir el archivo");
                }
            }
        });
        
    });
});

function agregaDatosSitio(idsitiot){

$.ajax({
    type:"POST",
    data:"idsitiot=" + idsitiot,
    url:"../procesos/sitiosT/obtenDatosSitio.php",
    success:function(r){
        dato=jQuery.parseJSON(r);
        $('#idSitio').val(dato['id_sitiot']);
        $('#nombreSU').val(dato['nombre_s']);
        $('#direccionSU').val(dato['direccion_s']);
        $('#telefonoSU').val(dato['telefono_s']);
        $('#correoSU').val(dato['correo_s']);
        $('#paginaSU').val(dato['paginaw_s']);
        $('#rifSU').val(dato['rif_s']);
        $('#tipoSU').val(dato['id_servicio']);
        $('#caracteristicasU').val(dato['descrip']);

    }
});
}


$(document).ready(function(){
// $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
$('#btnActualizaSitio').click(function(){
    var formData = new FormData(document.getElementById("frmRegistroSitioTU"));
    $.ajax({
        url: "../procesos/sitiosT/actualizaSitio.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success:function(r){
            if(r == 1){  
                $('#datos').load('../procesos/buscarSitio.php');

                alertify.success("Actualizado con exito ");
                
            }else{
                
                alertify.error("Fallo al Actualizar");
            }
        }
    });
    
});
});

function eliminarSitio(idsitio){
    alertify.confirm('¿Desea eliminar este funcionario?', function(){ 
        $.ajax({
            type:"POST",
            data:"idsitio=" + idsitio,
            url:"../procesos/sitiosT/eliminarSitio.php",
            success:function(r){
                if(r==1){
                    $('#datos').load('../procesos/buscarSitio.php');
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

$(buscar_datos());
function buscar_datos(consulta){
    $.ajax({
        url: "../procesos/buscarSitio.php",
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
 </script>

