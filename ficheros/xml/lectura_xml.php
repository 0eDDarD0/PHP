<?php

    //validamos el fichero xml con la clase DOMDocument
    $dept = new DOMDocument();
    $dept->load('empleados.xml');
    $valid = $dept->schemaValidate('departamento.xsd'); //validamos en funcion del xml schema
    if($valid){
        //cargamos el contenido de un fichero xml en un array
        $fichxml = simplexml_load_file("empleados.xml");

        //imprimimos el contenido
        //if($fichxml){
        //    foreach($fichxml as $i){
        //        print_r($i);
        //        echo "<br>";
        //    }
        //}

        //cargamos todos los valores de un elemento en un array con el metodo xpath
        $nombres = $fichxml->xpath("//nombre");
        foreach($nombres as $i){
            echo $i[0];
            echo "<br>";
        }

    }else{
        echo "ERROR EN LA VALIDACION DEL FICHERO XML";
    }

    

?>