<?php
    // Startando a sessao para recuperar nome do usuario
    session_start();

    // Ao fazer este teste verifica se existe um usuario ja autorizado que foi inscrito anteriorment na variavel de sessao, caso contratio manda para home.php
    if (!$_SESSION["usuario"]){
        header("Location: index.php?erro=2");
    }

    require_once ('db.class.php'); 

    $id_usuario = $_SESSION["id_usuario"];
    $deixar_seguir_id_usuario = $_POST["deixar_seguir_id_usuario"];

    if ($id_usuario != '' && $deixar_seguir_id_usuario != ''){
        // Instanciando o objeto
        $objDb = new db();
        $link = $objDb->conecta_mysql();

        $sql = "DELETE FROM usuarios_seguidores WHERE id_usuario = $id_usuario AND id_usuario_seguido = $deixar_seguir_id_usuario";

        // echo $sql;
        mysqli_query ($link, $sql);

    }

?>