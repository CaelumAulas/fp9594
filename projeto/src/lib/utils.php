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