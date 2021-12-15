<?php
require_once 'modeloBase.php';

    class Usuario extends ModeloBase{
        public function __construct(
            private string $user,
            private string $email,
            private string $password
        ){}

        
        public function getUser(){
            return $this->user;
        }
        public function setUser($user){
            $this->user = $user;
            return $this;
        }


        public function getEmail(){
            return $this->email;
        }
        public function setEmail($email){
            $this->email = $email;
            return $this;
        }


        public function getPassword(){
            return $this->password;
        }
        public function setPassword($password){
            $this->password = $password;
            return $this;
        }
    }

?>