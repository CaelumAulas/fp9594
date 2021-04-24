<?php 

// Configurações Gerais
require_once '../src/config.php';

try 
{
    if ($_POST)
    {
        $marca = $_POST['marca'] ?? "";
        cadastrar_marca($marca);
        set_app_mensagem('Marca cadastrada com sucesso!');
    }
}
catch(Exception $exc)
{
    set_app_mensagem($exc->getMessage(), 'erro');
}

$titulo_pagina = "Cadastrar Marca";
require_once 'includes/cabecalho-admin.php';
?>
    <header class="bg-secondary d-flex justify-content-between align-items-center p-4 mb-3">
        <h2 class="text-white">
            <span class="text-light font-weight-light">
                Marcas
            </span> / Cadastrar
        </h2>
    </header>
    <p>
        Utilize o formulário abaixo para cadastrar uma nova marca.
    </p>

    <?php show_app_mensagem(); ?>

    <form method="POST" class="row">
        <div class="input-group col-md-9">
            <div class="input-group-prepend">
                <label class="input-group-text" for="marca">Nome da Marca:</label>
            </div>
            <input type="text" name="marca" id="marca" class="form-control" placeholder="" />
        </div>
        <div class="input-group col-md-3">
            <button class="btn btn-primary px-5 w-100">
                <i class="far fa-save"></i> Salvar
            </button>
        </div>
    </form>
<?php require_once 'includes/rodape-admin.php'; ?>