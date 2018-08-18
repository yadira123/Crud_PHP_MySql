<?php
    
    include("conexion.php");

    //almacenar en una variable el id q le pasaremos como parametro
    $id=$_GET["Id"];

    $base->query("DELETE FROM DATOS_USUARIOS WHERE ID='$id'");
    
    header("Location:index.php");
    


?>