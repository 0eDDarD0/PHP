<?php
    require_once "interfaces.php";

    //Las interfaces son plantillas de metodos para las clases que hereden de ellas
    //no da funcionalidad pero da rigor y seguridad en el codigo (DEV)
    interface Ordenador{    
        public function encender();
        public function apagar();
        public function reiniciar();
        public function formatear();
        public function detectarUSB();
    }

    //Las clases que implementen de una interfaz deberan implementar los metodos de esta
    //si no se hace se lanzara un error fatal en la ejecucion (DEV)
    class PC implements Ordenador{
        private bool $encendido = false;
        private array $disco = [];
        private bool $usb = false;

        //Metodo que crea el printable del objeto
        public function __toString(){
            return $this->encendido ? "El PC esta encendido" : "El PC esta apagado";
        }

        //Metodo que se llama cuando se ha llamado a un metodo que no existe o es inaccesible (DEV)
        //name es el nombre del metodo llamado y arguments sus argumentos
        public function __call($name, $arguments){
            echo "El metodo: " . $name . "(" . $arguments . ") No existe o no es accesible";
        }

        public function encender(){
            $this->encendido = true;
        }

        public function apagar(){
            $this->encendido = false;
        }
        
        public function reiniciar(){
            $this->encendido = false;
            $this->encendido = true;
        }

        public function formatear(){
            $this->disco = [];
        }
        public function detectarUSB(){
            $this->usb = true;
        }
    }


    //La keyword final evita la herencia de la propiedad (DEV)
    //Si se añade a la clase esta no podrá ser heredada por ninguna otra
    final class Unico{

        //Si se añade a un metodo este no sera heredado por sus hijos
        final function unica(){
            echo "Estoy muy solo :(";
        }
    }


    //Las clases abstractas nos permiten: (DEV)
    //definir propiedades y metodos para ser heredados
    //declarar metodos abstractos como plantilla a los hijos
    //la clase abstracta NO PUEDE SER INSTANCIADA
    abstract class SerVivo{
        private bool $vivo = false;

        abstract public function nutricion();
        abstract public function reproduccion();
        abstract public function relacion();

        public function nacer(){
            $this->vivo = true;
            echo "<br>hola, mundo";
        }
        public function morir(){
            $this->vivo = false;
            echo "<br>adios, mundo";
        }
    }

    class Animal extends SerVivo implements YAnimal{
        public function __construct(
            private string $nombre = ""
        ){}

        public function nutricion(){
            echo "<br>ñam ñam";
        }
        public function reproduccion(){
            echo "<br>hola guape";
        }
        public function relacion(){
            echo "<br>charlemos";
        }

        public function andar(){
            echo "<br>Un paseito";
        }
        public function hablar(){
            echo "<br>digamelon";
        }
    }

    $a = new Animal("Pepito");
    $a->nacer();
    $a->hablar();
    $a->andar();
    $a->nutricion();
    $a->reproduccion();
    $a->relacion();
    $a->morir();

?>