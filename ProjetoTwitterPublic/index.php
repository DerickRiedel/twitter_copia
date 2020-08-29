<?php
	$erro = isset($_GET['erro']) ? $_GET['erro'] : '0';
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Twitter</title>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

            <!-- bootstrap - link cdn -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <script>
            $(document).ready( function(){

                $('#btn_login').click( function(){
                    var empty_field = false;
                    
                    if($('#campo_email').val() == ''){
                        $('#campo_email').css({'border-color':'#a94442'});
                        empty_field = true;
                    }else{
                        $('#campo_email').css({'border-color':'#cccccc'});
                    }

                    if($('#campo_senha').val() == ''){
                        $('#campo_senha').css({'border-color':'#a94442'});
                        empty_field = true;
                    }else{
                        $('#campo_senha').css({'border-color':'#cccccc'});
                    }

                    if(empty_field == true){
                        return false;
                    }
                });
            });
        </script>

    </head>
    <body style="background-image: url('imagens/background.jpg')">
        <nav class="navbar navbar-expand navbar-dark bg-primary" style="box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 2px;">
            <a class="navbar-brand mx-5" href="#">
                <img src="imagens/icons/iconetwitter.png" height="64px">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="btn btn-outline-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Entrar
                        </a>
                        <form class="dropdown-menu p-3" style="width: 200px;" method="post" action="UserController.php?acao=login">
                            <div class="form-group w-100">
                                <label for="exampleDropdownFormEmail2">Email address</label>
                                <input type="email" class="form-control" id="campo_email" name="email" placeholder="Email" >
                            </div>
                            <div class="form-group">
                                <label for="exampleDropdownFormPassword2">Password</label>
                                <input type="password" class="form-control" id="campo_senha" name="pass" placeholder="Senha">
                            </div>
                            <button type="buttom" class="btn btn-outline-primary">Log in</button>
                            <?php 
                                if($erro > 0){
                                    echo '<br>';
                                    echo '<font color="red">Login ou senha inválidos</font>';
                                }
                            ?>
                        </form>
                    </li>
                    <li class="nav-item mr-5 ml-3">
                        <a class="btn btn-outline-light" href="inscrevase.php">Inscreva-se</a>
                    </li>
                    
                </ul>
            </div>
        </nav>
        <div class="jumbotron jumbotron-fluid" style="background-color: rgba(255, 255, 255, 0.473);">
            <div class="container">
                <h1 class="display-4">Bem-Vindo ao Twitter Clone!</h1>
                <p class="lead">Veja o que está acontecendo agora...</p>
            </div>
        </div>
        
    </body>
</html>