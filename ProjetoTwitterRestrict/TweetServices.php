<?php
    class TweetServices{
        private $conn;

        function __construct(Connection $conn){
            $this->conn = $conn->connect();
        }

        function Insert(Tweet $tweet){
            $strSQL = "INSERT INTO tweets (id_user, msg_tweet) 
                        VALUES (:id_user, :msg_tweet)";

            $stmt = $this->conn->prepare($strSQL);

            $stmt->bindValue(':id_user',$tweet->GetIdUser());
            $stmt->bindValue(':msg_tweet',$tweet->GetMsg());

            if($stmt->execute()){
                echo "Tweet inserido!";
            }else{
                echo "Tweet não inserido!";
            }
        }

        public function DeleteTweetsById($idTweet){
            $strSQL = "DELETE FROM tweets WHERE id_tweet = :idTweet";

            $stmt = $this->conn->prepare($strSQL);
            $stmt->bindValue(':idTweet',$idTweet);
            $stmt->execute();
        }

        public function GetTweetsByIdUser($id_user){
            $strSQL = "SELECT u.name_user, DATE_FORMAT(t.data_tweet, '%d/%m/%Y - %T') AS data_tweet,t.id_tweet ,t.msg_tweet FROM tweets AS t ";
            $strSQL .= "JOIN users AS u ON (t.id_user = u.id_user) ";
            $strSQL .= "WHERE t.id_user = :id_user ORDER BY data_tweet DESC ";
            $stmt = $this->conn->prepare($strSQL);
            $stmt->bindValue(':id_user',$id_user);
            
            $stmt->execute();
        
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function GetTweets(){
            $strSQL = "SELECT u.name_user, u.id_user, DATE_FORMAT(t.data_tweet, '%d/%m/%Y - %T') AS data_tweet,t.id_tweet ,t.msg_tweet FROM tweets AS t ";
            $strSQL .= "JOIN users AS u ON (t.id_user = u.id_user) ORDER BY data_tweet DESC";
            $stmt = $this->conn->prepare($strSQL);
            
            $stmt->execute();
        
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }

?>