<?php

    //METODO DOS (SI)
    $con = 'mysql:dbname=prueba;host=localhost;charset=utf8';
    try{
        $db = new PDO($con, 'fer', 'root');
        echo "conectado correctamente a la base de datos";

        //SELECT (NO)
        //$sql = 'SELECT nota, color FROM nota';
        //$notas = $db->query($sql);
        //echo "Num de nota: ". $notas->rowCount() ."<br>";
        //foreach ($notas as $usu){
        //    print "nota: ". $usu['nota'] ."<br>";
        //}
        //SELECT PREPARADO (SI)
        $preparada = $db->prepare('select nota from nota where color=:color');
        $preparada->execute(array(':color' => "rojo"));
        echo "<br>Notas rojas: ". $preparada->rowCount() ."<br>";
        //while($fila = $preparada->fetch(PDO::FETCH_ASSOC)){
        //    echo $fila["nota"] ."<br>";
        //}
        foreach ($preparada as $usu){
            print "Nota: ". $usu['nota'] ."<br>";
        }


        //INSERT (NO)
        //$ins = "INSERT into nota VALUES(null, 'insert no preparado', 'negro')";
        //$sql = $db->query($ins);
        //INSERT PREPARADO (SI)
        $ins = $db->prepare("INSERT into nota VALUES(:id, :nota, :color)");
        $ins->bindParam(':id', $id, PDO::PARAM_NULL);
        $ins->bindParam(':nota', $nota, PDO::PARAM_STR, 300);
        $ins->bindParam(':color', $color, PDO::PARAM_STR, 20);
        $id = null;
        $nota = "insert preparado con nombre";
        $color = "verde";
        $ins->execute(); //tras el execute podemos volver a cambiar los valores de $id $nota y $color y volver a hacer un execute
        if($ins){
            echo "insercion exitosa ". $ins->rowCount() ." filas insertadas<br>"; 
        }else{
            print_r($db->errorInfo());
        }
        echo "ID de fila insertada: ". $db->lastInsertId() ."<br>";


        //BORRAR CONEXION
        $db = NULL;
        unset($db);
        //MANEJO DE ERRORES
    }catch(PDOException $e){
        echo 'Error al conectar con la base de datos ' . $e->getMessage();
    }

?>