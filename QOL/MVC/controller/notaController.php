<?php

    class NotaController{

        public function listar(){
            //MODELO
            require_once 'model/nota.php';

            //CONTROLADOR
            $nota = new Nota();
            $notas = $nota->conseguirTodos('nota');

            //VISTA
            require_once 'view/nota/listar.php';
        }
    }

?>