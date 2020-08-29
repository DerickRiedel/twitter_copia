<?php

    require_once '../ProjetoTwitterRestrict/User.php';
    require_once '../ProjetoTwitterRestrict/UserServices.php';
    require_once '../ProjetoTwitterRestrict/Connection.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    function GetByName(Connection $conn, $user_name){
        $userService = new UserServices($conn);

        $dataUser = $userService->GetUserByName($user_name);

        if(sizeof($dataUser) > 0){
            return true;
        }else{
            return false;
        };
    }



    function GetByEmail(Connection $conn, $user_email){
        $userService = new UserServices($conn);

        $dataUser = $userService->GetUserByEmail($user_email);

        if(sizeof($dataUser) > 0){
            return true;
        }else{
            return false;
        };
    }


    if($acao == 'insert'){
        $user = new User();
        $user->SetName($_POST['name']);
        $user->SetEmail($_POST['email']);
        $user->SetPass(md5($_POST['pass']));

        $conn = new Connection();

        if(GetByName($conn,$user->GetName())){
            header('location: inscrevase.php?erro_name=1');
        }
        else if(GetByEmail($conn,$user->GetEmail())){
            header('location: inscrevase.php?erro_email=1');
        }else{
            $userService = new UserServices($conn);
            $userService->Insert($user);
            header('location: index.php');
        }
        
    }else if($acao == 'login'){
        session_start();

        $email = $_POST['email'];
        $pass = md5($_POST['pass']);
        $conn = new Connection();

        $userService = new UserServices($conn);
        $userData = $userService->GetLogin($email,$pass);

        if(sizeof($userData) > 0){

            $_SESSION['id_user'] = $userData[0]->id_user;
            $_SESSION['name_user'] = $userData[0]->name_user;
            $_SESSION['email_user'] = $userData[0]->email_user;
            $_SESSION['numeroTweets'] = 0;
            header('location: home.php');
        }else{
            header('location: index.php?erro=1');
        }
    }else if($acao == 'sair'){
        session_start();
        unset($_SESSION['id_user']);
        unset($_SESSION['name_user']);
        unset($_SESSION['email_user']);
        unset($_SESSION['numeroTweets']);
        header('location: index.php');    
    }else if($acao == 'getUsersByName'){
        session_start();

        $conn = new Connection();

        $userService = new UserServices($conn);

        $usersList = $userService->GetUsersByName($_POST['nome'],$_SESSION['id_user']);

        // echo '<pre>';
        // print_r($usersList);
        // echo '</pre>';

        foreach ($usersList as $user => $value) {
            
            echo '<li class="list-group-item list-group-item-action">';
                echo '<h5 class="list-group-item-heading">';
                    echo '<img height="42px" style="margin-right: 10px" src="imagens/icons/account_icon.png">'.$value->name_user.'<small> - '.$value->email_user.'</small>';
                echo '</h5>';
                echo '<p class="list-group-item-text" style="margin: 10px; position: absolute; bottom: 0; right: 0;">';
                
                $esta_seguindo = isset($value->id_followed) && !empty($value->id_followed) ? 'S' : 'N';
                
                $btn_seguir_display = 'block';
                $btn_deixar_seguir_display = 'block'; 
                
                if($esta_seguindo == 'N'){
                    $btn_deixar_seguir_display = 'none';
                }else{
                    $btn_seguir_display = 'none';
                }

                echo '<button type="button" id="btn_seguir_'.$value->id_user.'" class="btn btn-outline-primary btn-sm btn_seguir" style = "display: '.$btn_seguir_display.'" data-id_followed="'.$value->id_user.'" >Seguir</button>';
                echo '<button type="button" id="btn_deixar_seguir_'.$value->id_user.'" class="btn btn-outline-primary active btn-sm btn_deixar_seguir" style = "display: '.$btn_deixar_seguir_display.'" data-id_followed="'.$value->id_user.'" >Deixar de Seguir</button>';
                echo '</p>';
            echo '</li>';
        }
    }

?>

