<?php
class DB{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        $this->host     = 'localhost';
        $this->db       = 'cormetur';
        $this->user     = 'root';
        $this->password = "";
        $this->charset  = 'utf8mb4';
    }
    function connect(){
    
        try{
            
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($connection, $this->user, $this->password, $options);
    
            return $pdo;
            
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }   
    }
}
class conectar{
    private $servidor="localhost";
    private $usuario="root";
    private $password="";
    private $bd="cormetur";

    public function conexion(){
        $conexion=mysqli_connect($this->servidor,
                                 $this->usuario,
                                 $this->password,
                                 $this->bd);
         mysqli_set_charset($conexion,'utf8');
        return $conexion;
    }
    
}

$mysqli = new mysqli("localhost","root","","cormetur"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	mysqli_set_charset($mysqli,'utf8');
    
	if(mysqli_connect_errno()){

        
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}