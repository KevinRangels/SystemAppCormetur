
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
                            <label>Nombre</label>
                            <input type="text" class="form-control input-sm" placeholder="" name="nombreSer" id="nombreSer">
                                           
                            <label>Caracteristicas</label>
                            <TEXTAREA name="caracteristicasSer" id="caracteristicasSer" class="form-control input-sm" placeholder=""  COLS=20 ROWS=10 ></TEXTAREA>                            

                

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnRegistraServicio" type="button" class="btn btn-success form-control input-sm" data-dismiss="modal">Actualiza Servicio</button>

					</div>
				</div>
			</div>
        </div>
</div>

        
                                    <!-- MODAL ACTULIZAR -->
 <!-- Modal Agregar Usuari -->
 <div class="modal fade" id="registrarCargaFModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

                            <label>Nombre</label>
                            <input type="text" class="form-control input-sm" placeholder="" name="nombreSerU" id="nombreSerU">
                                           
                            <label>Caracteristicas</label>
                            <TEXTAREA name="caracteristicasSerU" id="caracteristicasSerU" class="form-control input-sm" placeholder=""  COLS=20 ROWS=10 ></TEXTAREA>                            

                

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaServicio" type="button" class="btn btn-success form-control input-sm" data-dismiss="modal">Actualiza Servicio</button>

					</div>
				</div>
			</div>
        </div>
<div>
     
        <!-- <script src="../public/plugins/jquery-3.2.1.min.js"></script> -->

<script>

$(buscar_datos());
function buscar_datos(consulta){
    $.ajax({
        url: "../procesos/buscarServicio2.php",
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
    // $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
    $('#btnRegistraServicio').click(function(){

        var formData = new FormData(document.getElementById("frmRegistroServicio"));
        var frmRegistro = document.getElementById("frmRegistroServicio");

        $.ajax({
            url: "../procesos/servicios/registraServicio2.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(r){
                if(r == 1){
                    $('#datos').load('../procesos/buscarServicio2.php');
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
        url:"../procesos/servicios/obtenDatosServicio2.php",
        success:function(r){
            dato=jQuery.parseJSON(r);
            $('#idServicio').val(dato['id_servicio']);
            $('#nombreSerU').val(dato['nombre']);
            $('#caracteristicasSerU').val(dato['caracteristicas']);
        }
    });
}


$(document).ready(function(){
    // $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
    $('#btnActualizaServicio').click(function(){
        var formData = new FormData(document.getElementById("frmRegistroServicioU"));
        $.ajax({
            url: "../procesos/servicios/actualizaServicio2.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(r){
                if(r == 1){  
                    $('#datos').load('../procesos/buscarServicio2.php');
 
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

function eliminarServicio(idservicio){
    alertify.confirm('¿Desea eliminar este Servicio?', function(){ 
        $.ajax({
            type:"POST",
            data:"idservicio=" + idservicio,
            url:"../procesos/servicios/eliminarServicio.php",
            success:function(r){
                if(r==1){
                    $('#datos').load('../procesos/buscarServicio2.php');
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
        
