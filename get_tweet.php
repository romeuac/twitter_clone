<?php
    // Startando a sessao para recuperar nome do usuario
    session_start();

    // Ao fazer este teste verifica se existe um usuario ja autorizado que foi inscrito anteriorment na variavel de sessao, caso contratio manda para home.php
    if (!$_SESSION["usuario"]){
        header("Location: index.php?erro=2");
    }

    require_once('db.class.php');

    // $texto_tweet = isset($_POST["texto_tweet"]) ? $_POST["texto_tweet"] : "";
    $id_usuario = $_SESSION["id_usuario"];


    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $sql = "SELECT t.tweet, DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, u.usuario FROM tweets AS t JOIN usuarios as u ON (t.id_usuario = u.id) WHERE id_usuario = $id_usuario ORDER BY data_inclusao DESC";
    
    $resultado_id = mysqli_query ($link, $sql);

    if ($resultado_id){
        while ($linha = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
            // var_dump($linha["tweet"]);
            echo "<a href='#' class='list-group-item'>";
                echo '<h4 class="list-group-heading">'.$linha["usuario"].' <small> - '.$linha["data_inclusao_formatada"].'</small> </h4>';
                echo '<p class="list-group-item-text">'.$linha["tweet"].' </p>';
            echo "</a>";
        }
    }
    else{
        echo "Erro on the Tweet query";
    }

?>