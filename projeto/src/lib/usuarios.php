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

    $hash_senha = password_hash($senha, PASSWORD_BCRYPT);
    $sql = "INSERT INTO usuarios(login, senha, ativo) VALUES (?, ?, ?)";
    $params = array( $login, $hash_senha, $ativo );
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

/**
 * Retorna a lista de todos os usuários cadastrados no sistema
 * @return array
 */
function get_usuarios()
{
    $sql = "SELECT * FROM usuarios";
    return db_query($sql);
}

/**
 * Exclui um usuário do sistema
 * @param int $id           Id do usuário a ser removido
 * @return void
 */
function excluir_usuario(int $id)
{
    if ($id <= 0) {
        throw new Exception('ID inválido!');
    }

    $usuario_info = get_usuario_por_id($id);
    if (!$usuario_info) {
        throw new Exception('Usuário informado não existe!');
    }

    $sql = "DELETE FROM usuarios WHERE id = ?";
    $params = array($id);
    $resultado = db_execute($sql, 'i', $params);

    if (!$resultado) {
        throw new Exception('Não foi possível realizar a exclusão do usuário!');
    }
}

/**
 * Retorna as informações de um usuário específico por ID
 * @param int $id       ID do usuário
 * @return array|null
 */
function get_usuario_por_id(int $id)
{
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $params = array($id);

    return db_query($sql, 'i', $params, true);
}

/**
 * Atualiza as informações de um usuário específico no sistema
 * @param string $login     Login do usuário a ser cadastrado
 * @param string $senha     Senha do usuário a ser cadastrado
 * @param string $csenha    Confirmação de senha
 * @param bool $ativo       Status do Usuário
 * @param int $id           ID do usuário que será atualizado
 */
function atualizar_usuario(string $login, string $senha, string $csenha, bool $ativo = true, int $id = 0)
{
    $login = filter_var($login, FILTER_VALIDATE_EMAIL) ?: throw new Exception('Usuário deve ser um e-mail válido!');
    if ($senha != $csenha) {
        throw new Exception('Senha e Confirmação devem ser iguais!');
    }

    if ($id <= 0) {
        throw new Exception('ID inválido!');
    }

    if (usuario_existe($login, $id)) {
        throw new Exception('Já existe um usuário com o login informado!');
    }

    $sql = "UPDATE usuarios SET login = ?, ativo = ? WHERE id = ?";
    $params = array( $login, $ativo, $id );
    $ptypes = 'sii';

    if ($senha)
    {
        $hash_senha = password_hash($senha, PASSWORD_BCRYPT);
        $sql = "UPDATE usuarios SET login = ?, senha = ?, ativo = ? WHERE id = ?";
        $params = array( $login, $hash_senha, $ativo, $id );
        $ptypes = 'ssii';
    }

    $resultado = db_execute($sql, $ptypes, $params);
    if (!$resultado) {
        throw new Exception('Não foi possível realizar a atualização do usuário informado!');
    }
}

/**
 * Realiza o login do usuário no sistema
 * @param string $login     Login do usuário
 * @param string $senha     Senha do usuário
 */
function login_usuario(string $login, string $senha)
{
    $login = filter_var($login, FILTER_VALIDATE_EMAIL) ?: throw new Exception('Usuário deve ser um e-mail válido!');
    $senha = $senha ?: throw new Exception('Senha é obrigatório!');

    $sql = "SELECT * FROM usuarios WHERE login = ?";
    $params = array($login);
    $usuario_info = db_query($sql, 's', $params, true);

    if (!$usuario_info) {
        throw new Exception("Usuário informado não existe!");
    }

    if (!$usuario_info['ativo']) {
        throw new Exception('Seu usuário encontra-se inativo no momento. Entre em contato com o administrador!');
    }

    $hash = $usuario_info['senha'];
    if (!password_verify($senha, $hash)) {
        throw new Exception('Usuário/Senha inválidos!');
    }

    session_regenerate_id(true);
    set_usuario_logado($login);

    header('Location: index.php');
    exit;
}

/**
 * Seta a informação do usuário logado no momento dentro da aplicação
 * @param string $login     Login do usuário ativo na aplicação
 */
function set_usuario_logado(string $login)
{
    $_SESSION['user_logado'] = $login;
}

/**
 * Retorna o usuario atualmente logado no sistema
 * @return string|null
 */
function get_usuario_logado()
{
    return $_SESSION['user_logado'] ?? '';
}

/**
 * Realiza o logout do usuário
 * @return void
 */
function logout()
{
    session_destroy();
    unset($_SESSION['user_logado']);

    header('Location: login.php');
    exit;
}