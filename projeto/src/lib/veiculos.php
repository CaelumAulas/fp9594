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