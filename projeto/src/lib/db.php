<?php 

/**
 * Funções relacionadas às operações gerais com o banco de dados
 */

/**
 * Retorna o objeto de conexão com o banco de dados da aplicação
 */
function get_db_connection()
{
    $conexao = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    if (mysqli_connect_errno()) {
        exit('Não foi possível se conectar à base de dados!');
    }

    return $conexao;
}

/**
 * Executa operações de SELEÇÃO DE DADOS na base de dados
 * @param string $sql             Instrução SQL que deve ser executada no banco
 * @param string $param_types     Tipo dos valores passados como parâmetro do SQL
 * @param array $param_values     Valores dos parâmetros do SQL
 * @param bool $is_single         Se true retorna um único valor do banco, caso contrário retorna uma lista de valores
 */
function db_query(string $sql, string $params_types = '', array $param_values = [], bool $is_single = false)
{
    $conexao = get_db_connection();
    $stmt = mysqli_prepare($conexao, $sql);

    if (!$stmt) {
        throw new Exception('Erro de sintaxe na estrutura SQL informada!');
    }

    if ($param_values and $params_types) {
        mysqli_stmt_bind_param($stmt, $params_types, ...$param_values); // spread operator
    }

    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($is_single) {
        # retorna só o primeiro item encontrado pela instrução SELECT
        return mysqli_fetch_assoc($resultado);
    }

    # retorna todos os dados encontrados pela instrução SELECT
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

/**
 * Executa operações do tipo INSERT, UPDATE e DELETE no banco de dados
 * @param string $sql               Instrução SQL a ser executada no banco
 * @param string $param_types       Tipo dos valores passados como parâmetro do SQL
 * @param string $param_values      Valores dos parâmetros do SQL
 */
function db_execute(string $sql, string $param_types, array $param_values)
{
    $conexao = get_db_connection();
    $stmt = mysqli_prepare($conexao, $sql);

    if (!$stmt) {
        throw new Exception('Erro na estrutura do comando SQL informado!');
    }

    if ($param_types and $param_values) {
        mysqli_stmt_bind_param($stmt, $param_types, ...$param_values);
    }

    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $resultado;
}