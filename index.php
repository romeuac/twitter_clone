<?php

	//Recuperando variavel de erro

	// If denario - Var x ou echo .. = statement ? atribui se true : atribui se false 
	$erro = isset($_GET["erro"])? $_GET["erro"] : 0;


?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
 
		<title>Twitter clone</title>
		<link rel="icon" href="imagens/favicon.png">

		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link         // echo "<br>Usário existe<br>"; cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
		<script> // código javascript	


			$(document).ready(function() {
				var campo_vazio = false;

				$("#btn_login").click(function(){
					if($("#campo_usuario").val() == ""){
						$("#campo_usuario").css("border-color", "#A94442");
						campo_vazio = true;
					} 
					else
						$("#campo_usuario").css("border-color", "#CCC");
				

					if($("#campo_senha").val() == ""){
						$("#campo_senha").css("border-color", "#A94442");
						campo_vazio = true;
					} 
					else
						$("#campo_senha").css("border-color", "#CCC");
					

					// Para impedir que a pagina recarregue (evento click faça algo)
					if (campo_vazio) return false;
					
				});
				
				

			}); 
		</script>
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="imagens/icone_twitter.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">

	            <li><a href="inscrevase.php">Sign up</a></li>
							<!--Usando outra tag do php para setar a class open-->
	            <li class="<?= ($erro==1) ? 'open' : '' ?>">
	            	
								<a id="entrar" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Log in</a>
								<ul class="dropdown-menu" aria-labelledby="entrar">
									<div class="col-md-12">
										
										<p>Do you have an account?</h3>
										<br />
										<form method="post" action="valida_acesso.php" id="formLogin">
											<div class="form-group">
												<input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="User" />
											</div>
											
											<div class="form-group">
												<input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Password" />
											</div>
											
											<button type="buttom" class="btn btn-primary" id="btn_login">Entrar</button>

											<br /><br />
											
										</form>
										<?php 
											if ($erro == 1){
												echo "<font color='#FF0000'> Invalid password and or user</font>";
											}
										
										?>
									</form>
				  			</ul>
	            </li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">

	      <!-- Main component for a primary marketing message or call to action -->
	      <div class="jumbotron">
	        <h1>Welcome to twitter clone</h1>
	        <p>See what's happening now...</p>
	      </div>

	      <div class="clearfix"></div>
			</div>

	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>