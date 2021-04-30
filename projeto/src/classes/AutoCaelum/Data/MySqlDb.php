<?php 

namespace AutoCaelum\Data;
use mysqli;
use Exception;

class MySqlDb implements IDatabase
{
    private $conn = null;

    public function __construct(string $host, string $user, string $pwd, string $dbname, ?int $port = null)
    {
        $this->conn = new mysqli($host, $user, $pwd, $dbname, $port);
        if ($this->conn->errno) {
            exit('Não foi possível realizar a conexão com a base de dados do MySQL.');
        }
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    private function getSqlType($value)
    {
        // match expression = PHP 8
        return match ( gettype($value) ) {
            'string' => 's',
            'float', 'double' => 'd',
            'integer', 'boolean' => 'i',
            default => throw new Exception('Tipo do parâmetro é inválido!')
        };
    }

    public function insert(string $table, array $columns, array $values): bool
    {
        if (!$table or !$columns or !$values) {
            throw new Exception('Parâmetros de inserção inválidos!');
        }

        // PHP 7.3 ou anterior
        // $parameters = join(', ', array_map(function () {
        //     return "?"
        // }, $values));

        $cols = join(', ', $columns);
        $parameters = join(', ', array_map(fn() => "?", $values)); // PHP 7.4+ = Arrow Functions
        $types = join('', array_map(fn($v) => $this->getSqlType($v), $values));

        $sql = "INSERT INTO $table ($cols) VALUES ($parameters)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->errno) {
            throw new Exception('Erro na estrutura SQL de inserção!');
        }

        $stmt->bind_param($types, ...$values);
        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }

    public function update(string $table, array $columns_values, array $where, string $operator = 'AND'): bool
    {
        return true;
    }

    public function delete(string $table, array $where, string $operator = 'AND'): bool
    {
        return true;
    }

    public function select(string $table, array $columns = [], array $where = [], string $operator = 'AND', bool $single = false): ?array
    {
        return null;
    }

    public function query(string $sql, array $values = [], bool $single = false): ?array
    {
        return null;
    }
}