<?php

    require_once("db.class.php");

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    // echo "<br> $usuario e $senha";

    $sql = "select * from usuarios WHERE usuario = '$usuario' and senha = '$senha'";

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

        if (isset($dados_usuario['usuario'])){
            echo "<br>User exists<br>";
        }else { 
            // Passa-se para a pagina de index com erro = 1 , via GET
            header('Location: index.php?erro=1');
        }

    }else{
        echo "<br>Error on the query execution or INVALID User, please get in contact with the website admin<br>";
    }

?>