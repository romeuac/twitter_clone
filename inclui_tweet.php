<?php
    // Startando a sessao para recuperar nome do usuario
    session_start();

    // Ao fazer este teste verifica se existe um usuario ja autorizado que foi inscrito anteriorment na variavel de sessao, caso contratio manda para home.php
    if (!$_SESSION["usuario"]){
        header("Location: index.php?erro=2");
    }

    require_once ('db.class.php'); 

    $texto_tweet = $_POST["texto_tweet"];
    $id_usuario = $_SESSION["id_usuario"];

    if ($id_usuario != '' && $texto_tweet != ''){
        // Instanciando o objeto
        $objDb = new db();
        $link = $objDb->conecta_mysql();

        $sql = "INSERT INTO tweets(id_usuario, tweet) Values($id_usuario ,'$texto_tweet')";

        mysqli_query ($link, $sql);

    }

?>