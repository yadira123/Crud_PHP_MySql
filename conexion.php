<?php
    
    try{
        
        $base=new PDO("mysql:host=localhost:3308;dbname=pruebas","root","root");
        //atributos q va a tener la conexion
        
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $base->exec("SET CHARACTER SET utf8");
        
        
        
        
        
    }catch(Exception $e){
        die('Error'.$e->getMessage());
        echo "Linea de error: ".$e->getLine();
    }




?>