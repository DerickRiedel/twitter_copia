<?php 
	$erro_name = isset($_GET['erro_name']) ? $_GET['erro_name'] : 0;
	$erro_email = isset($_GET['erro_email']) ? $_GET['erro_email'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Twitter</title>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

        <!-- bootstrap - link cdn -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body style="background-image: url('imagens/background.jpg')">
        <nav class="navbar navbar-expand navbar-dark bg-primary" style="box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 2px;">
            <a class="navbar-brand mx-5" href="#">
                <img src="imagens/icons/iconetwitter.png" height="64px">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-5 ml-3">
                        <a class="btn btn-outline-light" href="index.php">Voltar</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container" >
                <form style="margin: 50px auto; width: 50vw;"  method="post" action="UserController.php?acao=insert" id="formCadastrarse">
                    <div class="form-group">
                        <label for="exampleInputName1">Nome</label>
                        <input type="name" class="form-control" id="usuario" name="name" placeholder="Usuário" >
                        <?php 
                            if($erro_name){
                                echo "<font color='red'>Nome já existente</font>";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" aria-describedby="emailHelp">
                        <?php 
                            if($erro_email){
                                echo "<font color='red'>Email já existente</font>";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Senha</label>
                        <input type="password" class="form-control"  id="senha" name="pass" placeholder="Senha" >
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Inscrever-se</button>
                </form>
            
        </div>
        
    </body>
</html>