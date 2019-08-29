//Registrar Usuarios y validar campos 
    // $(document).ready(function(){
    //     $('#tablaUsuariosLoad').load("tablaUsuarios.php");
    //     $('#btnRegistraUsuario').click(function(){

    //         var formData = new FormData(document.getElementById("frmRegistro"));
    //         var frmRegistro = document.getElementById("frmRegistro");

    //         $.ajax({
    //             url: "../procesos/usuarios/registrarUsuario.php",
    //             type: "post",
    //             dataType: "html",
    //             data: formData,
    //             cache: false,
    //             contentType: false,
    //             processData: false,

    //             success:function(r){
                    
    //                 if(r == 1){
                        
                        
    //                     alertify.success("Agregado con exito");
                        
    //                 }else{
                        
    //                     alertify.error("Fallo al subir el archivo");
    //                 }
    //             }
    //         });
            
    //     });
    // });
    
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
                    
                    // $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
                    //  $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php'); 
                    // $('body').reload('usuarioAdmin.php'); 
                   
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