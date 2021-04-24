<?php 

/**
 * Arquivo de Configurações Gerais do Site
 */
define('SITE_NAME', 'AutoCaelum');
define('DB_HOST', 'localhost');
define('DB_NAME', 'autocaelum');
define('DB_USER', 'root2');
define('DB_PWD', 'admin');

/** Bibliotecas de Funções */
require_once "lib/db.php";
require_once "lib/utils.php";
require_once "lib/marcas.php";
require_once "lib/usuarios.php";
require_once "lib/veiculos.php";