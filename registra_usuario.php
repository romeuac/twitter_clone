<?php

    require_once ('db.class.php'); 

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $email =  $_POST["email"];

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    // Instrucao SQL
    $sql = "insert into usuarios(usuario, email, senha) Values('$usuario','$email','$senha')";

    // Precisamos executar a query mysqli_query ( conexao , query)
    if( mysqli_query ($link, $sql) ){
        echo "<br>Registro incluído com sucesso<br>";
    }else {
        echo "<br>Erro ao registrar usuário<br>";
    }
    
    
?>