<?php 

/**
 * Funções relacionadas ao gerencimento de usuários administradores do site
 */

/**
 * Cadastra um usuário no sistema
 * @param string $login     Login do usuário a ser cadastrado
 * @param string $senha     Senha do usuário a ser cadastrado
 * @param string $csenha    Confirmação de senha
 * @param bool $ativo       Status do Usuário
 */
function cadastrar_usuario(string $login, string $senha, string $csenha, bool $ativo = true)
{
    $login = filter_var($login, FILTER_VALIDATE_EMAIL) ?: throw new Exception('Usuário deve ser um e-mail válido!');
    $senha = $senha ?: throw new Exception('Senha é obrigatório!');
    $csenha = $csenha ?: throw new Exception('Confirmação de senha é obrigatória!');

    if ($senha != $csenha) {
        throw new Exception('Senha e Confirmação devem ser iguais!');
    }

    if (usuario_existe($login)) {
        throw new Exception('Já existe um usuário com o login informado!');
    }

    $sql = "INSERT INTO usuarios(login, senha, ativo) VALUES (?, ?, ?)";
    $params = array( $login, $senha, $ativo );
    $resultado = db_execute($sql, 'ssi', $params);

    if (!$resultado) {
        throw new Exception('Não foi possível realizar o cadastro do usuário!');
    }
}

/**
 * Checa na base de dados se já existe um usuário com o mesmo login informado
 * @param string $login         Login ser verificado
 * @param int $id               ID comparativo
 */
function usuario_existe(string $login, int $id = 0)
{
    $sql = "SELECT * FROM usuarios WHERE login = ? AND id != ?";
    $params = array( $login, $id );
    $resultado = db_query($sql, 'si', $params, true);

    if ($resultado) {
        return true;
    }

    return false;
}