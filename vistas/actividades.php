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
                          <h1 class="box-title">Actividades
						   <button class="btn btn-success" data-toggle="modal" data-target="#registrarActividadModal" id="btnagregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
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
  <div class="modal fade" id="registrarActividadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Registra Actividad </h4>
					</div>
					<div class="modal-body" >
						<form id="frmRegistroActi" enctype="multipart/form-data">
                        <div class="col-md-6">
                            
							<label>Titulo</label>
							<input type="text" class="form-control input-sm" name="act_titulo" id="act_titulo">
							<label>Fecha</label>
							<input type="date" class="form-control input-sm" name="act_fecha" id="act_fecha">
							<label>Hora</label>
                            <input type="time" class="form-control input-sm" name="act_hora" id="act_hora">
                            <label>Lugar</label>
                            <input type="text" class="form-control input-sm" name="act_lugar" id="act_lugar">
                            <label>Descripcion</label>
                            <TEXTAREA name="act_descrip" id="act_descrip" class="form-control input-sm" placeholder=""  COLS=20 ROWS=10 ></TEXTAREA>                            
                            </div>
                            
                           
                           
                            
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnRegistraActi" type="button"  class="btn btn-success form-control input-sm" data-dismiss="modal">Registra Actividad</button>

					</div>
				</div>
			</div>
        </div>

  <!-- Modal Editar -->
  <div class="modal fade" id="actualizaActividadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-ms" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Actividad</h4>
					</div>
					<div class="modal-body">
                    <form id="frmRegistroActiU" enctype="multipart/form-data">
                        <div class="col-md-6">
                        <input type="text" hidden="" id="idActividad" name="idActividad">

							<label>Titulo</label>
							<input type="text" class="form-control input-sm" name="act_tituloU" id="act_tituloU">
							<label>Fecha</label>
							<input type="date" class="form-control input-sm" name="act_fechaU" id="act_fechaU">
							<label>Hora</label>
                            <input type="time" class="form-control input-sm" name="act_horaU" id="act_horaU">
                            <label>Lugar</label>
                            <input type="text" class="form-control input-sm" name="act_lugarU" id="act_lugarU">
                            <label>Descripcion</label>
                            <TEXTAREA name="act_descripU" id="act_descripU" class="form-control input-sm" placeholder=""  COLS=20 ROWS=10 ></TEXTAREA>                            
                            </div>
                            
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaActividad" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Actividad</button>

					</div>
				</div>
			</div>
        </div>

       
       
       
                      
				
				</div>
			</div>
        </div>
        <!-- <script src="../public/plugins/jquery-3.2.1.min.js"></script> -->
        <script>
      $(document).ready(function(){
        $('#datos').load('../procesos/buscarActividad.php');
    $('#btnRegistraActi').click(function(){

        var formData = new FormData(document.getElementById("frmRegistroActi"));
        var frmRegistro = document.getElementById("frmRegistroActi");

        $.ajax({
            url: "../procesos/actividades/registrarActividad.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(r){
                if(r == 1){
                    $('#datos').load('../procesos/buscarActividad.php');
                    alertify.success("Agregado con exito");
                }else{
                    alertify.error("Fallo al subir el archivo");
                }
            }
        });
        
    });
});

function agregaDatosActividad(idactividades){

$.ajax({
    type:"POST",
    data:"idactividades=" + idactividades,
    url:"../procesos/actividades/obtenDatosActividad.php",
    success:function(r){
        dato=jQuery.parseJSON(r);
        $('#idActividad').val(dato['id_actividades']);
        $('#act_tituloU').val(dato['titulo']);
        $('#act_fechaU').val(dato['fecha']);
        $('#act_horaU').val(dato['hora']);
        $('#act_lugarU').val(dato['lugar']);
        $('#act_descripU').val(dato['descrip']);
      

    }
});
}


$(document).ready(function(){
// $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
$('#btnActualizaActividad').click(function(){
    var formData = new FormData(document.getElementById("frmRegistroActiU"));
    $.ajax({
        url: "../procesos/actividades/actualizaActividad.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success:function(r){
            if(r == 1){  
                $('#datos').load('../procesos/buscarActividad.php');

                alertify.success("Actualizado con exito ");
                
            }else{
                
                alertify.error("Fallo al Actualizar");
            }
        }
    });
    
});
});

function eliminarActividad(idactividad){
    alertify.confirm('¿Desea eliminar esta Actividad?', function(){ 
        $.ajax({
            type:"POST",
            data:"idactividad=" + idactividad,
            url:"../procesos/actividades/eliminarActividad.php",
            success:function(r){
                if(r==1){
                    $('#datos').load('../procesos/buscarActividad.php');
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

