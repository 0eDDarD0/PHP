<?php

    function limpiaChar($a){
        return stripslashes(trim(htmlspecialchars($a)));
    }

    function getCategorias($db){
        $categorias = [];
        $select = $db->prepare('SELECT * FROM categorias');
        $select->execute();
        while($fila = $select->fetch(PDO::FETCH_ASSOC)){
            $categorias[$fila['id']] = $fila['nombre'];
        }

        return $categorias;
    }



    function getEntradas($db, $cat){
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

        return $entradas;
    }

?>