<?php

header('Content-Type: application/json'); //Transforma el archivo php                                          //en un formato json
header('Access-Control-Allow-Origin: *'); //Puede acceder cualquiera
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: X-Requested-With');



if($_GET['moneda']== 'cormetur'  ){
    include_once 'conexion.php';
    
    $sql = 'SELECT * FROM sitiost';
    
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $datos = $sentencia->fetchAll();
    
    }else if($_GET['moneda']== 'actividades'){
        include_once 'conexion.php';
        
        $sql = 'SELECT * FROM actividades';
        
        $sentencia = $pdo->prepare($sql);
        $sentencia->execute();
        $datos = $sentencia->fetchAll();

        }else if($_GET['moneda']== 'hospedaje'){
            include_once 'conexion.php';
            
            $sql = 'SELECT sit.id_sitiot,
                            img.nombre,
                            sit.nombre_s,
                            sit.direccion_s,
                            sit.telefono_s,
                            sit.correo_s,
                            sit.paginaw_s,
                            sit.rif_s,
                            muni.municipio,
                            parro.parroquia,
                            sit.id_servicio,
                            sit.descrip
                          FROM sitiost as sit
                        inner join imagenes as img
                         on sit.id_imagen=img.id_imagen
                         inner join municipio as muni
                        on sit.id_municipio=muni.id_municipio
                        inner join parroquia as parro
                        on sit.id_parroquia=parro.id_parroquia
                         where sit.id_servicio = 2';
            
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute();
            $datos = $sentencia->fetchAll();

            }else if($_GET['moneda']== 'transporte'){
                include_once 'conexion.php';
                
                $sql = 'SELECT sit.id_sitiot,
                img.nombre,
                sit.nombre_s,
                sit.direccion_s,
                sit.telefono_s,
                sit.correo_s,
                sit.paginaw_s,
                sit.rif_s,
                muni.municipio,
                parro.parroquia,
                sit.id_servicio,
                sit.descrip
              FROM sitiost as sit
            inner join imagenes as img
             on sit.id_imagen=img.id_imagen
             inner join municipio as muni
            on sit.id_municipio=muni.id_municipio
            inner join parroquia as parro
            on sit.id_parroquia=parro.id_parroquia
                where sit.id_servicio = 3';
                
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute();
                $datos = $sentencia->fetchAll();
                }else if($_GET['moneda']== 'atractivos'){
                    include_once 'conexion.php';
                    
                    $sql = 'SELECT sit.id_sitiot,
                    img.nombre,
                    sit.nombre_s,
                    sit.direccion_s,
                    sit.telefono_s,
                    sit.correo_s,
                    sit.paginaw_s,
                    sit.rif_s,
                    muni.municipio,
                    parro.parroquia,
                    sit.id_servicio,
                    sit.descrip
                  FROM sitiost as sit
                inner join imagenes as img
                 on sit.id_imagen=img.id_imagen
                 inner join municipio as muni
                on sit.id_municipio=muni.id_municipio
                inner join parroquia as parro
                on sit.id_parroquia=parro.id_parroquia
                    where sit.id_servicio = 4';
                    
                    $sentencia = $pdo->prepare($sql);
                    $sentencia->execute();
                    $datos = $sentencia->fetchAll();

                }else if($_GET['moneda']== 'alimentos'){
                    include_once 'conexion.php';
                    
                    $sql = 'SELECT sit.id_sitiot,
                    img.nombre,
                    sit.nombre_s,
                    sit.direccion_s,
                    sit.telefono_s,
                    sit.correo_s,
                    sit.paginaw_s,
                    sit.rif_s,
                    muni.municipio,
                    parro.parroquia,
                    sit.id_servicio,
                    sit.descrip
                  FROM sitiost as sit
                inner join imagenes as img
                 on sit.id_imagen=img.id_imagen
                 inner join municipio as muni
                on sit.id_municipio=muni.id_municipio
                inner join parroquia as parro
                on sit.id_parroquia=parro.id_parroquia
                    where sit.id_servicio = 5';
                    
                    $sentencia = $pdo->prepare($sql);
                    $sentencia->execute();
                    $datos = $sentencia->fetchAll();
                }
    echo  json_encode($datos);


?>