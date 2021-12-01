<?php

    //METODO DOS (SI)
    $con = 'mysql:dbname=prueba;host=localhost;charset=utf8';
    try{
        $db = new PDO($con, 'fer', 'root');
        echo "conectado correctamente a la base de datos";

        //----------------------------------------------------------------------SELECT (NO)
        //$sql = 'SELECT nota, color FROM nota';
        //$notas = $db->query($sql);
        //echo "Num de nota: ". $notas->rowCount() ."<br>";
        //foreach ($notas as $usu){
        //    print "nota: ". $usu['nota'] ."<br>";
        //}
        //----------------------------------------------------------------------SELECT PREPARADO (SI)
        //$select = $db->prepare('select nota from nota where color=:color');
        //$select->execute(array(':color' => "rojo"));
        //echo "<br>Notas rojas: ". $select->rowCount() ."<br>";
        //while($fila = $select->fetch(PDO::FETCH_ASSOC)){
        //    echo $fila["nota"] ."<br>";
        //}



        //----------------------------------------------------------------------INSERT (NO)
        //$ins = "INSERT into nota VALUES(null, 'insert no preparado', 'negro')";
        //$sql = $db->query($ins);
        //----------------------------------------------------------------------INSERT PREPARADO (SI)
        //$ins = $db->prepare("INSERT into nota VALUES(:id, :nota, :color)");
        //$ins->bindParam(':id', $id, PDO::PARAM_NULL);
        //$ins->bindParam(':nota', $nota, PDO::PARAM_STR, 300);
        //$ins->bindParam(':color', $color, PDO::PARAM_STR, 20);
        //$id = null;
        //$nota = "insert preparado con nombre";
        //$color = "verde";
        //$ins->execute(); //tras el execute podemos volver a cambiar los valores de $id $nota y $color y volver a hacer un execute
        //if($ins){
        //    echo "insercion exitosa ". $ins->rowCount() ." filas insertadas<br>"; 
        //}else{
        //    print_r($db->errorInfo());
        //}
        //echo "ID de fila insertada: ". $db->lastInsertId() ."<br>";
        //----------------------------------------------------------------------INSERT PREPARADO CON OBJETOS
        //$ins = $db->prepare("INSERT into nota VALUES(:id, :nota, :color)");
        //$ins->execute((array) $objeto); //objeto debe tener los atributos con los mismos nombres que en la consulta
        //el casting de un objeto a un array lo convierte en un array asociativo


        //----------------------------------------------------------------------UPDATE (NO)
        //$upd = "UPDATE nota SET color='morado' WHERE color='rojo'";
        //$result = $db->query($upd);
        //----------------------------------------------------------------------UPDATE PREPARADO (SI)
        //$upd = $db->prepare('UPDATE nota set color=:nuevo where color =:viejo');
        //$upd->bindParam(':nuevo', $nuevo, PDO::PARAM_STR);
        //$upd->bindParam(':viejo', $viejo, PDO::PARAM_STR);
        //$nuevo = "morado";
        //$viejo = "rojo";
        //$upd->execute();
        //if($upd){
        //    echo "<br>UPDATE exitoso ". $upd->rowCount() ." filas actualizadas<br>"; 
        //}else{
        //    print_r($db->errorInfo());
        //}


        //----------------------------------------------------------------------DELETE (NO)
        //$del = "DELETE from nota WHERE id=1";
        //$result = $db->query($del);
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