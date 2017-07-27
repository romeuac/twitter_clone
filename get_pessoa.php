<?php
    // Startando a sessao para recuperar nome do usuario
    session_start();

    // Ao fazer este teste verifica se existe um usuario ja autorizado que foi inscrito anteriorment na variavel de sessao, caso contratio manda para home.php
    if (!$_SESSION["usuario"]){
        header("Location: index.php?erro=2");
    }

    require_once('db.class.php');

    $nome_pessoa = $_POST["nome_pessoa"];
    $id_usuario = $_SESSION["id_usuario"];

    // echo $nome_pessoa;

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    // $sql = "SELECT * FROM usuarios WHERE usuario like '%$nome_pessoa%' AND id != $id_usuario";
    $sql = "SELECT u.*,us.* FROM usuarios AS u LEFT JOIN usuarios_seguidores AS us ON   (us.id_usuario = $id_usuario AND u.id = us.id_usuario_seguido) WHERE u.usuario like '%$nome_pessoa%' AND u.id  != $id_usuario ";

    // echo $sql;

    
    $resultado_id = mysqli_query ($link, $sql);
    $pesquisaOk = false;

    if ($resultado_id){
        while ($linha = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
            // var_dump($linha["tweet"]);
            echo "<a href='#' class='list-group-item'>";
                echo '<strong>'.$linha["usuario"].'</strong> - <small>'.$linha["email"].'</small>';
                echo '<p class="list-group-item-text pull-right">';

                    $esta_seguind_usr_sn = ( isset($linha["id_usuarios_seguidores"]) and !empty($linha["id_usuarios_seguidores"]))? "S" : "N";

                    $btn_deixar_seguir_display = "block";
                    $btn_seguir_display = "block";

                    if($esta_seguind_usr_sn == "N"){
                        $btn_deixar_seguir_display = "none";
                    }else{
                        $btn_seguir_display = "none";
                    }

                    // FOLLOW
                    echo '<button type="button" class="btn btn-default btn_seguir" data-id_usuario="'.$linha["id"].'" id="btn_seguir'.$linha["id"].'" style="display:'.$btn_seguir_display.'">Follow</button>';

                    // UNFOLLOW
                    echo '<button type="button" class="btn btn-primary btn_deixar_seguir" style="display:'.$btn_deixar_seguir_display.'" data-id_usuario="'.$linha["id"].'" id="btn_deixar_seguir'.$linha["id"].'">Unfollow</button>';

                echo '</p>';
                echo '<div class="clearfix"></div>';
            echo "</a>";

            $pesquisaOk = true;
        }
        // var_dump($resultado_id);

        if(!$pesquisaOk)
            echo "We are sorry, we couldn't find any user matching this name...";
        
    }
    else{
        echo "Erro on the query looking for other users";
    }

?>