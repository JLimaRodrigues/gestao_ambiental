<?php

function connect_local_mysqli($database = NULL, $charset = "utf8")
{
    $servidor = 'localhost';
    $login = 'root';
    $senha = 'resende123';

    $connection = new mysqli($servidor, $login, $senha, $database);

    // if (mysqli_connect_errno()) {
    //    log_erro("Erro ao conectar ao banco de dados: "
    //         . mysqli_connect_error());
    //     /* trigger_error("Erro ao conectar ao banco de dados: "
    //       . mysqli_connect_error()); */
    // }

    // if ($charset <> '') {
    //     if (!mysqli_set_charset($connection, $charset)) {
    //         log_erro("Erro ao carregar charset $charset: "
    //             . mysqli_connect_error());
    //         /* trigger_error("Erro ao carregar charset $charset: "
    //           . mysqli_connect_error()); */
    //     }
    // }

    return $connection;
}
