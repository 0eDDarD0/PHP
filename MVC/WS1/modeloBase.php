<?php
require_once 'config/database.php';

    //PADRE DE TODOS LOS MODELOS
    class ModeloBase{
        public $db;

        public function __construct(){
            //CONSTRUCTOR VACIO
        }

        //SELECT * DE LA TABLA PASADA EN EL CONTROLADOR
        public function conseguirTodos($tabla){
            $database = new Database();
            $this->db = $database->conectar();
            $select = $this->db->prepare("SELECT * FROM ".$tabla);
            //$select->bindParam(':tabla', $t, PDO::PARAM_STR);
            $select->execute();
            return $select;
        }
    }

?>