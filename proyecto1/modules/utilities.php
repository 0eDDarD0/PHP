<?php

    function limpiaChar($a){
    //FUNCION DE VALIDACION DE FORMULARIOS
        return stripslashes(trim(htmlspecialchars($a)));
    }

    function getCategorias($con){
    //FUNCION QUE DEVUELVE UN ARRAY ASOCIATIVO CON TODAS LAS CATEGORIAS A[ID] => NOMBRE

        try{
            $db = new PDO($con, 'fer', 'root');
    
            $categorias = [];
            $select = $db->prepare('SELECT * FROM categorias');
            $select->execute();
            while($fila = $select->fetch(PDO::FETCH_ASSOC)){
                $categorias[$fila['id']] = $fila['nombre'];
            }
    
            $db = NULL;
            unset($db);
        }catch(PDOException $e){
            echo 'Error al conectar con la base de datos ' . $e->getMessage();
        }


        return $categorias;
    }



    function getEntradas($con, $cat){
    //FUNCION QUE DEVUELVE UN ARRAY ASOCIATIVO CON LAS ENTRADAS DE UNA CATEGORIA A[ID] => [USUARIO_ID, CATEGORIA_ID, TITULO, DESCRIPCION]

        try{
            $db = new PDO($con, 'fer', 'root');
    
            $entradas = [];
            if($cat == -1){ //si se le pasa -1 como parámetro devolvera todas las entradas de todas las categorias
                $select = $db->prepare('SELECT * FROM entradas');
            }else{ //si no devolvera las entradas de la categoria correspondiente
                $select = $db->prepare('SELECT * FROM entradas where categoria_id=:cat');
                $select->bindValue(':cat', $cat);
            }
            $select->execute();
            while($fila = $select->fetch(PDO::FETCH_ASSOC)){
                $entradas[$fila['id']] = [
                    'usuario' => $fila['usuario_id'],
                    'categoria' => $fila['categoria_id'],
                    'titulo' => $fila['titulo'],
                    'descripcion' => $fila['descripcion']
                ];           
            }    
    
            $db = NULL;
            unset($db);
        }catch(PDOException $e){
            echo 'Error al conectar con la base de datos ' . $e->getMessage();
        }


        return $entradas;
    }

?>