<?php 

/**
 * Funções relacionadas ao gerencimento de veículos do site
 */

/**
 * Cadastra um veículo no sistema
 * @param string $modelo     Nome da modelo a ser cadastrada
 * @param int $marca_id      ID da Marca
 * @param float $preco       Preço do veículo
 * @param string $foto       Foto do veículo
 * @param string $descricao  Descrição do veículo
 * @return void
 */
function cadastrar_veiculo(string $modelo, int $marca_id, float $preco, string $foto, string $descricao)
{
    $modelo = filter_var($modelo, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Modelo é obrigatório!');
    if ($marca_id <= 0) throw new Exception('Marca inválida!');
    if ($preco <= 0) throw new Exception('Preço inválido!');
    $descricao = filter_var($descricao, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Descrição é obrigatória!');

    $sql = "INSERT INTO veiculos(modelo, marca_id, preco, foto, descricao) VALUES(?, ?, ?, ?, ?)";
    $params = array($modelo, $marca_id, $preco, $foto, $descricao);
    $resultado = db_execute($sql, 'sidss', $params);
    if (!$resultado) {
        throw new Exception('Não foi possível cadastrar os dados do veículo!');
    }
}

/**
 * Retorna as informações de um veículo específico no sistema
 * @param int $id       ID do veículo a ser retornado
 * @return array|null
 */
function get_veiculo_por_id(int $id)
{
    $sql = "SELECT * FROM veiculos WHERE id = ?";
    $params = array($id);

    return db_query($sql, 'i', $params, true);
}

/**
 * Retorna a lista de veículos cadastrados no sistema
 * @param int $marca_id         ID da marca dos veículos
 * @return array
 */
function get_veiculos(int $marca_id = 0) : array 
{
    $sql = "SELECT v.*, m.marca FROM veiculos AS v LEFT JOIN marcas AS m ON v.marca_id = m.id";

    if ($marca_id > 0) 
    {
        $sql .= " WHERE v.marca_id = ?";
        return db_query( $sql, 'i', array($marca_id) );
    }

    return db_query($sql);
}

/**
 * Exclui um veículo no sistema
 * @param int $id       ID do Veículo a ser excluído
 * @return void
 */
function excluir_veiculo(int $id) 
{
    if ($id <= 0) {
        throw new Exception('ID inválido!');
    }

    $veiculo_info = get_veiculo_por_id($id);
    if (!$veiculo_info) {
        throw new Exception('Veículo informado não existe!');
    }

    $sql = "DELETE FROM veiculos WHERE id = ?";
    $params = array($id);

    $resultado = db_execute($sql, 'i', $params);
    if (!$resultado) {
        throw new Exception('Não foi possível excluir o veículo selecionado!');
    }

    excluir_imagem( $veiculo_info['foto'], 'veiculos' );
}

/**
 * Atualiza um veículo no sistema
 * @param string $modelo     Nome da modelo a ser cadastrada
 * @param int $marca_id      ID da Marca
 * @param float $preco       Preço do veículo
 * @param string $foto       Foto do veículo
 * @param string $descricao  Descrição do veículo
 * @param int $id            ID do veículo
 * @return void
 */
function atualizar_veiculo(string $modelo, int $marca_id, float $preco, string $foto, string $descricao, int $id = 0)
{
    $modelo = filter_var($modelo, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Modelo é obrigatório!');
    if ($marca_id <= 0) throw new Exception('Marca inválida!');
    if ($preco <= 0) throw new Exception('Preço inválido!');
    $descricao = filter_var($descricao, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Descrição é obrigatória!');
    
    if ($id <= 0) {
        throw new Exception('ID inválido!');
    }

    $veiculo_info = get_veiculo_por_id($id);

    $sql = "UPDATE veiculos SET marca_id = ?, modelo = ?, preco = ?, descricao = ? WHERE id = ?";
    $params = array($marca_id, $modelo, $preco, $descricao, $id);
    $ptypes = 'isdsi';

    if ($foto)
    {
        $sql = "UPDATE veiculos SET marca_id = ?, modelo = ?, preco = ?, foto = ?, descricao = ? WHERE id = ?";
        $params = array($marca_id, $modelo, $preco, $foto, $descricao, $id);
        $ptypes = 'isdssi';
    }

    $resultado = db_execute($sql, $ptypes, $params);
    if (!$resultado) {
        throw new Exception('Não foi possível atualizar os dados do veículo!');
    }

    if ($foto && $veiculo_info['foto'])
    {
        excluir_imagem($veiculo_info['foto'], 'veiculos');
    }
}