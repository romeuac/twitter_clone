<?php
    // Startando a sessao para recuperar nome do usuario
    session_start();

    // Ao fazer este teste verifica se existe um usuario ja autorizado que foi inscrito anteriorment na variavel de sessao, caso contratio manda para home.php
    if (!$_SESSION["usuario"]){
        header("Location: index.php?erro=2");
    }

    require_once ('db.class.php'); 

    $id_usuario = $_SESSION["id_usuario"];
    $seguir_id_usuario = $_POST["seguir_id_usuario"];

    if ($id_usuario != '' && $seguir_id_usuario != ''){
        // Instanciando o objeto
        $objDb = new db();
        $link = $objDb->conecta_mysql();

        $sql = "INSERT INTO usuarios_seguidores(id_usuario, id_usuario_seguido) Values($id_usuario ,$seguir_id_usuario)";

        // echo $sql;
        mysqli_query ($link, $sql);

    }

?>