<?php

namespace App\Model;

class Conexao
{
    private static $conexao;

    public static function getInstancia()
    {
        if(is_null(self::$conexao)){
            try {
                self::$conexao = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
                self::$conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$conexao->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                throw new \Exception('Erro ao conectar ao banco de dados: ' . $e->getMessage());
            }
        }
        return self::$conexao;
    }
}