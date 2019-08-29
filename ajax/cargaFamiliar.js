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

function eliminarCargaF(idcargaf){
    alertify.confirm('¿Desea eliminar esta Carga familiar?', function(){ 
        $.ajax({
            type:"POST",
            data:"idcargaf=" + idcargaf,
            url:"../procesos/cargaFamiliar/eliminarCargaf.php",
            success:function(r){
                if(r==1){
                    
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
