<?php 

namespace AutoCaelum\Data;

interface IDatabase
{
    public function insert(string $table, array $columns, array $values) : bool;
    public function update(string $table, array $columns_values, array $where, string $operator = 'AND') : bool;
    public function delete(string $table, array $where, string $operator = 'AND') : bool;
    public function select(string $table, array $columns = [], array $where = [], string $operator = 'AND', bool $single = false) : ?array; // Nullable array
    public function query(string $sql, array $values = [], bool $single = false) : ?array;
}