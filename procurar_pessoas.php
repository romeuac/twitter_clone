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
                $("#btn_procurar_pessoa").click( function () {
                    var nome_pessoa = $("#nome_pessoa").val();
  
                    // Para que nao seja enviada ao banco tweets vazios
                    if ( nome_pessoa.length > 0 ){                       

                        // Demanda um paramentro JSON
                        $.ajax({
                            url: "get_pessoa.php",

                            method: "POST",
                            
                            data: $("#form_procurar_pessoa").serialize(),

                            //data: {nome_pessoa: nome_pessoa},

                            success: function (data){
                                $("#pessoas").html(data);

                                $(".btn_seguir").click(function(){
                                    // alert("Btn seguir");
                                    var id_usuario_seguido = $(this).data("id_usuario");
                                    // alert(id_usuario_seguido);

                                    $("#btn_seguir"+id_usuario_seguido).hide();
                                    $("#btn_deixar_seguir"+id_usuario_seguido).show();

                                    $.ajax({
                                        url: "seguir.php",
                                        method: "POST",
                                        data: {seguir_id_usuario: id_usuario_seguido},
                                        success: function (data){
                                            alert("Registro seguido com sucesso");
                                            // alert(data);
                                        }
                                    });

                                });

                                $(".btn_deixar_seguir").click(function(){
                                    // alert("Btn seguir");
                                    var id_usuario_seguido = $(this).data("id_usuario");
                                    // alert(id_usuario_seguido);

                                    $("#btn_deixar_seguir"+id_usuario_seguido).hide();
                                    $("#btn_seguir"+id_usuario_seguido).show();

                                    $.ajax({
                                        url: "deixar_seguir.php",
                                        method: "POST",
                                        data: {deixar_seguir_id_usuario: id_usuario_seguido},
                                        success: function (data){
                                            alert("Registro DES-seguido com sucesso");
                                            // alert(data);
                                        }
                                    });

                                });
                            }
                        });

                    }

                });

                // $("#autoCompInput").bind("keypress", {}, keypressInBox);

                // function keypressInBox(e) {
                //     var code = (e.keyCode ? e.keyCode : e.which);
                //     if (code == 13) { //Enter keycode                        
                //         e.preventDefault();

                //         $("#form_procurar_pessoa").submit();
                //     }
                // };

                

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
                <li><a href="home.php">Home</a></li>
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

            <!--Coluna do meio, de procurar pessoas-->
	    	<div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <form class="input-group" id="form_procurar_pessoa">
                            <input type="text" placeholder="Who are you looking for..?" class="form-control" id="nome_pessoa" name="nome_pessoa" action="" method="">

                            <span class="input-group-btn">
                            <button type="button" id="btn_procurar_pessoa" class="btn btn-default">Search</button></span>
                            
                        </form>
                    </div>
                </div>

                <div class="list-groups" id="pessoas">
                    
                </div>

			</div>

			<div class="col-md-3">

                <div class="panel panel-default text-center">
                    <div class="panel-body">
                        
                    </div>
                </div>
            
            </div>

		</div>

	    </div>
	
		<!-- a ideia de colocar no final eh que deve-se esperar que todos os elementos estejam renderizados ao incluir o JS do bootstrap-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>