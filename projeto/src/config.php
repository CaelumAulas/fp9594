<?php 

/**
 * Arquivo de Configurações Gerais do Site
 */
define('SITE_NAME', 'AutoCaelum');
define('DB_HOST', 'localhost');
define('DB_NAME', 'autocaelum');
define('DB_USER', 'root2');
define('DB_PWD', 'admin');
define('DIR_IMG', $_SERVER['DOCUMENT_ROOT'] . '/fp9594/projeto/img/');

// session_set_cookie_params(60 * 2);
session_start();

/** Bibliotecas de Funções */
require_once "lib/db.php";
require_once "lib/utils.php";
require_once "lib/marcas.php";
require_once "lib/usuarios.php";
require_once "lib/veiculos.php";

if (isset($_GET['logout'])) {
    logout();
}

bloquear_acesso_admin();