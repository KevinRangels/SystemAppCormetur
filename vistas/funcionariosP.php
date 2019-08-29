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
                          <h1 class="box-title">Personal
						   <button class="btn btn-success" data-toggle="modal" data-target="#registrarFuncionarioModal" id="btnagregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
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

  <!-- Modal Agregar Usuari -->
  <div class="modal fade" id="registrarFuncionarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Registra Perosnal</h4>
					</div>
					<div class="modal-body" >
						<form id="frmRegistroFuncionario" enctype="multipart/form-data">
                        <div class="col-md-4">
                            <label>Nro Expediente</label>
							<input type="text" class="form-control input-sm" name="expedienteF" id="expedienteF">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreF" id="nombreF">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellidoF" id="apellidoF">
							<label>Cedula</label>
                            <input type="text" class="form-control input-sm" name="cedulaF" id="cedulaF">
                            <label>Estado Civil</label>
                            <input type="text" class="form-control input-sm" name="estadocF" id="estadocF">
                            <label>Fecha de Nacimiento</label>
                            <input type="date" class="form-control input-sm" name="fechaN" id="fechaN">
                            <label>Antiguedad</label>
                            <input type="text" class="form-control input-sm" name="antiguedad" id="antiguedad">
                            </div>
                            <div class="col-md-4">
                            <label>Direccion</label>
                            <input type="text" class="form-control input-sm" name="direccionF" id="direccionF">
                            <label>Telefono</label>
                            <input type="text" class="form-control input-sm" name="telefonoF" id="telefonoF">
                            <label>Fecha de Ingreso</label>
                            <input type="date" class="form-control input-sm" name="fechaF" id="fechaF">
                            <label>Cargo</label>
                            <input type="text" class="form-control input-sm" name="cargoF" id="cargoF">
                           
                            <label>Tipo de Empleado</label>
                            <select class="form-control "  id="tipoF" name="tipoF" >
                                <option value="A">Selecciona Tipo de Empleado</option>
                                    <?php
                                        $sql="SELECT id_tipoP,tipo
                                             from tipopersonal";
                                        $result=mysqli_query($conexion,$sql);
                                     ?>
                                    <?php while($ver=mysqli_fetch_row($result)): ?>
                                <option value="<?php echo $ver[0] ?>">
                                 <?php echo $ver[1]; ?>
                                </option>
                                <?php endwhile; ?>
                                </select>

                           
                            <label>Clasificacion</label>
                            <select class="form-control "  id="clasificacionF" name="clasificacionF" >
                                <option value="A">Selecciona La Clasificacion</option>
                                    <?php
                                        $sql="SELECT id_clasificacion,clasificacion
                                             from clasificacion";
                                        $result=mysqli_query($conexion,$sql);
                                     ?>
                                    <?php while($ver=mysqli_fetch_row($result)): ?>
                                <option value="<?php echo $ver[0] ?>">
                                 <?php echo $ver[1]; ?>
                                </option>
                                <?php endwhile; ?>
                                </select>

                            <label>Departamentos</label>
                            <select class="form-control "  id="departamentoF" name="departamentoF" >
                                <option value="A">Selecciona El Departamento</option>
                                    <?php
                                        $sql="SELECT id_departamento,departamento
                                             from departamentos";
                                        $result=mysqli_query($conexion,$sql);
                                     ?>
                                    <?php while($ver=mysqli_fetch_row($result)): ?>
                                <option value="<?php echo $ver[0] ?>">
                                 <?php echo $ver[1]; ?>
                                </option>
                                <?php endwhile; ?>
                                </select>
                            
                            <label>Profesion</label>
                            <input type="text" class="form-control input-sm" name="profesionF" id="profesionF">
                            </div>
                            <div class="col-md-4">

                            <label>Selecciona Municpio : </label>
                               <select name="cbx_municipio" id="cbx_municipio" class="form-control input-sm">
				                    <option value="0">Seleccionar Municipio</option>
				                      <?php while($row = $resultado->fetch_assoc()) { ?>
					                <option value="<?php echo $row['id_municipio']; ?>"><?php echo $row['municipio']; ?></option>
				                     <?php } ?>
			                    </select>
			
			                <label>  Selecciona Parroquia : </label>
                            <select name="cbx_parroquia" id="cbx_parroquia" class="form-control input-sm"></select>
                            
                          
                           
                            </div>
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnRegistraFuncionario" type="button"  class="btn btn-success form-control input-sm" data-dismiss="modal">Registra Personal</button>

					</div>
				</div>
			</div>
        </div>

  <!-- Modal Editar -->
  <div class="modal fade" id="actualizaFuncionarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-ms" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Funcionario</h4>
					</div>
					<div class="modal-body">
						<form id="frmRegistroFuncionarioU" enctype="multipart/form-data">
                        
							<input type="text" hidden="" id="idFuncionario" name="idFuncionario">
                            <div class="col-md-6">
                            <label>Nro Expediente</label>
							<input type="text" class="form-control input-sm" name="expedienteFU" id="expedienteFU">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreFU" id="nombreFU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellidoFU" id="apellidoFU">
							<label>Cedula</label>
                            <input type="text" class="form-control input-sm" name="cedulaFU" id="cedulaFU">
                            <label>Estado Civil</label>
                            <input type="text" class="form-control input-sm" name="estadocFU" id="estadocFU">
                            <label>Fecha de Nacimiento</label>
                            <input type="date" class="form-control input-sm" name="fechaNU" id="fechaNU">
                            <label>Antiguedad</label>
                            <input type="text" class="form-control input-sm" name="antiguedadU" id="antiguedadU">
                            </div>
                            <div class="col-md-6">
                            <label>Direccion</label>
                            <input type="text" class="form-control input-sm" name="direccionFU" id="direccionFU">
                            <label>Telefono</label>
                            <input type="text" class="form-control input-sm" name="telefonoFU" id="telefonoFU">
                            <label>Fecha de Ingreso</label>
                            <input type="date" class="form-control input-sm" name="fechaFU" id="fechaFU">
                            <label>Cargo</label>
                            <input type="text" class="form-control input-sm" name="cargoFU" id="cargoFU">
                            <label>Tipo de Empleado</label>
                            <select class="form-control "  id="tipoFU" name="tipoFU" >
                                <option value="A">Selecciona Tipo de Empleado</option>
                                    <?php
                                        $sql="SELECT id_tipoP,tipo
                                             from tipopersonal";
                                        $result=mysqli_query($conexion,$sql);
                                     ?>
                                    <?php while($ver=mysqli_fetch_row($result)): ?>
                                <option value="<?php echo $ver[0] ?>">
                                 <?php echo $ver[1]; ?>
                                </option>
                                <?php endwhile; ?>
                                </select>
                            <label>Clasificacion</label>
                            <select class="form-control input-sm"  id="clasificacionFU" name="clasificacionFU" >
                                <option value="A">Selecciona La Clasificacion</option>
                                    <?php
                                        $sql="SELECT id_clasificacion,clasificacion
                                             from clasificacion";
                                        $result=mysqli_query($conexion,$sql);
                                     ?>
                                    <?php while($ver=mysqli_fetch_row($result)): ?>
                                <option value="<?php echo $ver[0] ?>">
                                 <?php echo $ver[1]; ?>
                                </option>
                                <?php endwhile; ?>
                                </select>
                            <label>Departamento</label>
                            <select class="form-control "  id="departamentoFU" name="departamentoFU" class="form-control input-sm" >
                                <option value="A">Selecciona El Departamento</option>
                                    <?php
                                        $sql="SELECT id_departamento,departamento
                                             from departamentos";
                                        $result=mysqli_query($conexion,$sql);
                                     ?>
                                    <?php while($ver=mysqli_fetch_row($result)): ?>
                                <option value="<?php echo $ver[0] ?>">
                                 <?php echo $ver[1]; ?>
                                </option>
                                <?php endwhile; ?>
                                </select>

                            <label>Profesion</label>
                            <input type="text" class="form-control input-sm" name="profesionFU" id="profesionFU">

                            
                            </div>
						
                        
                        </form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaFuncionario" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Funcionario</button>

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
    // $('#tablaFuncionariosLoad').load("funcionarios/tablaFuncionarios.php");
    $('#btnRegistraFuncionario').click(function(){

        var formData = new FormData(document.getElementById("frmRegistroFuncionario"));
        var frmRegistro = document.getElementById("frmRegistroFuncionario");

        $.ajax({
            url: "../procesos/funcionarios/registrarFuncionarioP.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(r){
                
                if(r == 1){
                    
                    $('#datos').load('../procesos/buscarPersonal.php');
                    alertify.success("Agregado con exito");
                
                }else{
                
                    alertify.error("Fallo al subir el archivo");
                }
            }
        });
        
    });
});

