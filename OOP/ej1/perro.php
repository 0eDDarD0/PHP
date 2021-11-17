<?php

    class Perro{
        public function __construct(
            private int $tamanio = 0,
            private string $raza = "",
            private string $color = "",
            private string $nombre = ""
        ){}

        public function mostrar_propiedades(){
            echo "Nombre: ".$this->nombre."<br>
                Raza: ".$this->raza."<br>
                Color: ".$this->color."<br>
                Tamaño: ".$this->tamanio."<br>";
        }    
        
        public function speak(){
            echo "guau guau";
        }

        public function getTamanio()
        {
            return $this->tamanio;
        }
        public function setTamanio($tamanio)
        {
            $this->tamanio = $tamanio;
            return $this;
        }
        
        public function getRaza()
        {
            return $this->raza;
        }
        public function setRaza($raza)
        {
            $this->raza = $raza;
            return $this;
        }

        public function getColor()
        {
            return $this->color;
        }
        public function setColor($color)
        {
            $this->color = $color;
            return $this;
        }

        public function getNombre()
        {
            return $this->nombre;
        }
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
            return $this;
        }
    }
?>