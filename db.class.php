<?php

    // MySql i eh nativa do php

    class db{
        //host - endereco que o MySql esta instalado
        private $host = 'localhost';

        //usuario
        private $usuario = 'root';

        //senha
        private $senha = '';

        //banco de dados
        private $database = "twitter_clone";


        // Methods
        function conecta_mysql(){
            // Para criar a conexao com o mysql
            $con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

            // Necessario setar o charset de comunicacao entre banco e aplicacao (frontend - arquivos - comunicao com DB estao no mesmo charset - baixa possibilidade de erro de caracteres)
            mysqli_set_charset($con, 'utf8');

            // Verificar se houve erro com DB
            if (mysqli_connect_errno()){
                echo "Error trying to connect with MySQL".mysqli_connect_error();
            }

            return $con;
        }

    }

?>