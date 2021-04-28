<?php 

/**
 * Coleção de funções de uso geral na aplicação
 */

/**
 * Retorna a estrutura de menu do site
 * @return array
 */
function get_menu()
{
    return array(
        'estoque' => array( 'url' => 'index.php', 'texto' => 'Estoque' ),
        'sobre' => array( 'url' => 'sobre.php', 'texto' => 'Sobre' ),
        'contato' => array( 'url' => 'contato.php', 'texto' => 'Contato' )
    );
}

/**
 * Expoe a estrutura de uma variável
 */
function custom_print($var)
{
    print '<pre>';
    print_r($var);
    print '</pre>';
}

/**
 * Configura a mensagem de erro/sucesso a ser exibida para o usuário
 * @param string $msg       Mensagem a ser exibida
 * @param string $tipo      Tipo da mensagem (erro, sucesso, etc.)
 */
function set_app_mensagem(string $msg, string $tipo = 'sucesso')
{
    $classes_css = array(
        'sucesso' => 'alert-success',
        'erro' => 'alert-danger',
        'aviso' => 'alert-warning'
    );

    $GLOBALS['msg_app'] = array(
        'mensagem' => $msg,
        'classe' => $classes_css[$tipo]
    );
}

/**
 * Exibe a mensagem configurada pela função "set_app_mensagem"
 */
function show_app_mensagem()
{
    $msg = $GLOBALS['msg_app'] ?? null;

    if ($msg)
    {
        print "
            <div class=\"alert {$msg['classe']}\">
                {$msg['mensagem']}
            </div>
        ";
    }
}

/**
 * Bloqueia o acesso ao admin caso o usuário não esteja logado
 * @return void
 */
function bloquear_acesso_admin()
{
    $url = $_SERVER['REQUEST_URI'];
    $is_pagina_admin = (str_contains($url, '/admin') && !str_contains($url, 'login.php'));

    if (!get_usuario_logado() and $is_pagina_admin) {
        header('Location: login.php');
        exit;
    }
}

/**
 * Realiza o upload de uma imagem
 * @param string $campo         Campo do formulário que contém o arquivo que será feito o upload
 * @param string $diretorio     Nome do diretório onde a imagem deve ser salva
 * @param int $largura          Largura mínima que a imagem deve ter
 * @param int $altura           Altura mínima que a imagem deve ter
 * @return string               Nome da imagem salva no servidor
 */
function upload_imagem(string $campo, string $diretorio = '', int $largura = 500, int $altura = 500)
{
    $novo_nome = '';
    $nome_imagem = $_FILES[$campo]['name'] ?: '';
    
    if ($nome_imagem)
    {
        $extensoes_validas = array('jpg', 'jpeg', 'gif', 'png');
        $extensao = strtolower(pathinfo($nome_imagem, PATHINFO_EXTENSION));

        if (!in_array($extensao, $extensoes_validas)) {
            throw new Exception('Extensão inválida! Selecione um arquivo JPG, GIF ou PNG!');
        }

        list($width, $height) = getimagesize($_FILES[$campo]['tmp_name']);
        if ($width < $largura or $height < $altura) {
            throw new Exception("As dimensões da imagem devem ter no mínimo $largura x $altura!");
        }

        $novo_nome = md5(rand(1000, 1000000)) . "." . $extensao;
        $caminho_salvar = DIR_IMG . $diretorio . '/' . $novo_nome;
        
        if (!move_uploaded_file($_FILES[$campo]['tmp_name'], $caminho_salvar)) {
            throw new Exception('Não foi possível realizar o upload da imagem!');
        }
    }

    return $novo_nome;
}

/**
 * Exclui um arquivo de imagem de um diretório específico
 * @param string $arquivo       Nome do arquivo que deve ser excluído
 * @param string $diretorio     Nome do diretório onde verificar a imagem
 */
function excluir_imagem(string $arquivo, string $diretorio = '')
{
    if ($arquivo) 
    {
        $caminho_arquivo = DIR_IMG . $diretorio . '/' . $arquivo;
        if (file_exists($caminho_arquivo)) 
        {
            unlink($caminho_arquivo);
        }
    }
}