<?php

    require_once("db.class.php");

    
    $sql = "SELECT * FROM usuarios";

    // $sql = "SELECT * FROM usuarios WHERE id = 7";

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
        $dados_usuario = array();
        while ($linha = mysqli_fetch_array ($resultado_id, MYSQLI_ASSOC)){
            // Adiciona dinamicamente mais um registro enquanto $linha nao for false (ou seja, ter acabado a lista de retorno da query)
            $dados_usuario[] = $linha;
        } 

        foreach ($dados_usuario as $usr){
            // var_dump($usr);
            echo $usr["email"];
            echo "<br><br>";
        }
        // var_dump($dados_usuario);
        // Guardando em um array a resposta do usuario (indice associativo e o numerico)
        // $dados_usuario = mysqli_fetch_array ($resultado_id);
        
        // Retorna apeas o array com indices numericos
        // $dados_usuario = mysqli_fetch_array ($resultado_id, MYSQLI_NUM);

        //Retornar apenas no array os indices sendo o nome dos campos no BD
        // $dados_usuario = mysqli_fetch_array ($resultado_id, MYSQL_ASSOC);
       

    }else{
        echo "<br>Error on the query execution or INVALID User, please get in contact with the website admin<br>";
    }

?>