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

    $sql="SELECT fun.nombre,
                 fun.apellido,
                 fun.cedula,
                 fami.cargaF,
                 fami.menores_uno,
                 fami.menores_dos,
                 fami.esposo,
                 fami.beneficioUtiles,
                 fami.guarderia,
                 fami.becas,
                 fami.juquetes,
                 fami.id_cargaFamilia
                 
            from cargafamilia as fami
            inner join funcionarios as fun
            on fami.id_funcionario=fun.id_funcionario";
    $result=mysqli_query($conexion,$sql);
  
    
    $query = "SELECT id_departamento, departamento FROM departamentos ORDER BY departamento";
    $resultado=$mysqli->query($query);

    // $query = "SELECT id_municipio, municipio FROM municipio ORDER BY municipio";
	// $resultado=$mysqli->query($query);
    
  
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
                          <h1 class="box-title">Carga Familiar
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
						<h4 class="modal-title" id="myModalLabel">Registrar Carga Familiar</h4>
					</div>
					<div class="modal-body">
                    <div class="col-md-6">
						<form id="frmRegistroCargaF" enctype="multipart/form-data">

                        <label>Selecciona Departamento : </label>
                               <select name="cbx_departamento" id="cbx_departamento" class="form-control input-md">
				                    <option value="0">Selecciona Departamento</option>
				                      <?php while($row = $resultado->fetch_assoc()) { ?>
					                <option value="<?php echo $row['id_departamento']; ?>"><?php echo $row['departamento']; ?></option>
				                     <?php } ?>
			                    </select>
			
			                <label>  Selecciona Persona : </label>
                            <select name="cbx_persona" id="cbx_persona" class="form-control input-md"></select>

                            <label>Carga Familiar</label>
                            <input type="text" class="form-control input-md" placeholder="Cantidad de familiares" name="cargaF" id="cargaF">

                            <label>Menores de 18 años</label>
                            <input type="text" class="form-control input-md" placeholder="Cantidad de familiares" name="menores_uno" id="menores_uno">

                            <label>Menores de 25 años</label>
                            <input type="text" class="form-control input-md" placeholder="Cantidad de familiares" name="menores_dos" id="menores_dos">

                            <label>Espos@ Nombre Completo y fecha</label>
                            <input type="text" class="form-control input-md" placeholder="" name="esposoF" id="esposoF">
                            </div>
                            <div class="col-md-6">

                            <label>Beneficios de Utiles Escolares</label>
                            <input type="text" class="form-control input-sm" placeholder="SI / NO" name="utilesF" id="utilesF">

                            <label>Guarderia hasta 4 años</label>
                            <input type="text" class="form-control input-sm" placeholder="SI / NO" name="guarderiaF" id="guarderiaF">

                            <label>Becas 25 años</label>
                            <input type="text" class="form-control input-sm" placeholder="SI / NO" name="becasF" id="becasF">

                            <label>Juguetes</label>
                            <input type="text" class="form-control input-sm" placeholder="SI / NO" name="juguetesF" id="juguetesF">
                            </div>

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnRegistraCargaF" type="button" class="btn btn-success form-control input-sm" data-dismiss="modal">Actualiza Carga Familiar</button>

					</div>
				</div>
			</div>
        </div>
<div>
        
                                    <!-- MODAL ACTULIZAR -->
