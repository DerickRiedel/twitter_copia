<?php 
    class Follow{

        private $id;
        private $idFollower;
        private $idFollowed;

        public function GetId(){
            return $this->id;
        }
        public function SetId($id){
            $this->id = $id;
        }

        public function GetIdFollower(){
            return $this->idFollower;
        }
        public function SetIdFollower($idFollower){
            $this->idFollower = $idFollower;
        }

        public function GetIdFollowed(){
            return $this->idFollowed;
        }
        public function SetIdFollowed($idFollowed){
            $this->idFollowed = $idFollowed;
        }

    }
?>