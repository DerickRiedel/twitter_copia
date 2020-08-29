<?php 
     class FollowServices{
        private $conn;

        function __construct(Connection $conn){
            $this->conn = $conn->connect();
        }

        function Insert(Follow $follow){
            $strSQL = "INSERT INTO followers (id_follower, id_followed) 
                        VALUES (:idFollower, :idFollowed)";

            $stmt = $this->conn->prepare($strSQL);

            $stmt->bindValue(':idFollower', $follow->GetIdFollower());
            $stmt->bindValue(':idFollowed', $follow->GetIdFollowed());

            if($stmt->execute()){
                echo "Seguindo!";
            }else{
                echo "Erro! Não foi possível seguir";
            }
        }

        function Delete(Follow $follow){
            $strSQL = "DELETE FROM followers WHERE id_follower = :idFollower AND  
                        id_followed = :idFollowed";

            $stmt = $this->conn->prepare($strSQL);

            $stmt->bindValue(':idFollower', $follow->GetIdFollower());
            $stmt->bindValue(':idFollowed', $follow->GetIdFollowed());

            if($stmt->execute()){
                echo "Deixou de seguir!";
            }else{
                echo "Erro! Não foi possível deixar de seguir";
            }
        }
        
        public function GetFolloweds($userId){
            //$strSQL = "SELECT * FROM followers WHERE id_follower = :idFollower";
            $strSQL = " SELECT u.name_user, u.id_user, f.id_follower, f.id_followed FROM followers as f";
            $strSQL .= " JOIN users AS u ON (u.id_user = f.id_followed) WHERE f.id_follower = :idFollower";
            $stmt = $this->conn->prepare($strSQL);
            $stmt->bindValue(':idFollower',$userId);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>