<div class="modal fade" id="actualizarCargaFModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Registrar Carga Familiar</h4>
	  </div>
	<div class="modal-body">
    <div class="col-md-6">
	  <form id="frmRegistroCargaFU" enctype="multipart/form-data">           
        <input type="text" hidden="" id="idCargaF" name="idCargaF">
        <label>Carga Familiar</label>
        <input type="text" class="form-control input-md" placeholder="Cantidad de familiares" name="cargaFU" id="cargaFU">  
                        
        <label>Menores de 18 años</label>
        <input type="text" class="form-control input-md" placeholder="Cantidad de familiares" name="menores_unoU" id="menores_unoU">
        <label>Menores de 25 años</label>
        <input type="text" class="form-control input-md" placeholder="Cantidad de familiares" name="menores_dosU" id="menores_dosU">
        <label>Espos@ Nombre Completo y fecha</label>
        <input type="text" class="form-control input-md" placeholder="" name="esposoFU" id="esposoFU">
    </div>
    <div class="col-md-6">
        <label>Beneficios de Utiles Escolares</label>
        <input type="text" class="form-control input-sm" placeholder="SI / NO" name="utilesFU" id="utilesFU">
        <label>Guarderia hasta 4 años</label>
        <input type="text" class="form-control input-sm" placeholder="SI / NO" name="guarderiaFU" id="guarderiaFU">
        <label>Becas 25 años</label>
        <input type="text" class="form-control input-sm" placeholder="SI / NO" name="becasFU" id="becasFU">
        <label>Juguetes</label>
        <input type="text" class="form-control input-sm" placeholder="SI / NO" name="juguetesFU" id="juguetesFU">
        </div>
    </div>
    </form>
	<div class="modal-footer">
		<button id="btnActualizaCargaF" type="button" class="btn btn-warning form-control input-sm" data-dismiss="modal">Actualiza Carga Familiar</button>
	</div>
	</div>
</div>
     </div>
   
        <!-- <script src="../public/plugins/jquery-3.2.1.min.js"></script> -->

<script>

$(buscar_datos());
function buscar_datos(consulta){
    $.ajax({
        url: "../procesos/buscarCarga.php",
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
    $("#cbx_departamento").change(function () {        
        $("#cbx_departamento option:selected").each(function () {
            id_departamento = $(this).val();
            $.post("../procesos/getPersona.php", { id_departamento: id_departamento }, function(data){
                $("#cbx_persona").html(data);
            });            
        });
    })
});	




$(document).ready(function(){
    // $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
    $('#btnRegistraCargaF').click(function(){

        var formData = new FormData(document.getElementById("frmRegistroCargaF"));
        var frmRegistro = document.getElementById("frmRegistroCargaF");

        $.ajax({
            url: "../procesos/cargaFamiliar/registrarCargaF.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(r){
                if(r == 1){
                    $('#datos').load('../procesos/buscarCarga.php');
                    alertify.success("Agregado con exito");
                    
                }else{
                    
                    alertify.error("Fallo al subir el archivo");
                }
            }
        });
        
    });
});

function agregaDatosCargaF(idcargaf){
    $.ajax({
        type:"POST",
        data:"idcargaf=" + idcargaf,
        url:"../procesos/cargaFamiliar/obtenDatosCargaF.php",
        success:function(r){
            dato=jQuery.parseJSON(r);
            $('#idCargaF').val(dato['id_cargaFamilia']);
            $('#cargaFU').val(dato['cargaF']);
            $('#menores_unoU').val(dato['menores_uno']);
            $('#menores_dosU').val(dato['menores_dos']);
            $('#esposoFU').val(dato['esposo']);
            $('#utilesFU').val(dato['beneficioUtiles']);
            $('#guarderiaFU').val(dato['guarderia']);
            $('#becasFU').val(dato['becas']);
            $('#juguetesFU').val(dato['juquetes']);
        }
    });
}


$(document).ready(function(){
    // $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
    $('#btnActualizaCargaF').click(function(){
        var formData = new FormData(document.getElementById("frmRegistroCargaFU"));
        $.ajax({
            url: "../procesos/cargaFamiliar/actualizaCargaF.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(r){
                if(r == 1){  
                    $('#datos').load('../procesos/buscarCarga.php');
 
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

function eliminarCargaF(idcargaf){
    alertify.confirm('¿Desea eliminar esta Carga familiar?', function(){ 
        $.ajax({
            type:"POST",
            data:"idcargaf=" + idcargaf,
            url:"../procesos/cargaFamiliar/eliminarCargaf.php",
            success:function(r){
                if(r==1){
                    $('#datos').load('../procesos/buscarCarga.php');
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
        
