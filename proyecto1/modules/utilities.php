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
        $select = $db->prepare('SELECT * FROM entradas where categoria_id=:cat');
        $select->bindValue(':cat', $cat);
        $select->execute();
        while($fila = $select->fetch(PDO::FETCH_ASSOC)){
            $entradas[$fila['titulo']] = $fila['descripcion'];           
        }

        return $entradas;
    }

?>