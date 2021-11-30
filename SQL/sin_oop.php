<?php

    $con = @mysqli_connect('localhost', 'fer', 'root', 'prueba');
    if(!mysqli_connect_errno()){
        mysqli_query($con, "SET NAME 'utf-8'"); //nos aseguramos de qu ela codificacion sea utf 8

        //SELECT
        $query = mysqli_query($con, "SELECT * FROM nota"); //recogemos la query en una variable
        while($elem = mysqli_fetch_assoc($query)){  //a la variable se le podra hacer fetch tantas veces como elementos haya
            print_r($elem);
            echo '<br>';
        }

        //INSERT
        $insert = mysqli_query($con, 'INSERT INTO nota values(null, "nota insertada desde php", "azul");');
        if($insert){
            echo "insercion con exito<br>";
        }else{
            echo "error en la insercion<br>";
        }

        //DELETE
        $delete = mysqli_query($con, 'DELETE FROM nota WHERE color = "azul";');
        if($delete){
            echo "borrado con exito<br>";
        }else{
            echo "error en el borrado<br>";
        }

    }else{
        echo "Error en la conexion";
    }

?>