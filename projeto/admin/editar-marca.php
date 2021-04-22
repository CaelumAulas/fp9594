<?php 

$titulo_pagina = "Editar Marca";
require_once 'includes/cabecalho-admin.php';
?>
    <header class="bg-secondary d-flex justify-content-between align-items-center p-4 mb-3">
        <h2 class="text-white">
            <span class="text-light font-weight-light">
                Marcas
            </span> / Editar
        </h2>
    </header>
    <p>
        Utilize o formulário abaixo para atualizar uma marca.
    </p>
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
            <input type="hidden" name="marca_id" value="" />
        </div>
    </form>
<?php require_once 'includes/rodape-admin.php'; ?>