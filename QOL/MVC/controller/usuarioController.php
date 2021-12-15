<?php

    class UsuarioController{

        public function listar(){
            //MODELO
            require_once 'model/usuario.php';

            //CONTROLADOR
            $usuario = new Usuario('usuario', 'usuario@gmail.com', '1234');
            $usuarios = $usuario->conseguirTodos('usuario');

            //VISTA
            require_once 'view/usuario/listar.php';
        }
    }

?>