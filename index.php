<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CRUD</title>
<link rel="stylesheet" type="text/css" href="hoja.css">
</head>

<body>
   <?php
        
        include("conexion.php");
        
        //almacenar dentro d registros un array de objs(y como objs q son van a tener propiedades)
        //$registros=$base->query("SELECT * FROM DATOS_USUARIOS")->fetchAll(PDO::FETCH_OBJ);
    
    
        //-----------------------------------PAGINACION----------
        $registros_x_pags=3;//numero de registros q se mostrara x paginacion
        
        //si ha hecho click en el link de la paginacion ejm:(1,2,3,...)
        if(isset($_GET["pagina"])){
            
            if($_GET["pagina"]==1){//si la pag es =1
                
                header("Location:index.php");//recarga esta pag
            }else{
                $pagina=$_GET["pagina"];//guardame lo q aiga ahi ejm: 1,2,3 o 4
            }
        }else{//si no ha hecho click
            $pagina=1;
        }
        
        
        $empezar_desde=($pagina-1)*$registros_x_pags;//almacena en num d paginacion en donde nos encontramos
        //---------
        
        $sql_total="SELECT * FROM DATOS_USUARIOS";
        
        $resultado=$base->prepare($sql_total);
        
        $resultado->execute(array());
        
        //-------
        $num_filas=$resultado->rowCount();//almacena num de filas q tenemos dentro del array resultado
        
        $total_pags=ceil($num_filas/$registros_x_pags);//total d pags q tendra la paginacion
    
    
        //-----------------------------------------------------------
    
        $registros=$base->query("SELECT * FROM DATOS_USUARIOS LIMIT $empezar_desde,$registros_x_pags")->fetchAll(PDO::FETCH_OBJ);
    
        //insertar
        //si has hecho clik en el boton btnInsertar
        if(isset($_POST["btnInsertar"])){
            
            $nom=$_POST["txtNom"];
            $ape=$_POST["txtApe"];
            $dir=$_POST["txtDir"];
            
            $sql="INSERT INTO DATOS_USUARIOS(NOMBRE,APELLIDO,DIRECCION) VALUES(:nom,:ape,:dir)";
            
            $resultado=$base->prepare($sql);
            
            $resultado->execute(array(":nom"=>$nom,
                                      ":ape"=>$ape,
                                      ":dir"=>$dir));
            //actualice la pag y vuelva a cargar
            header("Location:index.php");
        }
    
    ?>
   
   
    <h1>CRUD<span class="subtitulo">Create Read Update Delete</span></h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table width="50%" border="0" align="center">
            <tr >
              <td class="primera_fila">Id</td>
              <td class="primera_fila">Nombre</td>
              <td class="primera_fila">Apellido</td>
              <td class="primera_fila">Dirección</td>
              <td class="sin">&nbsp;</td>
              <td class="sin">&nbsp;</td>
              <td class="sin">&nbsp;</td>
            </tr> 

           <?php
                foreach($registros as $persona):
            ?>

            <tr>
              <td><?php echo $persona->ID ?></td>
              <td><?php echo $persona->NOMBRE ?></td>
              <td><?php echo $persona->APELLIDO ?></td>
              <td><?php echo $persona->DIRECCION ?></td>

              <td class="bot">
                 <a href="eliminar.php?Id=<?php echo $persona->ID ?>" > 

                    <input type='button' name='del' id='del' value='Borrar'>

                 </a>
              </td>
              <td class='bot'>
                 <a href="editar.php?Id=<?php echo $persona->ID ?> & nom=<?php echo $persona->NOMBRE ?> & ape=<?php echo $persona->APELLIDO ?> & dir=<?php echo $persona->DIRECCION ?>
                    ">

                    <input type='button' name='up' id='up' value='Actualizar'>

                 </a>
              </td>
            </tr>  

            <?php

                endforeach;

            ?>


            <tr>
              <td></td>
              <td><input type='text' name='txtNom' size='10' class='centrado'></td>
              <td><input type='text' name='txtApe' size='10' class='centrado'></td>
              <td><input type='text' name='txtDir' size='10' class='centrado'></td>
              <td class='bot'><input type='submit' name='btnInsertar' id='cr' value='Insertar'></td>
            </tr>  
            <tr>
                <td colspan="4">
                    <?php
                        //-------------------  recorrer paginacion  -------------------
                        //recorrer el num de paginaciones a mostrar
                        for($i=1;$i<=$total_pags;$i++){

                            echo "<a href='?pagina=".$i."'> " .$i. " </a>";//muestra el num d paginaciones y almacena en el parametro de pagina la paginacion en donde se encuentra
                        }
                    ?>
                </td>
            </tr>  
      </table>
  </form>
  
    
  <p>&nbsp;</p>
</body>
</html>