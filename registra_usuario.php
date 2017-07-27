<?php

    require_once ('db.class.php'); 

    $usuario = $_POST["usuario"];
    $senha = md5($_POST["senha"]);
    $email =  $_POST["email"];

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    // Verificar se o usuario ja existe

    $sql = "SELECT email, usuario FROM usuarios WHERE email = '$email' OR usuario = '$usuario'";

    $retorno = mysqli_query ($link, $sql);
 
    $dados_usuarios = array();


    $retorno_get = "";

    while ($linha = mysqli_fetch_array ($retorno, MYSQLI_ASSOC) and !empty($retorno)){
        $dados_usuarios[] = $linha;
        if ($linha['email']==$email){
            $retorno_get = $retorno_get."erro_email=1&";
        }
        if ($linha['usuario']==$usuario){
            $retorno_get = $retorno_get."erro_usr=1&";
        }
    }
    // echo "<br>";
    // var_dump($dados_usuarios);
    // echo "<br>";
    if (!empty($dados_usuarios)){
        echo "<br>This user or email is already registred<br>";

        header("Location: inscrevase.php?".$retorno_get);

    }else{
        // Instrucao SQL
        $sql = "insert into usuarios(usuario, email, senha) Values('$usuario','$email','$senha')";

        // Precisamos executar a query mysqli_query ( conexao , query)
        if( mysqli_query ($link, $sql) ){
            echo "<br>Registro incluído com sucesso<br>";
        }else {
            echo "<br>Erro ao registrar usuário<br>";
        }
    }
    

    // Tudo que tiver abaixo do die nao e' realizado
    // die();
    
?>