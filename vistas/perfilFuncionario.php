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
	<div>
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
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


		


  
                      
					</div>
					<div class="modal-footer">

					</div>
				</div>
			</div>
        </div>
<script src="../public/plugins/jquery-3.2.1.min.js"></script>
<script>

</script>