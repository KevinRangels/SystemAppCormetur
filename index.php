<?php
    include_once "config/conexion.php";
    
    session_start();

    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }
    if(isset($_SESSION['rol'])){
        switch($_SESSION['rol']){
            case 1:
                header('location: vistas/home.php');
            break;

            case 2:
                header('location: vistas/Colab/home2.php');
            break;

            default:
        }
    }
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new DB();

        $query = $db->connect()->prepare('SELECT*FROM usuarios where username = :username AND password = :password');
        $query->execute(['username' => $username, 'password' => $password]);
        $row = $query->fetch(PDO::FETCH_NUM);
        
        if($row == true){
            //validar rol
            $rol = $row[1];
            $_SESSION['rol'] = $rol;
            //echo "correcto";
            
            switch($_SESSION['rol']){
                case 1:
                    header('location: vistas/home.php');
                break;
    
                case 2:
                    header('location: vistas/Colab/home2.php');
                break;
    
                default:
            }   
        }else{
            // no existe el usurio
            echo "<script> alert('error'); </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>LogIn</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./index/css/main.css">
    <link rel="stylesheet" href="public/plugins/alertifyjs/css/alertify.min.css">

</head>
<body class="cover" style="background-image: url(./assets/img/fondoApp.jpg);">
	<form action="#" method="post" autocomplete="off" class="full-box logInForm">
		<p class="text-center text-muted">
        
        <img src="assets/img/logocormetur.jpg" alt=""  style="width:100%;">  
        
        </p>
        <h3 class="text-center text-muted mb-3"  style="color:white;">Recursos Humanos</h3>
		<p class="text-center text-muted text-uppercase">Inicia sesión</p>
		<div class="form-group label-floating">
		  <label class="control-label" for="UserEmail">Usuario</label>
		  <input class="form-control" id="UserEmail" name="username" type="text" style="color:white;">
		  <p class="help-block">Escribe tú Usuario</p>
		</div>
		<div class="form-group label-floating">
		  <label class="control-label" for="UserPass">Contraseña</label>
		  <input class="form-control" id="UserPass" name="password" type="password" style="color:white;">
		  <p class="help-block">Escribe tú contraseña</p>
		</div>
		<div class="form-group text-center">
			<input type="submit" value="Iniciar sesión" class="btn btn-raised btn-succes">
		</div>
	</form>
	<!--====== Scripts -->
	<script src="./index/js/jquery-3.1.1.min.js"></script>
	<script src="./index/js/bootstrap.min.js"></script>
	<script src="./index/js/material.min.js"></script>
    <script src="./public/plugins/alertifyjs/alertify.min.js"></script>
	<script src="./index/js/ripples.min.js"></script>
	<script src="./index/js/sweetalert2.min.js"></script>
	<script src="./index/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./index/js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>