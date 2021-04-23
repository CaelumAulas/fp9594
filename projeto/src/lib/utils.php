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

