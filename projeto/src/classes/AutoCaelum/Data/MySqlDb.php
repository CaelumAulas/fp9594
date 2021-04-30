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
        if (!$table or !$columns_values or !$where) {
            throw new Exception('Parâmetros de atualização inválidos!');
        }

        $cols_vals = join(', ', array_map(fn($col) => "$col = ?", array_keys($columns_values)));
        $where_str = join(" $operator ", array_map(fn($col) => "$col = ?", array_keys($where)));
        $values = array_values( array_merge( $columns_values, $where ));
        $types = join('', array_map(fn($v) => $this->getSqlType($v), $values));

        // UPDATE tabela SET col1 = ?, col2 = ?, col3 = ? WHERE colx = ?
        $sql = "UPDATE $table SET $cols_vals WHERE $where_str";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->errno) {
            throw new Exception('Erro na estrutura SQL de atualização!');
        }

        $stmt->bind_param($types, ...$values);
        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }

    public function delete(string $table, array $where, string $operator = 'AND'): bool
    {
        if (!$table or !$where) {
            throw new Exception('Parâmetros de exclusão inválidos!');
        }

        $where_str = join(" $operator ", array_map(fn($col) => "$col = ?", array_keys($where)));
        $values = array_values( $where );
        $types = join('', array_map(fn($v) => $this->getSqlType($v), $values));

        $sql = "DELETE FROM $table WHERE $where_str";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->errno) {
            throw new Exception('Erro na estrutura SQL de exclusão!');
        }

        $stmt->bind_param($types, ...$values);
        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }

    public function select(string $table, array $columns = [], array $where = [], string $operator = 'AND', bool $single = false): ?array
    {
        if (!$table) {
            throw new Exception('Tabela inválida para operação de seleção!');
        }

        $columns = !$columns ? "*" : join(', ', $columns);
        $where_str = join(" $operator ", array_map(fn($col) => "$col = ?", array_keys($where)));
        $values = array_values( $where );
        $types = join('', array_map(fn($v) => $this->getSqlType($v), $values));

        $sql = "SELECT $columns FROM $table";
        if ($where) {
            $sql .= " WHERE $where_str";
        }

        $stmt = $this->conn->prepare($sql);
        if ($stmt->errno) {
            throw new Exception('Erro na estrutura SQL de seleção!');
        }

        if ($types) {
            $stmt->bind_param($types, ...$values);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();

        if ($single) {
            return $resultado->fetch_assoc();
        }

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function query(string $sql, array $values = [], bool $single = false): ?array
    {
        if (!$sql) {
            throw new Exception('Instrução SQL inválida!');
        }   

        $stmt = $this->conn->prepare($sql);
        if ($stmt->errno) {
            throw new Exception('Erro na estrutura do SQL!');
        }

        if ($values) {
            $types = join('', array_map(fn($v) => $this->getSqlType($v), $values));
            $stmt->bind_param($types, ...$values);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();

        if ($single) {
            return $resultado->fetch_assoc();
        }

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}