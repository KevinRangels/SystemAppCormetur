<?php
/* Destruir la sesion */
session_start();
session_destroy();
/* Redirigir */
header('Location: ../index.php');
?>
              //<button type='button' class='btn btn-success btn-view-contrato' value='<?php echo $prueba;?>' data-toggle='modal' data-target='#modal_contrato'><span class='fa fa-file-text-o'></span></button>
