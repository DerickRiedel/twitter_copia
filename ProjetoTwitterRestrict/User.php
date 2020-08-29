<?php

    class User{

        private $id;
        private $name;
        private $email;
        private $pass;

        public function SetId($id){
            $this->id = $id;
        }
        public function GetId(){
            return $this->id;
        }
        public function SetName($name){
            $this->name = $name;
        }
        public function GetName(){
            return $this->name;
        }
        public function SetEmail($email){
            $this->email = $email;
        }
        public function GetEmail(){
            return $this->email;
        }
        public function SetPass($pass){
            $this->pass = $pass;
        }
        public function GetPass(){
            return $this->pass;
        }

    }
?>