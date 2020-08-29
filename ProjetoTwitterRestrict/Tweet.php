<?php

    class Tweet{
        private $id;
        private $idUser;
        private $msg;
        private $date;

        public function SetId($id){
            $this->id = $id;
        }
        public function GetId(){
            return $this->id;
        }
        public function SetIdUser($idUser){
            $this->idUser = $idUser;
        }
        public function GetIdUser(){
            return $this->idUser;
        }
        public function SetMsg($msg){
            $this->msg = $msg;
        }
        public function GetMsg(){
            return $this->msg;
        }
        public function SetDate($date){
            $this->date = $date;
        }
        public function GetDate(){
            return $this->date;
        }
    }
?>