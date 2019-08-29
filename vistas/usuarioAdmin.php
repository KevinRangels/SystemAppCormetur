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
  
 require_once "../config/conexion.php";
$c= new conectar();
$conexion=$c->conexion();

?>
  <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
	<!-- <div id="tablaUsuariosLoad"> -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Usuarios
						   <button class="btn btn-success" data-toggle="modal" data-target="#registrarUsuarioModal" id="btnagregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-header pull-right form-1-2">
                        <input type="text" name="caja_busqueda"  id="caja_busqueda" placeholder="Nombre de Usuario" >

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div id="datos"></div>
                    <!-- <div id="tablaUsuariosLoad"></div> -->
                    <!-- <div class="panel-body table-responsive" >
                    
                    
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
  <div class="modal fade" id="registrarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Registra Usuario</h4>
					</div>
					<div class="modal-body" >
						<form id="frmRegistro" enctype="multipart/form-data">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombre" id="nombre">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellido" id="apellido">
							<label>Usuario</label>
                            <input type="text" class="form-control input-sm" name="username" id="username">
                            <label>Password</label>
                            <input type="password" class="form-control input-sm" name="password" id="password">
                            <label>Tipo de Usuario</label>
                            <select class="form-control "  id="rolUsuario" name="rolUsuario" >
                                <option value="A">Selecciona Tipo de usuario</option>
                                    <?php
                                        $sql="SELECT id_rol,rol
                                             from roles";
                                        $result=mysqli_query($conexion,$sql);
                                     ?>
                                    <?php while($ver=mysqli_fetch_row($result)): ?>
                                <option value="<?php echo $ver[0] ?>">
                                 <?php echo $ver[1]; ?>
                                </option>
                                <?php endwhile; ?>
                                </select>

						</form>
					</div>
					<div class="modal-footer">
                    <a href="www.google.com"><button id="btnRegistraUsuario" type="button" href="usuarioAdmin.php"  class="btn btn-success" data-dismiss="modal">Registra Usuario</button></a> 

					</div>
				</div>
			</div>
        </div>

  <!-- Modal Editar -->
  <div class="modal fade" id="actualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Usuario</h4>
					</div>
					<div class="modal-body">
						<form id="frmRegistroU">
							<input type="text" hidden="" id="idUsuario" name="idUsuario">
                            <label name="nombreprueba" id="nombreprueba"></label>
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreU" id="nombreU">

							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU">

							<label>Usuario</label>
                            <input type="text" class="form-control input-sm" name="usuarioU" id="usuarioU">
                            <label>Password</label>
                            <input type="password" class="form-control input-sm" name="passwordU" id="passwordU">
                            <label>Tipo de Usuario</label>
                            <select class="form-control "  id="rolUsuarioU" name="rolUsuarioU" >
                                <option value="A">Selecciona Tipo de usuario</option>
                                    <?php
                                        $sql="SELECT id_rol,rol
                                             from roles";
                                        $result=mysqli_query($conexion,$sql);
                                     ?>
                                    <?php while($ver=mysqli_fetch_row($result)): ?>
                                <option value="<?php echo $ver[0] ?>">
                                 <?php echo $ver[1]; ?>
                                </option>
                                <?php endwhile; ?>
                                </select>

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaUsuario" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Usuario</button>

					</div>
				</div>
			</div>
        </div>
        <script src="../public/plugins/jquery-3.2.1.min.js"></script>

        <!-- <script type="text/javascript" src="../ajax/usuario.js"></script> -->

<script>
     $(document).ready(function(){
        $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
        $('#btnRegistraUsuario').click(function(){

            var formData = new FormData(document.getElementById("frmRegistro"));
            var frmRegistro = document.getElementById("frmRegistro");

            $.ajax({
                url: "../procesos/usuarios/registrarUsuario.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                success:function(r){
                    
                    if(r == 1){
                        
                        $('#datos').load('../procesos/buscarUsuario.php');
                        alertify.success("Agregado con exito");
                        
                    }else{
                        
                        alertify.error("Fallo al subir el archivo");
                    }
                }
            });
            
        });
    });

    function agregaDatosUsuario(idusuario){

$.ajax({
    type:"POST",
    data:"idusuario=" + idusuario,
    url:"../procesos/usuarios/obtenDatosUsuario.php",
    success:function(r){
        dato=jQuery.parseJSON(r);

        $('#idUsuario').val(dato['id_usuario']);
        $('#nombreU').val(dato['nombre']);        
        $('#apellidoU').val(dato['apellido']);
        $('#usuarioU').val(dato['username']);
        $('#passwordU').val(dato['password']);
        $('#rolUsuarioU').val(dato['id_rol']);
        $('#nombreprueba').val(dato['nombre']);

    }
});
}
$(document).ready(function(){
// $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");

$('#btnActualizaUsuario').click(function(){

    var formData = new FormData(document.getElementById("frmRegistroU"));

    $.ajax({
        url: "../procesos/usuarios/actualizaUsuario.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,

        success:function(r){
            
            if(r == 1){
                
                
                $('#datos').load('../procesos/buscarUsuario.php');
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


    function eliminarUsuario(idusuario){
    alertify.confirm('¿Desea eliminar este articulo?', function(){ 
        $.ajax({
            type:"POST",
            data:"idusuario=" + idusuario,
            url:"../procesos/usuarios/eliminarUsuario.php",
            success:function(r){
                if(r==1){
                    $('#datos').load('../procesos/buscarUsuario.php');
                    alertify.success("Eliminado con exito");
                    // window.location.reload();
                }else{
                    alertify.error("No se pudo eliminar ");
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
        url: "../procesos/buscarUsuario.php",
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
