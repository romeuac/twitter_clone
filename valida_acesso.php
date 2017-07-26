<?php

    // Por convencao a deve-se chamar a funcao sessios start logo no inicio do php
    session_start();

    require_once("db.class.php");

    $usuario = $_POST["usuario"];
    $senha = md5($_POST["senha"]);

    // echo "<br> $usuario e $senha";

    $sql = "select usuario, email, id from usuarios WHERE usuario = '$usuario' and senha = '$senha'";

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    // RETORNOs do MYSQLI_QEURY()
    // insert true / false
    // update true / false
    // delete true / false
    // select false / RESOURCE - pode-se guardar em um array
    $resultado_id = mysqli_query($link, $sql);

    if ($resultado_id)
    {
        // Guardando em um array a resposta do usuario
        $dados_usuario = mysqli_fetch_array ($resultado_id);
        // var_dump($dados_usuario);

        // Caso o usuario e senha sejam validos
        if (isset($dados_usuario['usuario'])){
            // Salvamos na super global session o usuario - Tais variaveis serao acessiveis das outras paginas tambem devido ao uso da Sessio
            $_SESSION['usuario'] = $dados_usuario['usuario'];
            $_SESSION['email'] = $dados_usuario['email'];
            $_SESSION['id_usuario'] = $dados_usuario['id'];

            header('Location: home.php');
        }else { 
            // Passa-se para a pagina de index com erro = 1 , via GET
            header('Location: index.php?erro=1');
        }

    }else{
        echo "<br>Error on the query execution or INVALID User, please get in contact with the website admin<br>";
    }

?>