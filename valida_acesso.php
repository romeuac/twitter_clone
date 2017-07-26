<?php

    require_once("db.class.php");

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    // echo "<br> $usuario e $senha";

    $sql = "select * from usuarios WHERE usuario = '$usuario' and senha = '$senha'";

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $resultado_id = mysqli_query($link, $sql);

    // RETORNOs do MYSQLI_QEURY()
    // insert true / false
    // update true / false
    // delete true / false
    // select false / RESOURCE - pode-se guardar em um array

    // Guardando em um array a resposta do usuario
    $dados_usuario = mysqli_fetch_array ($resultado_id);


?>