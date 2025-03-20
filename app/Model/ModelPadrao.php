<?php

namespace App\Model;

use App\Model\Conexao;

class ModelPadrao
{
    private $atributos = [];
    private $queryParts = [];

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

    public function select($colunas = '*')
    {
        $this->queryParts['select'] = "SELECT {$colunas}";
        return $this;
    }

    public function from($tabela)
    {
        $this->queryParts['from'] = "FROM {$tabela}";
        return $this;
    }

    public function join($tipo, $tabela, $condicao)
    {
        $this->queryParts['join'][] = strtoupper($tipo) . " JOIN {$tabela} ON {$condicao}";
        return $this;
    }

    public function where($condicao)
    {
        $this->queryParts['where'][] = $condicao;
        return $this;
    }

    public function orderBy($coluna, $direcao = 'ASC')
    {
        $this->queryParts['order'] = "ORDER BY {$coluna} {$direcao}";
        return $this;
    }

    public function limit($count)
    {
        $this->queryParts['limit'] = "LIMIT {$count}";
        return $this;
    }

    public function execute()
    {
        $conexao = Conexao::getInstancia();

        $query = implode(' ', [
            $this->queryParts['select'] ?? '',
            $this->queryParts['from'] ?? '',
            isset($this->queryParts['join']) ? implode(' ', $this->queryParts['join']) : '',
            isset($this->queryParts['where']) ? 'WHERE ' . implode(' AND ', $this->queryParts['where']) : '',
            $this->queryParts['order'] ?? '',
            $this->queryParts['limit'] ?? '',
        ]);

        $stmt = $conexao->prepare($query);

        if (!empty($this->atributos)) {
            foreach ($this->atributos as $key => $value) {
                $stmt->bindValue(":{$key}", $value, is_null($value) ? \PDO::PARAM_NULL : (is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR));
            }
        }

        $stmt->execute();

        $this->queryParts = [];

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function listAll($tabela)
    {
        return $this->select('*')
                    ->from($tabela)
                    ->execute();
    }

    public function find($id, $tabela, $pk)
    {
        return $this->select('*')
                    ->from($tabela)
                    ->where("$pk = '$id'")
                    ->execute();
    }

    public function update($tabela, array $data, $where)
    {
        $setParts = [];
        foreach ($data as $col => $valor) {
            $setParts[] = "{$col} = :{$col}";
            $this->atributos[$col] = $this->escapar($valor);
        }
        $setClause = implode(', ', $setParts);
        $query = "UPDATE {$tabela} SET {$setClause} WHERE {$where}";

        $conexao = Conexao::getInstancia();
        $stmt = $conexao->prepare($query);

        foreach ($data as $col => $valor) {
            $stmt->bindValue(":{$col}", $valor, is_null($valor) ? \PDO::PARAM_NULL : (is_int($valor) ? \PDO::PARAM_INT : \PDO::PARAM_STR));
        }

        return $stmt->execute();
    }

    public function delete($tabela, $where)
    {
        $query = "DELETE FROM {$tabela} WHERE {$where}";
        $conexao = Conexao::getInstancia();
        $stmt = $conexao->prepare($query);
        return $stmt->execute();
    }
}