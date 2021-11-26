<?php

    //METODO DOS (EL BUENO)
    $con = 'mysql:dbname=proyecto1;host=localhost;charset=utf8';
    try{
        $db = new PDO($con, 'fer', 'root');
        echo "conectado correctamente a la base de datos";
        $db = NULL;
        unset($db);
    }catch(PDOException $e){
        echo 'Error al conectar con la base de datos ' . $e->getMessage();
    }

?>


<!--METODO UNO (NO LO HAGAS NO LE GUSTA A BELEN)
    $db = new mysqli('localhost', 'fer', 'root', 'proyecto1');

    if($db->connect_error){
        die('ERROR: No se pudo conectar a la base de datos' . $db->connect_error);
    }

    echo "conectado correctamente a la base de datos";-->