<?php

/* ABAIXO O MODELO PARA O ARQUIVO DE CONEXÃO. RECOMENDO MANTER O NOME DA BASE DE DADOS PARA EVITAR MEXER NO CÓDIGO.
   APÓS PREENCHER O CAMPO, RENOMEIE ESSE ARQUIVO PARA "conexao.php". COM ISSO O CÓDIGO DEVERÁ FUNCIONAR */

function connect_local_mysqli($database = NULL, $charset = "utf8")
{
    $host = 'localhost'; 
    $username = 'xxxxxxx';
    $password = 'xxxxxxx';
    $database = 'gestam16_gestao_ambiental';
    $conn = new mysqli($host, $username, $password, $database);
    return $conn;
}
