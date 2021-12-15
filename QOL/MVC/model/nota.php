<?php
    require_once 'modeloBase.php';

    class Nota extends ModeloBase{
        public $id;
        public $nota;
        public $color;

        public function __construct(){
            parent::__construct();
        }


        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
            return $this;
        }


        public function getNota(){
            return $this->nota;
        }
        public function setNota($nota){
            $this->nota = $nota;
            return $this;
        }


        public function getColor(){
            return $this->color;
        }
        public function setColor($color){
            $this->color = $color;
            return $this;
        }
    }

?>