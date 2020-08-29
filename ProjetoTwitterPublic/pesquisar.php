<?php 
    session_start();
    if(!isset($_SESSION['name_user'])){
        header('location: index.php?erro=1');
    }
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
		
		<script type="text/javascript">
			$(document).ready(function(){
				$('#btn_pesquisar_pessoa').click(function(){
					var nomePessoa = $('#nome_pessoa').val();
					if(nomePessoa != ''){
						$.ajax({
							method: 'post',
							data: {nome: nomePessoa},
							url: 'UserController.php?acao=getUsersByName',
							success: function(data){
								$('#users').html(data);

								$('.btn_seguir').click( function(){
									var idFollowed = $(this).data('id_followed');

									$('#btn_seguir_'+idFollowed).hide();
									$('#btn_deixar_seguir_'+idFollowed).show();


									$.ajax({
										url: 'FollowController.php?acao=insert',
										method: 'post',
										data: {id_followed: idFollowed},
										success: function(data){
											atualizarFolloweds();
										}
									})
								});

								$('.btn_deixar_seguir').click( function(){
									var idFollowed = $(this).data('id_followed');

									$('#btn_seguir_'+idFollowed).show();
									$('#btn_deixar_seguir_'+idFollowed).hide();

									$.ajax({
										url: 'FollowController.php?acao=delete',
										method: 'post',
										data: {id_followed: idFollowed},
										success: function(data){
											atualizarFolloweds();
										}
									})
								})
							}
						});
					}
				});
				
				atualizarFolloweds()

				function atualizarFolloweds(){
					$.ajax({
						url:'FollowController.php?acao=getFolloweds',
						success: function(data){
							$('#followeds').html(data);
						}
					});
				}
			});
		</script>
	</head>
	<body>
		<nav class="navbar navbar-expand navbar-dark bg-primary" style="box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 2px;">
			<a class="navbar-brand mx-5" href="#">
				<img src="imagens/icons/iconetwitter.png" height="64px">
			</a>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item mr-5 ml-3">
                        <a class="btn btn-outline-light" href="UserController.php?acao=sair">Sair</a>
					</li>
				</ul>
			</div>
		</nav>
		
		<div class="container">
			<div class="row">
				
				<div class="col-md-3">
					<div class="card" style="background-color: white ;margin: 10px;">
						<div class="card-body">
							<img src="imagens/icons/account_icon.png" style="height: 48px; border-radius: 50px;">
								<h4><?= $_SESSION['name_user']?></h4>
							<br><br>
							<div class="row">
								<div class="col-md-6">
									Tweets <br> <?php  ?>
								</div>
								<div class="col-md-6">
									Seguidores <br> 8.940.560
								</div>
							</div>
							
						</div>
					</div>
					
					<ul class="nav flex-column nav-pills" style="margin: 10px;">
						<a class="nav-link" href="home.php">Home</a>
						<a class="nav-link active" href="pesquisar.php">Pesquisar</a>
					</ul>

				</div>
		
				<div class="col-md-6">
                    <form class="input-group flex-nowrap" id="form_pesquisar_pessoas" style="margin: 10px auto;">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping">@</span>
                        </div>
                        <input type="text" class="form-control" id="nome_pessoa" placeholder="Quem você está procurando?" maxlength="50" aria-label="Username" aria-describedby="addon-wrapping">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="btn_pesquisar_pessoa">Pesquisar</button>
                        </div>
					</form>
					<ul style="margin: 5px auto;" id="users" class="list-group list-group" >
					</ul>
				</div>

				<div class="col-md-3">
					<ul style="margin: 10px auto;" id="followeds" class="list-group list-group" >
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>