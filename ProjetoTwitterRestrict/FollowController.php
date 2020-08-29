<?php 
    require_once '../ProjetoTwitterRestrict/Follow.php';
    require_once '../ProjetoTwitterRestrict/FollowServices.php';
    require_once '../ProjetoTwitterRestrict/Connection.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if($acao == 'insert'){
        session_start();

        $follow = new Follow();

        $follow->SetIdFollower($_SESSION['id_user']);
        $follow->SetIdFollowed($_POST['id_followed']);

        $conn = new Connection();

        $followService = new FollowServices($conn);

        echo $_POST['id_followed'];

        $followService->Insert($follow);

    }else if($acao == 'delete'){
        session_start();

        $follow = new Follow();

        $follow->SetIdFollower($_SESSION['id_user']);
        $follow->SetIdFollowed($_POST['id_followed']);

        $conn = new Connection();

        $followService = new FollowServices($conn);

        $followService->Delete($follow);
    }else if($acao == 'getFolloweds'){
        session_start();

        $conn = new Connection();

        $followService = new FollowServices($conn);

        $usersList = $followService->GetFolloweds($_SESSION['id_user']);

        foreach ($usersList as $user => $value) {
            
            echo '<li class="list-group-item list-group-item-action">';
                echo '<small class="list-group-item-heading">';
                    echo '<img height="42px" style="margin-right: 10px" src="imagens/icons/account_icon.png">'.$value->name_user;
                echo '</small>';
                echo '<p class="list-group-item-text" style="margin: 10px; position: absolute; bottom: 0; right: 0;">';
                echo '</p>';
            echo '</li>';
        }
    }
?>