<?php 

// Configurações Gerais
require_once "../src/config.php";

$titulo_pagina = "Dashboard";
require_once 'includes/cabecalho-admin.php';
?>
    <header class="bg-secondary d-flex justify-content-between align-items-center p-4 mb-3">
        <h2 class="text-white">
            Bem-vindo(a) à Adminitração 
        </h2>
    </header>
    <p>
        Aqui você poderá gerenciar o conteúdo do seu site.
    </p>

<?php require_once 'includes/rodape-admin.php'; ?>