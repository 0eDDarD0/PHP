<?php

    //CONEXION
    $con = 'mysql:dbname=tienda;host=localhost;charset=utf8';
    try{
        $db = new PDO($con, 'fer', 'root');

        //SELECT
        $select = $db->prepare('select nombre_corto,cod from producto');
        $select->execute();
        if($select){
        }else{
            print_r($db->errorInfo());
        }

        //BORRAR CONEXION
        $db = NULL;
        unset($db);
        //MANEJO DE ERRORES
    }catch(PDOException $e){
        echo 'Error al conectar con la base de datos ' . $e->getMessage();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
        <h1>TIENDA ONLINE DE ELECTRONICA DE CONSUMO NUMERO 35</h1>
    </body>
    <br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" id="stock" name="stock">
        <select name="productos" id="productos" form="stock">
            <?php
                while($fila = $select->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value='". $fila['cod'] ."'>". $fila['nombre_corto'] ."</option>";
                }
            ?>
        </select>
        <input type="submit" value="Mostrar Stock">
    </form>
    
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_REQUEST['productos'])){
                $con = 'mysql:dbname=tienda;host=localhost;charset=utf8';
                try{
                    $db = new PDO($con, 'fer', 'root');

                    //SELECT DE LAS TIENDAS
                    $select = $db->prepare('select cod,nombre from tienda');
                    $select->execute();
                    if(!$select){//compruebo errores tras cada select
                        print_r($db->errorInfo());
                    }
                    //PREPARAMOS UN ARRAY ASOCIATIVO CON CLAVE EL CODIGO Y VALOR EL NOMBRE DE LA TIENDA
                    $tiendas = [];
                    while($fila = $select->fetch(PDO::FETCH_ASSOC)){
                        $tiendas[$fila['cod']] = $fila['nombre'];
                    }

                    //SELECT DE EL STOCK
                    $select = $db->prepare('select * from stock where producto=:prod');
                    $prod = $_REQUEST['productos'];
                    $select->bindValue(':prod', $prod, PDO::PARAM_STR);
                    $select->execute();
                    if(!$select){//compruebo errores tras cada select
                        print_r($db->errorInfo());
                    }
                    //IMPRIMIMOS EL STOCK EN CADA TIENDA
                    while($fila = $select->fetch(PDO::FETCH_ASSOC)){
                        echo "<p>Tienda ". $tiendas[$fila['tienda']] .": ". $fila['unidades'] ." unidades</p>";
                    }

                    //BORRAR CONEXION
                    $db = NULL;
                    unset($db);
                    //MANEJO DE ERRORES
                }catch(PDOException $e){
                    echo 'Error al conectar con la base de datos ' . $e->getMessage();
                }
            }else{
            }
        }
    ?>

</html>