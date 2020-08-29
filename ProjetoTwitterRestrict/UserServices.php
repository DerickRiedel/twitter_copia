<?php

    class UserServices{
        private $conn;

        function __construct(Connection $conn){
            $this->conn = $conn->connect();
        }

        public function Insert(User $user){
            $strSQL = "INSERT INTO users (name_user, email_user, pass_user) 
                        VALUES (:name_user, :email_user, :pass_user)";

            $stmt = $this->conn->prepare($strSQL);
            $stmt->bindValue(':name_user',$user->GetName());
            $stmt->bindValue(':email_user',$user->GetEmail());
            $stmt->bindValue(':pass_user',$user->GetPass());

            if($stmt->execute()){
                echo "Usuário Salvo!";
            }else{
                echo "Erro! Usuário não Salvo!";
            }
        }

        public function GetLogin($email, $pass){
            $strSQL = 'SELECT * FROM users WHERE email_user = :email_user AND pass_user = :pass_user';
            
            $stmt = $this->conn->prepare($strSQL);
            $stmt->bindValue(':email_user',$email);
            $stmt->bindValue(':pass_user',$pass);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function GetUserByName($user_name){
            $strSQL = "SELECT * FROM users WHERE name_user = :userName";

            $stmt = $this->conn->prepare($strSQL);
            $stmt->bindValue(':userName',$user_name);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function GetUsersByName($userName,$userId){
            $strSQL = " SELECT f.*, u.* FROM users as u";
            $strSQL .= " LEFT JOIN followers AS f ON (u.id_user = f.id_followed) WHERE u.id_user != :userId AND u.name_user LIKE :userName"; 

            $stmt = $this->conn->prepare($strSQL);
            $stmt->bindValue(':userName','%'.$userName.'%');
            $stmt->bindValue(':userId',$userId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        public function GetUserByEmail($user_email){
            $strSQL = "SELECT * FROM users WHERE email_user = :userEmail";

            $stmt = $this->conn->prepare($strSQL);
            $stmt->bindValue(':userEmail',$user_email);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

    }

?>