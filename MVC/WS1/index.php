<?php

    //CARGAMOS TODOS LOS CONTROLADORES
    require_once './controller/usuarioController.php';
    require_once './controller/notaController.php';

    //COMPROBAMOS SI SE HA PASADO UN CONTROLADOR POR GET, SI SE PASA SE GUARDA
    if(isset($_GET['controller'])){
        $nombre_controlador = $_GET['controller'].'Controller';
    }else{
        echo 'error no se ha pasado un controlador';
    }

    //COMPROBAMOS SI EXISTE EL CONTROLADOR
    if(class_exists($nombre_controlador)){
        $controlador = new $nombre_controlador();
        //COMPROBAMOS SI EXISTE EL METODO PASADO PARA EL CONTROLADOR
        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
            $action = $_GET['action'];
            //LLAMAMOS AL METODO
            $controlador->$action();
        }else{
            echo 'error no existe el metodo';
        }
    }else{
        echo 'error no existe el controlador';
    }

?>