<?php 

    class Connection{
        private $host = "localhost";
        private $dbname = "twitter_db";
        private $user = "root";
        private $pass = "l1nux";

        public function connect(){
            try {
                $conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->pass");

                return $conn;
                
            } catch (PDOException $e) {
                echo '<p>' . $e->getMessage() . '</p>';
            }
        }
    }
?>