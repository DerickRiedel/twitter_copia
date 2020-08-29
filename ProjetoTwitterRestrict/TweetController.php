<?php

    require_once '../ProjetoTwitterRestrict/Tweet.php';
    require_once '../ProjetoTwitterRestrict/TweetServices.php';
    require_once '../ProjetoTwitterRestrict/Connection.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if($acao == 'insert'){
        session_start();
        $tweet = new Tweet();
        $tweet->SetIdUser($_SESSION['id_user']);
        $tweet->SetMsg($_POST['msg_tweet']);

        $conn = new Connection();

        $tweetService = new TweetServices($conn);
        $tweetService->Insert($tweet);
    }else if($acao == 'getTweetsByIdUser'){
        session_start();

        $conn = new Connection();

        $tweetService = new TweetServices($conn);
        $tweetsList = $tweetService->GetTweetsByIdUser($_SESSION['id_user']);

        // echo '<pre>';
        // print_r($tweetsList);
        // echo '</pre>';

        $numeroTweets = sizeof($tweetsList);

        if($tweetsList != null){
            foreach ($tweetsList as $tweet => $value) {
            echo '<li data-numero_tweets="'.$numeroTweets.'" class="list-group-item" action="TweetController.php?acao=delete">';
                echo '<form>';
                    echo '<h4 class="list-group-item-heading"><img height="42px" style="margin-right: 10px" src="imagens/icons/account_icon.png">'.$value->name_user.'<small> - '.$value->data_tweet.'</small>';
                    echo '</h4>';
                    echo '<p class="list-group-item-text">'.$value->msg_tweet;
                    echo '<a style="margin: 10px; position: absolute; bottom: 0; right: 0;" class="btn btn-outline-danger" href='.'TweetDelete.php?idTweet='.$value->id_tweet.'>Excluir</a>';
                echo '</form>';
            echo '</li>';
        }}

    }else if($acao == 'getTweets'){
        session_start();

        $conn = new Connection();

        $tweetService = new TweetServices($conn);
        $tweetsList = $tweetService->GetTweets();

        foreach ($tweetsList as $tweet => $value) {
            echo '<li class="list-group-item" action="TweetController.php?acao=delete">';
                echo '<form>';
                    echo '<h4 class="list-group-item-heading"><img height="42px" style="margin-right: 10px" src="imagens/icons/account_icon.png">'.$value->name_user.'<small> - '.$value->data_tweet.'</small>';
                    echo '</h4>';
                    echo '<p class="list-group-item-text">'.$value->msg_tweet;
                    if($value->id_user == $_SESSION['id_user']){
                        echo '<a style="margin: 10px; position: absolute; bottom: 0; right: 0;" class="btn btn-outline-danger" href='.'TweetDelete.php?idTweet='.$value->id_tweet.'>Excluir</a>';
                    }
                echo '</form>';
            echo '</li>';
        }


    }else if($acao == 'delete'){
        session_start();

        echo $idTweet;

        $conn = new Connection();

        $tweetService = new TweetServices($conn);
        $tweetService->DeleteTweetsById($idTweet);
        header('location: home.php');
    }
?>