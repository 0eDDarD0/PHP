<?php

    //METODO DOS (SI)
    $con = 'mysql:dbname=prueba;host=localhost;charset=utf8';
    try{
        $db = new PDO($con, 'fer', 'root');
        echo "conectado correctamente a la base de datos";

        //METODOS UTILES
        $select->rowCount(); //numero de filas
        $insert->lastInsertId(); //id del ultimo insertado


        //----------------------------------------------------------------------SELECT
        $select = $db->prepare('SELECT nota FROM nota WHERE color=:color');
        $select->bindParam(':color', $color);
        $select->execute();
        while($fila = $select->fetch(PDO::FETCH_ASSOC)){
            echo $fila["nota"] ."<br>";
        }


        //----------------------------------------------------------------------INSERT 
        $ins = $db->prepare("INSERT into nota VALUES(:id, :nota, :color)");
        $ins->bindParam(':id', $id, PDO::PARAM_NULL);
        $ins->bindParam(':nota', $nota, PDO::PARAM_STR, 300);
        $ins->bindParam(':color', $color, PDO::PARAM_STR, 20);
        $id = null;
        $nota = "insert preparado con nombre";
        $color = "verde";
        $ins->execute(); //tras el execute podemos volver a cambiar los valores de $id $nota y $color y volver a hacer un execute
        if($ins){
            echo "insercion exitosa";
        }else{
            print_r($db->errorInfo());
        }
        //----------------------------------------------------------------------INSERT PREPARADO CON OBJETOS
        //$ins = $db->prepare("INSERT into nota VALUES(:id, :nota, :color)");
        //$ins->execute((array) $objeto); //objeto debe tener los atributos con los mismos nombres que en la consulta
        //el casting de un objeto a un array lo convierte en un array asociativo


        //----------------------------------------------------------------------UPDATE
        $upd = $db->prepare('UPDATE nota set color=:nuevo where color =:viejo');
        $upd->bindParam(':nuevo', $nuevo, PDO::PARAM_STR);
        $upd->bindParam(':viejo', $viejo, PDO::PARAM_STR);
        $nuevo = "morado";
        $viejo = "rojo";
        $upd->execute();
        if($upd){
            echo "<br>UPDATE exitoso ". $upd->rowCount() ." filas actualizadas<br>"; 
        }else{
            print_r($db->errorInfo());
        }



        //----------------------------------------------------------------------DELETE PREPARADO (SI)
        $del = $db->prepare('DELETE from nota WHERE id=:id');
        $del->bindParam(':id', $id, PDO::PARAM_INT);
        $id = 9;
        $del->execute();
        if($del){
            echo "<br>DELETE exitoso ". $del->rowCount() ." filas actualizadas<br>"; 
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