<?php

/** Configurações Gerais */
require_once "src/config.php";

$titulo_pagina = "Entre em Contato";
$texto_destaque = "Use o formulário abaixo para entrar em contato conosco.";
$menu_ativo = 'contato';
require_once "src/includes/cabecalho.php";

?>
<h1>Contato</h1>
<hr>
<form method="POST" action="" class="row mx-0">
    <div class="form-group col-md-6">
        <label>Nome completo:</label>
        <input type="text" name="nome_completo" class="form-control" />
    </div>
    <div class="form-group col-md-6">
        <label>E-mail:</label>
        <input type="email" name="email" class="form-control" />
    </div>
    <div class="form-group col-md-12">
        <label>Assunto:</label>
        <input type="text" name="assunto" class="form-control" />
    </div>
    <div class="form-group col-md-12">
        <label>Mensagem:</label>
        <textarea class="form-control" name="mensagem" rows="5"></textarea>
    </div>
    <div class="form-group col-md-12">
        <button class="btn btn-primary">
            Enviar
        </button>
    </div>
</form>
<?php

require_once "src/includes/rodape.php";
