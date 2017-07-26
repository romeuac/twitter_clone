<?php
    session_start();

    // Deletando as variaveis de sessao criadas apos o login - faz quando se apertar no botao sair da plataforma
    unset($_SESSION ["usuario"]);
    unset($_SESSION ["email"]);

    header("Location: index.php");


?>