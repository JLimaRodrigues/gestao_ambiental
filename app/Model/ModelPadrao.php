<?php

namespace App\Model;

use App\Model\Conexao;

class ModelPadrao
{
    private $atributos;
    private $queryParts = []; // Armazena partes da query dinamicamente

    public function __construct() {}

    public function __set(string $atributo, $valor)
    {
        $this->atributos[$atributo] = $valor;
        return $this;
    }

    public function __get(string $atributo)
    {
        return $this->atributos[$atributo];
    }

    public function __isset($atributo)
    {
        return isset($this->atributos[$atributo]);
    }

    // Escapar valores
    protected function escapar($dados)
    {
        if (is_string($dados) && !empty($dados)) {
            return addslashes($dados);
        } elseif (is_bool($dados)) {
            return $dados ? 'TRUE' : 'FALSE';
        } elseif ($dados !== '') {
            return $dados;
        } else {
            return null;
        }
    }

    // Monta SELECT básico
    public function select($columns = '*')
    {
        $this->queryParts['select'] = "SELECT {$columns}";
        return $this;
    }

    // Define a tabela principal
    public function from($table)
    {
        $this->queryParts['from'] = "FROM {$table}";
        return $this;
    }

    // Adiciona JOINs
    public function join($type, $table, $on)
    {
        $this->queryParts['join'][] = strtoupper($type) . " JOIN {$table} ON {$on}";
        return $this;
    }

    // Adiciona cláusula WHERE
    public function where($condition)
    {
        $this->queryParts['where'][] = $condition;
        return $this;
    }

    // Adiciona ORDER BY
    public function orderBy($column, $direction = 'ASC')
    {
        $this->queryParts['order'] = "ORDER BY {$column} {$direction}";
        return $this;
    }

    // Adiciona LIMIT
    public function limit($count)
    {
        $this->queryParts['limit'] = "LIMIT {$count}";
        return $this;
    }

    // Executa a query final
    public function execute()
    {
        $conexao = Conexao::getInstancia();

        // Constrói a query completa
        $query = implode(' ', [
            $this->queryParts['select'] ?? '',
            $this->queryParts['from'] ?? '',
            isset($this->queryParts['join']) ? implode(' ', $this->queryParts['join']) : '',
            isset($this->queryParts['where']) ? 'WHERE ' . implode(' AND ', $this->queryParts['where']) : '',
            $this->queryParts['order'] ?? '',
            $this->queryParts['limit'] ?? '',
        ]);

        $stmt = $conexao->prepare($query);

        // Atribua valores se necessário
        if (!empty($this->atributos)) {
            foreach ($this->atributos as $key => $value) {
                $stmt->bindValue(":{$key}", $value, is_null($value) ? \PDO::PARAM_NULL : (is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR));
            }
        }

        $stmt->execute();

        // Limpa partes da query após execução
        $this->queryParts = [];

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function listAll($table)
    {
        return $this->select('*')
                    ->from($table)
                    ->execute();
    }

    public function find($id, $table, $pk)
    {
        return $this->select('*')
        ->from($table)
        ->where("$pk = '$id'")
        ->execute();
    }
}