<?php
//FUNCION QUE CREA LA CONEXION A LAS BASE DE DATOS
    class Database{
        public function __construct(
            private string $con = 'mysql:dbname=prueba;host=localhost;charset=utf8'
        ){}


        public function conectar(){
            $db = new PDO($this->con, 'fer', 'root');
            return $db;
        }
    }
    
?>