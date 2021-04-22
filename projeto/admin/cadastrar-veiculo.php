<?php 

$titulo_pagina = "Cadastrar Veículo";
require_once 'includes/cabecalho-admin.php';
?>
    <header class="bg-secondary d-flex justify-content-between align-items-center p-4 mb-3">
        <h2 class="text-white">
            <span class="text-light font-weight-light">
                Veículos
            </span> / Cadastrar
        </h2>
    </header>
    <p>
        Utilize o formulário abaixo para cadastrar um novo veículo.
    </p>
    <form method="POST" class="row">
        <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="marca">Modelo:</label>
            </div>
            <input type="text" name="modelo" id="modelo" class="form-control" placeholder="" />
        </div>
        <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="marca">Marca:</label>
            </div>
            <select class="custom-select" id="marca" name="marca">
                <option>Selecione...</option>
                <option value="1">Marca 1</option>
                <option value="2">Marca 2</option>
                <option value="3">Marca 3</option>
            </select>
        </div>
        <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="preco">Preço:</label>
            </div>
            <input type="number" name="preco" id="preco" class="form-control" placeholder="" />
        </div>
        <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="foto">Foto:</label>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="foto" name="foto">
                <label class="custom-file-label" for="inputGroupFile01">Escolher arquivo...</label>
            </div>
        </div>
        <div class="input-group col-md-12 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="descricao">Descrição:</label>
            </div>
            <textarea class="form-control" name="descricao" id="descricao" rows="5"></textarea>
        </div>
        <div class="input-group col-md-12">
            <button class="btn btn-primary px-5">
                <i class="far fa-save"></i> Salvar
            </button>
        </div>
    </form>
<?php require_once 'includes/rodape-admin.php'; ?>