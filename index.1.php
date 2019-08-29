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
                header('location: vistas/usuarioAdmin.php');
            break;

            case 2:
                header('location: vistas/usuario2.php');
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
                    header('location: vistas/usuarioAdmin.php');
                break;
    
                case 2:
                    header('location: vistas/usuario2.php');
                break;
    
                default:
            }   
        }else{
            // no existe el usurio
            echo "El usuario o contraseña con incorrectos";
        }
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    
</head>
<body>
<form action="#" method="post">
  Usuario: <br><input type="text" name="username"><br/>
  Password: <br><input type="text" name="password"><br/>
  <input type="submit" value="Iniciar sesion"><br/>
</form>
    
</body>
</html>