<?php 

/**
 * Funções relacionadas ao gerencimento de marcas do site
 */

 /**
  * Cadastra uma marca no sistema
  * @param string $marca        Nome da marca a ser inserida no banco de dados
  */
 function cadastrar_marca(string $marca)
 {
    $marca = filter_var($marca, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Marca é obrigatória!');
    if (marca_existe($marca)) {
        throw new Exception('Já existe uma marca com o nome indicado!');
    }

    $sql = "INSERT INTO marcas(marca) VALUES(?)";
    $params = array( $marca );
    $resultado = db_execute($sql, 's', $params);

    if (!$resultado) {
        throw new Exception('Não foi possível realizar o cadastro da marca!');
    }
 }

 /**
  * Exclui uma marca no sistema
  * @param int $id      ID da marca a ser excluida
  */
function excluir_marca(int $id)
{
    if ($id <= 0) {
        throw new Exception('ID inválido!');
    }

    $marca_info = get_marca_por_id($id);
    if (!$marca_info) {
        throw new Exception('Marca informada não existe!');
    }

    $sql = "DELETE FROM marcas WHERE id = ?";
    $params = array( $id );
    $resultado = db_execute( $sql, 'i', $params );

    if (!$resultado) {
        throw new Exception('Não foi possível realizar a exclusão da marca!');
    }
}

/**
 * Retorna a lista de todas as marcas cadastradas no sistema
 * @return array
 */
function get_marcas()
{
    $sql = "SELECT * FROM marcas";
    return db_query($sql);
}

/**
 * Checa na base de dados se já existe uma marca com o mesmo nome informado
 * @param string $marca         Nome da marca a ser verificada
 * @param int $id               ID comparativo
 */
function marca_existe(string $marca, int $id = 0)
{
    $sql = "SELECT * FROM marcas WHERE marca = ? AND id != ?";
    $params = array( $marca, $id );
    $resultado = db_query($sql, 'si', $params, true);

    if ($resultado) {
        return true;
    }

    return false;
}

/**
 * Retorna as informações de uma marca específica no sistema pelo seu ID
 * @param int $id           ID da marca
 * @return array|null
 */
function get_marca_por_id(int $id)
{
    $sql = "SELECT * FROM marcas WHERE id = ?";
    $params = array($id);

    return db_query($sql, 'i', $params, true);
}

/**
 * Atualiza as informações de uma marca específica no sistema
 * @param string $marca         Nome novo da marca
 * @param int $id               ID da marca
 */
function atualizar_marca(string $marca, int $id)
{
    $marca = filter_var($marca, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Marca é obrigatório!');
    if ($id <= 0) {
        throw new Exception('ID inválido!');
    }

    if (marca_existe($marca, $id)) {
        throw new Exception('Já existe uma marca com o nome fornecido!');
    }

    $sql = "UPDATE marcas SET marca = ? WHERE id = ?";
    $params = array( $marca, $id );

    $resultado = db_execute( $sql, 'si', $params );
    if (!$resultado) {
        throw new Exception('Não foi possível realizar a atualização da marca selecionada!');
    }
}