function agregaDatosFuncionario(idfuncionario){
$.ajax({
    type:"POST",
    data:"idfuncionario=" + idfuncionario,
    url:"../procesos/funcionarios/obtenDatosFuncionario.php",
    success:function(r){
        dato=jQuery.parseJSON(r);
        $('#idFuncionario').val(dato['id_funcionario']);
        $('#expedienteFU').val(dato['expediente']);
        $('#nombreFU').val(dato['nombre']);
        $('#apellidoFU').val(dato['apellido']);
        $('#cedulaFU').val(dato['cedula']);
        $('#estadocFU').val(dato['edocivil']);
        $('#fechaNU').val(dato['fechaN']);
        $('#antiguedadU').val(dato['antiguedad']);
        $('#direccionFU').val(dato['direccion']);
        $('#telefonoFU').val(dato['telefono']);
        $('#fechaFU').val(dato['fechaIngreso']);
        $('#cargoFU').val(dato['cargo']);
        $('#tipoFU').val(dato['id_tipoP']);
        $('#clasificacionFU').val(dato['id_clasificacion']);
        $('#departamentoFU').val(dato['id_departamento']);
        $('#profesionFU').val(dato['profesion']);
        
    }
});
}


$(document).ready(function(){
// $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
$('#btnActualizaFuncionario').click(function(){
    var formData = new FormData(document.getElementById("frmRegistroFuncionarioU"));
    $.ajax({
        url: "../procesos/funcionarios/actualizaFuncionario.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success:function(r){
            if(r == 1){  
                $('#datos').load('../procesos/buscarPersonal.php');

                alertify.success("Actualizado con exito ");
                
            }else{
                
                alertify.error("Fallo al Actualizar");
            }
        }
    });
    
});
});

function eliminarFuncionario(idfuncionario){
    alertify.confirm('¿Desea eliminar este funcionario?', function(){ 
        $.ajax({
            type:"POST",
            data:"idfuncionario=" + idfuncionario,
            url:"../procesos/funcionarios/eliminarFuncionario.php",
            success:function(r){
                if(r==1){
                    $('#datos').load('../procesos/buscarPersonal.php');
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
        url: "../procesos/buscarPersonal.php",
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

