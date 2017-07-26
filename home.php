<?php 
    session_start();

    // Ao fazer este teste verifica se existe um usuario ja autorizado que foi inscrito anteriorment na variavel de sessao, caso contratio manda para home.php
    if (!$_SESSION["usuario"]){
        header("Location: index.php?erro=2");
    }
?>


<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8"> 

		<title>Twitter clone</title>
        <link rel="icon" href="imagens/favicon.png">
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
        <script type="text/javascript">
            $(document).ready( function() {
                // Associar o evento de click ao envio do texto ao BD
                $("#btn_tweet").click( function () {
                    var tweet = $("#texto_tweet").val();

                    // Para que nao seja enviada ao banco tweets vazios
                    if (tweet.length > 0 ){

                        // Demanda um paramentro JSON
                        $.ajax({
                            url: "inclui_tweet.php",

                            method: "post",
                            
                            // data: {chave1: valor1, chave2: valor2,...}
                            //data: {texto_tweet: tweet},
                            // Boa forma de agilizar processo quando existe um grande formulario e vao ser todos passados para o script php, ou seja la onde
                            data: $("#form_tweet").serialize(),

                            success: function (data){
                                $("#texto_tweet").val("");
                                // alert("Tweet incluído com sucesso");
                                atualizaTweet();
                            }
                        });

                    }

                });

                function atualizaTweet (){
                    $.ajax({
                        url: "get_tweet.php",

                        success: function(data){
                            $("#tweets").html(data);
                            // alert(data);
                        }
                    });

                    
                }

                atualizaTweet();

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
	          <a href="home.php"><img src="imagens/icone_twitter.png" /></a>
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="exit.php">Exit</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">

	    	<div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        
                        <h3><?= $_SESSION["usuario"] ?></h3>
                        
                        <div class="col-md-6 text-center">
                            <strong>Tweets</strong><br>
                            <span>1</span>
                        </div>

                        <div class="col-md-6 text-center">
                            <strong>Followers:</strong><br>
                            <span>1</span>
                        </div>

                    </div>
                </div>
            </div>

            <!--Coluna do meio, dos Tweets-->
	    	<div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <form class="input-group" id="form_tweet">
                            <input type="text" placeholder="What's happening now..?" maxlength="140" class="form-control" id="texto_tweet" name="texto_tweet">

                            <span class="input-group-btn">
                            <button type="submit" id="btn_tweet" class="btn btn-default">Tweet</button></span>
                            
                        </form>
                    </div>
                </div>

                <div class="list-groups" id="tweets">
                    
                </div>

			</div>

			<div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4><a href="#">Look for friends</a></h4>
                    </div>
                </div>
            
            </div>

		</div>


	    </div>
	
		<!-- a ideia de colocar no final eh que deve-se esperar que todos os elementos estejam renderizados ao incluir o JS do bootstrap-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>